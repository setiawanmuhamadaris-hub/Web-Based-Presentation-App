<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Detail Tutorial</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 min-h-screen">

    <nav class="bg-white border-b border-slate-200 px-6 py-4 flex items-center justify-between shadow-sm">
        <h1 class="text-lg font-bold text-slate-800">Tutorial App</h1>
        <a href="{{ route('logout') }}"
           class="text-sm text-red-500 hover:text-red-700 font-medium transition">Logout</a>
    </nav>

    <div class="max-w-6xl mx-auto px-4 py-8">

        {{-- Breadcrumb --}}
        <div class="flex items-center gap-2 text-sm text-slate-500 mb-6">
            <a href="{{ route('tutorials.index') }}" class="hover:text-blue-600 transition">Master Tutorial</a>
            <span>/</span>
            <span class="text-slate-800 font-medium truncate">{{ $tutorial->judul }}</span>
        </div>

        {{-- Header --}}
        <div class="flex items-start justify-between mb-6 gap-4">
            <div>
                <h2 class="text-xl font-bold text-slate-800">Detail Tutorial</h2>
                <p class="text-sm text-slate-500 mt-0.5">
                    <span class="bg-blue-100 text-blue-700 text-xs font-semibold px-2 py-0.5 rounded-full">
                        {{ $tutorial->kode_matkul }}
                    </span>
                    <span class="ml-2">{{ $tutorial->judul }}</span>
                </p>
            </div>
            <a href="{{ route('tutorials.details.create', $tutorial) }}"
               class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700
                      text-white text-sm font-semibold px-4 py-2.5 rounded-lg transition shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                </svg>
                Tambah Detail
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
                        <th class="px-5 py-3.5 font-semibold text-slate-600 w-16">Order</th>
                        <th class="px-5 py-3.5 font-semibold text-slate-600 w-24">Status</th>
                        <th class="px-5 py-3.5 font-semibold text-slate-600">Tipe Konten</th>
                        <th class="px-5 py-3.5 font-semibold text-slate-600 w-24 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($details as $detail)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-5 py-3.5 text-slate-700 font-medium">{{ $detail->order }}</td>
                            <td class="px-5 py-3.5">
                                @if ($detail->status === 'show')
                                    <span class="bg-green-100 text-green-700 text-xs font-semibold
                                                 px-2.5 py-1 rounded-full">Show</span>
                                @else
                                    <span class="bg-slate-100 text-slate-500 text-xs font-semibold
                                                 px-2.5 py-1 rounded-full">Hide</span>
                                @endif
                            </td>
                            <td class="px-5 py-3.5">
                                <div class="flex flex-wrap gap-1.5">
                                    @if ($detail->text)
                                        <span class="bg-purple-100 text-purple-700 text-xs
                                                     font-medium px-2 py-0.5 rounded">Text</span>
                                    @endif
                                    @if ($detail->gambar)
                                        <span class="bg-pink-100 text-pink-700 text-xs
                                                     font-medium px-2 py-0.5 rounded">Gambar</span>
                                    @endif
                                    @if ($detail->code)
                                        <span class="bg-amber-100 text-amber-700 text-xs
                                                     font-medium px-2 py-0.5 rounded">Code</span>
                                    @endif
                                    @if ($detail->url)
                                        <span class="bg-cyan-100 text-cyan-700 text-xs
                                                     font-medium px-2 py-0.5 rounded">URL</span>
                                    @endif
                                    @if (!$detail->text && !$detail->gambar && !$detail->code && !$detail->url)
                                        <span class="text-slate-400 text-xs">—</span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-5 py-3.5">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('tutorials.details.edit', [$tutorial, $detail]) }}"
                                       class="text-xs font-semibold text-amber-600 hover:text-amber-800
                                              bg-amber-50 hover:bg-amber-100 px-3 py-1.5 rounded-lg transition">
                                        Edit
                                    </a>
                                    <form action="{{ route('tutorials.details.destroy', [$tutorial, $detail]) }}"
                                          method="POST"
                                          onsubmit="return confirm('Hapus detail ini?')">
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
                            <td colspan="4" class="px-5 py-10 text-center text-slate-400">
                                Belum ada detail tutorial.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            @if ($details->hasPages())
                <div class="px-5 py-4 border-t border-slate-100">
                    {{ $details->links() }}
                </div>
            @endif
        </div>

    </div>
</body>
</html>