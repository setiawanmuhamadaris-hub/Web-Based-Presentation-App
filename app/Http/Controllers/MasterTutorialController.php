<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMasterTutorialRequest;
use App\Http\Requests\UpdateMasterTutorialRequest;
use App\Models\MasterTutorial;
use App\Services\AuthService;
use App\Services\MatkulService;

class MasterTutorialController extends Controller
{
    public function __construct(
        private readonly AuthService  $authService,
        private readonly MatkulService $matkulService,
    ) {}

    public function index()
    {
        $tutorials = MasterTutorial::latest()->paginate(15);
        return view('tutorials.index', compact('tutorials'));
    }

    public function create()
    {
        $matkuls = $this->matkulService->getAll();
        return view('tutorials.create', compact('matkuls'));
    }

    public function store(StoreMasterTutorialRequest $request)
    {
        $data = $request->validated();
        $data['creator_email'] = $this->authService->getUser()['email'] ?? '';

        MasterTutorial::create($data);

        return redirect()->route('tutorials.index')
            ->with('success', 'Tutorial berhasil dibuat.');
    }

    public function show(MasterTutorial $tutorial)
    {
        $tutorial->load('details');
        return view('tutorials.show', compact('tutorial'));
    }

    public function edit(MasterTutorial $tutorial)
    {
        $matkuls = $this->matkulService->getAll();
        return view('tutorials.edit', compact('tutorial', 'matkuls'));
    }

    public function update(UpdateMasterTutorialRequest $request, MasterTutorial $tutorial)
    {
        $tutorial->update($request->validated());

        return redirect()->route('tutorials.show', $tutorial)
            ->with('success', 'Tutorial berhasil diperbarui.');
    }

    public function destroy(MasterTutorial $tutorial)
    {
        $tutorial->delete();

        return redirect()->route('tutorials.index')
            ->with('success', 'Tutorial berhasil dihapus.');
    }
}