<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class FileController extends Controller
{
    public function download(Request $request): \Illuminate\Http\Response|StreamedResponse
    {
        $file = $request->input('file');

        if (! Storage::has($file)) {
            return response()->noContent();
        }

        return Storage::download($file);
    }
}
