<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatController extends Controller
{
    public function send(Request $request)
    {
        $messages = $request->input('messages', []);
        $system = $request->input('system', '');

        $keys = array_filter([
            env('GROQ_API_KEY'),
            env('GROQ_API_KEY_2'),
            env('GROQ_API_KEY_3'),
        ]);

        if (empty($keys)) {
            return response()->json(['error' => ['message' => 'API Keys tidak ditemukan.']], 500);
        }

        foreach ($keys as $index => $key) {
            try {
                $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $key,
                    'Content-Type' => 'application/json',
                ])->timeout(30)->post('https://api.groq.com/openai/v1/chat/completions', [
                    'model' => 'llama-3.3-70b-versatile',
                    'max_tokens' => 1000,
                    'temperature' => 0.7,
                    'messages' => array_merge(
                        [['role' => 'system', 'content' => $system]],
                        $messages
                    ),
                ]);

                $data = $response->json();
                $errorMessage = $data['error']['message'] ?? '';

                if (isset($data['error']) &&
                   (str_contains(strtolower($errorMessage), 'rate_limit') ||
                    str_contains(strtolower($errorMessage), 'rate limit'))) {
                    continue;
                }

                if (isset($data['error'])) {
                    throw new \Exception($errorMessage);
                }

                $text = $data['choices'][0]['message']['content'] ?? "Maaf, tidak ada respons.";

                return response()->json([
                    'content' => [['type' => 'text', 'text' => $text]]
                ], 200);

            } catch (\Exception $e) {
                if ($index === array_key_last($keys)) {
                    return response()->json(['error' => ['message' => $e->getMessage()]], 500);
                }
                continue;
            }
        }

        return response()->json([
            'error' => ['message' => 'Semua server Groq sedang sibuk. Tunggu beberapa detik lalu coba lagi. 🙏']
        ], 429);
    }
}