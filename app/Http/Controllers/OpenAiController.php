<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OpenAiController extends Controller
{
    public function generateText(Request $request)
    {
        $request->validate([
            'prompt' => 'required|string'
        ]);

        $endpoint = 'https://api.openai.com/v1/completions';

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . config('services.openai.api_key'),
        ])->post($endpoint, [
            'model' => 'gpt-3.5-turbo-16k',
            'prompt' => $request->input('prompt'),
            'max_tokens' => 100
        ]);

        return $response->json();
    }
}
