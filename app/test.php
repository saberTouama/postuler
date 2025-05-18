<?php

use Illuminate\Support\Facades\Http;

//require 'vendor/autoload.php';

$token = getenv('HF_API_KEY');

$response = Http::withHeaders([
    'Authorization' => 'Bearer ' . $token,
])->post('https://api-inference.huggingface.co/models/gpt2', [
    'inputs' => 'Hello, how are you?'
]);

echo $response->status() . "\n";
echo $response->body() . "\n";
