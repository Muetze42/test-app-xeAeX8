<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DefaultController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|Factory|View|Application
     */
    public function index()
    {
        return view('welcome');
    }

    /**
     * @return StreamedResponse
     */
    public function download()
    {
        $file = 'video.mp4';
        if (!Storage::exists($file)) {
            $file = 'image.jpg';
        }
        if (!Storage::exists($file)) {
            abort(404);
        }

        $fileName = Str::random().'.'.pathinfo(Storage::path($file), PATHINFO_EXTENSION);

        return Storage::download($file, $fileName);
    }
}
