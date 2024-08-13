<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use FFMpeg;
use Illuminate\Support\Facades\Storage;

class MusicController extends Controller
{
    public function showUploadForm()
    {
        return view('upload');
    }

    public function processMusic(Request $request)
    {
        // Validasi file
        $request->validate([
            'musicFile' => 'required|mimes:mp3|max:10240', // Maks 10MB
        ]);

        // Upload file
        $file = $request->file('musicFile');
        $originalFilename = $file->getClientOriginalName();
        $filePath = $file->storeAs('uploads', $originalFilename);

        // Proses file untuk menambahkan efek bass boost
        $outputFilename = 'bassboosted_' . $originalFilename;
        $outputPath = 'processed/' . $outputFilename;

        FFMpeg::fromDisk('local')
            ->open($filePath)
            ->addFilter('-af', 'bass=g=10')
            ->export()
            ->toDisk('local')
            ->inFormat(new \FFMpeg\Format\Audio\Mp3)
            ->save($outputPath);

        // Hapus file asli (opsional)
        Storage::disk('local')->delete($filePath);

        // Kembalikan link untuk mengunduh file yang sudah diproses
        return response()->download(storage_path("app/$outputPath"))->deleteFileAfterSend(true);
    }
}
