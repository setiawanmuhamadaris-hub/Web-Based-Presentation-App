<?php

namespace App\Http\Controllers;

use App\Models\MasterTutorial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MasterTutorialController extends Controller
{
    private function fetchMakul(): array
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('refresh_token'),
        ])->get('https://jwt-auth-eight-neon.vercel.app/getMakul');

        // Tambahkan argumen 'data' pada metode json() untuk mengekstrak array mata kuliah
        return $response->successful() ? ($response->json('data') ?? []) : [];
    }

    public function index()
    {
        $tutorials = MasterTutorial::latest()->paginate(10);
        return view('tutorials.index', compact('tutorials'));
    }

    public function create()
    {
        $makulList = $this->fetchMakul();
        return view('tutorials.create', compact('makulList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'            => 'required|string|max:255',
            'kode_matkul'      => 'required|string|max:255',
            'url_presentation' => 'required|string|max:255|unique:master_tutorials,url_presentation',
            'creator_email'    => 'required|email|max:255',
        ]);

        MasterTutorial::create([
            'judul'            => $request->judul,
            'kode_matkul'      => $request->kode_matkul,
            'url_presentation' => $request->url_presentation,
            'url_finished'     => $request->url_presentation,
            'creator_email'    => $request->creator_email,
        ]);

        return redirect()->route('tutorials.index')
                         ->with('success', 'Tutorial berhasil ditambahkan.');
    }

    public function show(MasterTutorial $tutorial)
    {
        return redirect()->route('tutorials.index');
    }

    public function edit(MasterTutorial $tutorial)
    {
        $makulList = $this->fetchMakul();
        return view('tutorials.edit', compact('tutorial', 'makulList'));
    }

    public function update(Request $request, MasterTutorial $tutorial)
    {
        $request->validate([
            'judul'            => 'required|string|max:255',
            'kode_matkul'      => 'required|string|max:255',
            'url_presentation' => 'required|string|max:255|unique:master_tutorials,url_presentation,' . $tutorial->id,
            'creator_email'    => 'required|email|max:255',
        ]);

        $tutorial->update([
            'judul'            => $request->judul,
            'kode_matkul'      => $request->kode_matkul,
            'url_presentation' => $request->url_presentation,
            'creator_email'    => $request->creator_email,
        ]);

        return redirect()->route('tutorials.index')
                         ->with('success', 'Tutorial berhasil diperbarui.');
    }

    public function destroy(MasterTutorial $tutorial)
    {
        $tutorial->delete();

        return redirect()->route('tutorials.index')
                         ->with('success', 'Tutorial berhasil dihapus.');
    }
}
