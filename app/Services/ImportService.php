<?php

namespace App\Services;

use App\EventEnum;
use App\Jobs\ImportJob;
use Exception;
use Illuminate\Support\Facades\Storage;

class ImportService
{
    /**
     * Importing csv event reminder data
     * @param $filePath
     * @throws Exception
     */
    public function import($filePath): void
    {
        // Checking if file exists
        if (!Storage::exists($filePath)) {
            throw new Exception("File not found");
        }

        $file = fopen(Storage::path($filePath), 'r');

        if (!$file) {
            throw new Exception("Failed to open file: $filePath");
        }

        // Skip the header row
        $header = fgetcsv($file);
        if (!$header) {
            throw new Exception("Failed to read CSV header");
        }

        $chunkSize = 100; // Number of rows per chunk
        $chunk = [];

        while ($row = fgetcsv($file)) {
            $data = [
                'user_id'     => auth()->user()->id,
                'event_id'    => 'EVT-' . uniqid(),
                'title'       => $row[1],
                'description' => $row[2],
                'date'        => $row[3],
                'recipients'  => json_decode($row[4]),
                'status'      => EventEnum::UPCOMING->value,
            ];

            $chunk[] = $data;

            if (count($chunk) >= $chunkSize) {
                // Dispatch job for processing the chunk
                ImportJob::dispatch($chunk);
                $chunk = []; // Reset chunk
            }
        }

        // Dispatch remaining chunk if not empty
        if (!empty($chunk)) {
            ImportJob::dispatch($chunk);
        }

        fclose($file);
    }
}
