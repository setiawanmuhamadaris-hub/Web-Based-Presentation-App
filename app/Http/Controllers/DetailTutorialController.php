<?php

namespace App\Http\Controllers;

use App\Models\MasterTutorial;
use App\Models\DetailTutorial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DetailTutorialController extends Controller
{
    public function index(MasterTutorial $tutorial)
    {
        $details = $tutorial->details()->orderBy('order')->paginate(15);
        return view('details.index', compact('tutorial', 'details'));
    }

    public function create(MasterTutorial $tutorial)
    {
        return view('details.create', compact('tutorial'));
    }

    public function store(Request $request, MasterTutorial $tutorial)
    {
        $request->validate([
            'order'  => 'required|integer',
            'status' => 'required|in:show,hide',
            'text'   => 'nullable|string',
            'code'   => 'nullable|string',
            'url'    => 'nullable|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->only(['text', 'code', 'url', 'order', 'status']);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('tutorials', 'public');
        }

        $tutorial->details()->create($data);

        return redirect()->route('tutorials.details.index', $tutorial)
                         ->with('success', 'Detail berhasil ditambahkan.');
    }

    public function show(MasterTutorial $tutorial, DetailTutorial $detail)
    {
        return redirect()->route('tutorials.details.index', $tutorial);
    }

    public function edit(MasterTutorial $tutorial, DetailTutorial $detail)
    {
        return view('details.edit', compact('tutorial', 'detail'));
    }

    public function update(Request $request, MasterTutorial $tutorial, DetailTutorial $detail)
    {
        $request->validate([
            'order'  => 'required|integer',
            'status' => 'required|in:show,hide',
            'text'   => 'nullable|string',
            'code'   => 'nullable|string',
            'url'    => 'nullable|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->only(['text', 'code', 'url', 'order', 'status']);

        if ($request->hasFile('gambar')) {
            if ($detail->gambar) {
                Storage::disk('public')->delete($detail->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('tutorials', 'public');
        }

        $detail->update($data);

        return redirect()->route('tutorials.details.index', $tutorial)
                         ->with('success', 'Detail berhasil diperbarui.');
    }

    public function destroy(MasterTutorial $tutorial, DetailTutorial $detail)
    {
        if ($detail->gambar) {
            Storage::disk('public')->delete($detail->gambar);
        }

        $detail->delete();

        return redirect()->route('tutorials.details.index', $tutorial)
                         ->with('success', 'Detail berhasil dihapus.');
    }
}