<?php

namespace App\Http\Controllers;

use App\Models\BigUpload;
use App\Models\ImportFile;
use App\Models\StreamEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use function MongoDB\BSON\toJSON;
use Throwable;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class StreamEventController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:json,gz'
        ]);

        $path = Storage::putFile('import_files', $request->file('file'));
        $importFile = ImportFile::create([
            'filename' => $path,
            'status' => 'uploaded',
        ]);

        $handle = fopen('/var/www/html/storage/app/' . $path, "r") or die("Couldn't get handle");
        if ($handle) {
            while (!feof($handle)) {
                try {
                    $line = fgets($handle);
                    $object = json_decode($line, true);
                    StreamEvent::create([
                        'event_id' => $object['EventId'],
                        'user_id' => $object['UserId'],
                        'media_id' => $object['MediaId'],
                        'timestamp' => $object['Timestamp'],
                        'date_time' => $object['DateTime'],
                        'event_type' => $object['EventType'],
                    ]);
                } catch(Throwable $e) {
                    Log::error('Error during stream ingestion', ['error' => $e->getMessage()]);
                    continue;
                }
            }
            fclose($handle);
        }

        $importFile->status = 'processed';
        $importFile->save();

        return json_encode(['success' => true]);
    }

}
