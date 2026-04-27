<?php

namespace App\Http\Controllers;

use App\Models\MasterTutorial;

class PresentationController extends Controller
{
    public function show(string $url_presentation)
    {
        $tutorial = MasterTutorial::where('url_presentation', $url_presentation)->firstOrFail();

        $details = $tutorial->details()->where('status', 'show')->orderBy('order', 'asc')->get();

        return view('presentation.show', compact('tutorial', 'details'));
    }
}