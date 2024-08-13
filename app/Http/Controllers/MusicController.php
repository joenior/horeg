<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Events\MusicProcessingProgress;

class MusicController extends Controller
{
    public function showUploadForm()
    {
        return view('upload');
    }

    public function processMusic(Request $request)
    {
        Log::info('Processing music upload');

        // Validasi file
        $request->validate([
            'musicFile' => 'required|mimes:mp3|max:10240', // Maks 10MB
        ]);

        Log::info('File validated');

        // Upload file
        $file = $request->file('musicFile');
        $originalFilename = $file->getClientOriginalName();
        $filePath = $file->storeAs('uploads', $originalFilename);

        Log::info('File uploaded to ' . $filePath);

        // Proses file untuk menambahkan efek bass boost
        $outputFilename = 'bassboosted_' . $originalFilename;
        $outputPath = 'processed/' . $outputFilename;

        Log::info('Processing file with FFMpeg');

        FFMpeg::fromDisk('local')
            ->open($filePath)
            ->addFilter(['-af', 'bass=g=10'])
            ->export()
            ->toDisk('local')
            ->inFormat(new \FFMpeg\Format\Audio\Mp3)
            ->onProgress(function ($percentage) {
                event(new MusicProcessingProgress($percentage));
            })
            ->save($outputPath);

        Log::info('File processed and saved to ' . $outputPath);

        // Hapus file asli (opsional)
        Storage::disk('local')->delete($filePath);

        Log::info('Original file deleted');

        // Kembalikan link untuk mengunduh file yang sudah diproses
        return response()->download(storage_path("app/$outputPath"))->deleteFileAfterSend(true);
    }
}