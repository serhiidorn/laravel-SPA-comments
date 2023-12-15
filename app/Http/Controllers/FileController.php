<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function download(Request $request)
    {
        $file = $request->input('file');

        if (! Storage::has($file)) {
            return response()->noContent();
        }

        return Storage::download($file);
    }
}
