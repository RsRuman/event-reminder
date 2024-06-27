<?php

namespace App\Jobs;

use App\Models\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

/**
 * @property array $chunk
 */
class ImportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private array $chunk;

    /**
     * Create a new job instance.
     */
    public function __construct(array $chunk)
    {
        $this->chunk = $chunk;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach ($this->chunk as $row) {
            // Process each row and save to the database
            Event::create([
                'user_id'     => $row['user_id'],
                'event_id'    => $row['event_id'],
                'title'       => $row['title'],
                'description' => $row['description'],
                'date'        => $row['date'],
                'recipients'  => $row['date'],
                'status'      => $row['status']
            ]);
        }
    }
}
