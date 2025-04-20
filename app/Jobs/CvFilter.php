<?php

namespace App\Jobs;

use Exception;
use App\Models\User;
use App\Models\offre;
use App\Models\worker;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CvFilter implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct( public int $worker_id,
    public offre $offre,
    public string $cvText)
    {
        Log::info('Job Dispatched', [
            'worker_id' => $worker_id,
            'offre_id' => $offre->id,
            'cv_length' => strlen($cvText)
        ]);
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $jobDescription = "we are looking for an AI expert with 5 years experience with data analyse and ai APIs in web developement ";

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('HF_API_KEY'),
                'Content-Type' => 'application/json',
                'Wait-For-Model' => 'true' // Critical for Hugging Face
            ])
            ->timeout(60)
            ->post('https://api-inference.huggingface.co/models/MoritzLaurer/deberta-v3-base-zeroshot-v1', [
                "inputs" => "Job: {$jobDescription}\nCV: {$this->cvText}",
                "parameters" => [
                    "candidate_labels" => ["match", "not_match", "neutral"],
                    "multi_label" => false,
                ],
            ]);

            // Debug raw response
            Log::debug('HF API Raw Response', $response->json());

            if ($response->failed()) {
                throw new Exception("API error: " . $response->status());
            }

            $result = $response->json();

            // Validate API response structure
            if (!isset($result['labels'], $result['scores'])) {
                throw new Exception("Invalid API response format");
            }

            // Confidence-based decision
            $maxScore = max($result['scores']);
            $aiLabel = ($maxScore > 0.6)
                ? $result['labels'][array_search($maxScore, $result['scores'])]
                : 'neutral';
             $worker = Worker::findOrFail($this->worker_id);
            // Save result
            $worker->AI_label = $aiLabel;
            $worker->save(); // Moved inside try block

            Log::info('CV Analysis Completed', [
                'worker_id' => $this->worker_id,
                'label' => $aiLabel,
                'scores' => $result['scores']
            ]);



            // Fallback with default value
            $worker->AI_label = 'neutral';
            $worker->save();

    }
}
