<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Master Tutorial</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 min-h-screen">

    {{-- Navbar --}}
    <nav class="bg-white border-b border-slate-200 px-6 py-4 flex items-center justify-between shadow-sm">
        <h1 class="text-lg font-bold text-slate-800">Tutorial App</h1>
        <a href="{{ route('logout') }}"
           class="text-sm text-red-500 hover:text-red-700 font-medium transition">
            Logout
        </a>
    </nav>

    <div class="max-w-6xl mx-auto px-4 py-8">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-bold text-slate-800">Daftar Master Tutorial</h2>
            <a href="{{ route('tutorials.create') }}"
               class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700
                      text-white text-sm font-semibold px-4 py-2.5 rounded-lg transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Tutorial
            </a>
        </div>

        {{-- Alert --}}
        @if (session('success'))
            <div class="mb-5 bg-green-50 border border-green-200 text-green-700
                        text-sm rounded-lg px-4 py-3">
                {{ session('success') }}
            </div>
        @endif

        {{-- Table --}}
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
            <table class="w-full text-sm text-left">
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th class="px-5 py-3.5 font-semibold text-slate-600">#</th>
                        <th class="px-5 py-3.5 font-semibold text-slate-600">Judul</th>
                        <th class="px-5 py-3.5 font-semibold text-slate-600">Kode Matkul</th>
                        <th class="px-5 py-3.5 font-semibold text-slate-600">URL Presentation</th>
                        <th class="px-5 py-3.5 font-semibold text-slate-600">Creator</th>
                        <th class="px-5 py-3.5 font-semibold text-slate-600 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($tutorials as $tutorial)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-5 py-3.5 text-slate-500">
                                {{ ($tutorials->currentPage() - 1) * $tutorials->perPage() + $loop->iteration }}
                            </td>
                            <td class="px-5 py-3.5 font-medium text-slate-800">{{ $tutorial->judul }}</td>
                            <td class="px-5 py-3.5">
                                <span class="bg-blue-100 text-blue-700 text-xs font-semibold
                                             px-2.5 py-1 rounded-full">
                                    {{ $tutorial->kode_matkul }}
                                </span>
                            </td>
                            <td class="px-5 py-3.5 text-slate-500 truncate max-w-xs">
                                <a href="{{ $tutorial->url_presentation }}" target="_blank"
                                   class="text-blue-500 hover:underline">
                                    {{ $tutorial->url_presentation }}
                                </a>
                            </td>
                            <td class="px-5 py-3.5 text-slate-500">{{ $tutorial->creator_email }}</td>
                            <td class="px-5 py-3.5">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('tutorials.edit', $tutorial) }}"
                                       class="text-xs font-semibold text-amber-600 hover:text-amber-800
                                              bg-amber-50 hover:bg-amber-100 px-3 py-1.5 rounded-lg transition">
                                        Edit
                                    </a>
                                    <form action="{{ route('tutorials.destroy', $tutorial) }}"
                                          method="POST"
                                          onsubmit="return confirm('Hapus tutorial ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="text-xs font-semibold text-red-600 hover:text-red-800
                                                       bg-red-50 hover:bg-red-100 px-3 py-1.5 rounded-lg transition">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-10 text-center text-slate-400">
                                Belum ada data tutorial.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Pagination --}}
            @if ($tutorials->hasPages())
                <div class="px-5 py-4 border-t border-slate-100">
                    {{ $tutorials->links() }}
                </div>
            @endif
        </div>

    </div>
</body>
</html>