<?php

namespace App\Jobs;

use Dom\Text;
use Exception;
use Throwable;
use App\Models\offre;
use App\Models\worker;
use Smalot\PdfParser\Parser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CvFilter implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3; // Add retry attempts
    public $maxExceptions = 2; // Max exceptions before failing
    public $timeout = 500;
    public function __construct(public worker $worker,public String $cvText)
    {

    }




//189386

    public function handle()
    {
        try {
            $offer = DB::table('offres')->find($this->worker->concernedoffre);

            $analysis = $this->callHuggingFaceAPI($this->cvText, $offer);


            $this->worker->AI_label = $this->determineAILabel($analysis);

            $this->worker->save();

        } catch (\Exception $e) {
            $this->handleFailure($e);
        }
    }

    protected function callHuggingFaceAPI(string $cvText, object $offer): array
    {
        try {
            $response = Http::timeout(120)
                ->retry(2, 500)
                ->withHeaders([
                    'Authorization' => 'Bearer ' . config('services.huggingface.key'),
                    'Content-Type' => 'application/json',
                ])
                ->post('https://api-inference.huggingface.co/models/facebook/bart-large-mnli', [
                    'inputs' => $cvText,
                    'parameters' => [
                        'candidate_labels' => explode(',', $offer->skills),
                        'multi_label' => true,
                    ]
                ]);

            if ($response->successful()) {
                return $response->json();
            }

            return $this->generateFallbackAnalysis($offer);

        } catch (\Exception $e) {
            Log::error("HF API Call Failed", ['error' => $e->getMessage()]);
            return $this->generateFallbackAnalysis($offer);
        }
    }

    protected function determineAILabel(array $analysis): string
    {
        // Extract match score from API response or fallback
        $score = $analysis['score'] ??
                ($analysis['match_score'] ??
                (max($analysis['scores'] ?? [0]) * 100));

        // Determine label based on score
        if ($score >= 70) return 'match';
        if ($score <= 40) return 'not_match';
        return 'neutral';
    }

    protected function generateFallbackAnalysis(object $offer): array
    {
        $skills = explode(',', $offer->skills);
        shuffle($skills);

        return [
            'match_score' => rand(30, 80),
            'matched_skills' => array_slice($skills, 0, 3),
            'missing_skills' => array_slice($skills, 3),
            'is_fallback' => true,
            'timestamp' => now()->toDateTimeString()
        ];
    }

    protected function handleFailure(\Exception $e)
    {
        $this->worker->update([
            'AI_label' => 'neutral']
            )
      ;

        $this->release(60);
        throw $e;
    }

    public function failed(Throwable $exception)
    {
        $this->worker->update([
            'AI_label' => 'neutral',

        ]);
    }
}
