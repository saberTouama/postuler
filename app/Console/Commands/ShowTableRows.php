<?php

namespace App\Console\Commands;

use App\Models\offre;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;

class ShowTableRows extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'table:show {model}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle( $model)
    {
        $rows = $model::all(); // Replace with your model

    if ($rows->isEmpty()) {
        $this->info('No records found.');
        return;
    }

    // Convert nested arrays/objects into strings
    $data = $rows->map(function ($row) {
        return collect($row->getAttributes())->map(function ($value) {
            return is_array($value) || is_object($value)
                ? json_encode($value)
                : $value;
        })->toArray();
    });

    $this->table(
        array_keys($data->first()),
        $data->toArray()
    );
    }
}
