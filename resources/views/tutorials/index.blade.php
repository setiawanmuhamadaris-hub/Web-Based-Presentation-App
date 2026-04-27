<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Master Tutorial — Tutorial App</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        navy: '#0A2031',
                        slate: '#334756',
                        gold: '#EFA501',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-navy min-h-screen font-sans text-gray-200 flex flex-col items-center">

    {{-- Head Bar --}}
    <header class="w-full bg-black/50 backdrop-blur-md border-b border-slate py-4 mb-10">
        <div class="max-w-6xl mx-auto px-4 flex items-center justify-between">
            <div class="text-gold font-bold text-lg tracking-wider">PRESENTATION APP</div>
            
            <nav class="flex items-center gap-6">
                {{-- Tombol Home --}}
                <a href="{{ url('/') }}" class="flex items-center gap-2 text-sm font-medium hover:text-gold transition group">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 group-hover:scale-110 transition">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                    Home
                </a>

                {{-- Tombol Logout --}}
                <a href="{{ route('logout') }}" class="flex items-center gap-2 text-sm font-medium text-red-400 hover:text-red-300 transition group">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 group-hover:translate-x-1 transition">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                    </svg>
                    Log Out
                </a>
            </nav>
        </div>
    </header>

    <div class="max-w-6xl w-full px-4 pb-10">
        {{-- Bagian Judul & Tambah Data --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
            <div>
                <h1 class="text-2xl font-bold text-white">Master Tutorial</h1>
                <p class="text-sm text-gray-400 mt-1">Kelola daftar tutorial utama aplikasi Anda</p>
            </div>
            <a href="{{ route('tutorials.create') }}" 
               class="inline-flex items-center justify-center px-6 py-2.5 bg-gold hover:bg-yellow-600 text-black font-bold rounded-lg transition shadow-lg">
                + Tambah Tutorial
            </a>
        </div>

        {{-- Tabel Container --}}
        <div class="bg-slate rounded-xl shadow-2xl overflow-hidden border border-gray-700">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-black text-gold border-b border-gray-700">
                        <tr>
                            <th class="px-6 py-4 font-semibold uppercase tracking-wider">#</th>
                            <th class="px-6 py-4 font-semibold uppercase tracking-wider">Judul</th>
                            <th class="px-6 py-4 font-semibold uppercase tracking-wider">Kode Matkul</th>
                            <th class="px-6 py-4 font-semibold uppercase tracking-wider">URL Presentation</th>
                            <th class="px-6 py-4 font-semibold uppercase tracking-wider text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700">
                        @forelse ($tutorials as $tutorial)
                            <tr class="hover:bg-navy/50 transition">
                                <td class="px-6 py-4 text-gray-400">
                                    {{ ($tutorials->currentPage() - 1) * $tutorials->perPage() + $loop->iteration }}
                                </td>
                                <td class="px-6 py-4 font-medium text-white">
                                    {{ $tutorial->judul }}
                                </td>
                                <td class="px-6 py-4">
                                    <span class="bg-black text-gold px-2 py-1 rounded text-xs font-bold border border-gold/30">
                                        {{ $tutorial->kode_matkul }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-gray-400 truncate max-w-xs">
                                    {{ $tutorial->url_presentation }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-3">
                                        <a href="{{ route('tutorials.details.index', $tutorial->id) }}" class="text-gold hover:text-white transition font-semibold">Kelola</a>
                                        <a href="{{ route('tutorials.edit', $tutorial) }}" class="text-blue-400 hover:text-blue-300 transition">Edit</a>
                                        <form action="{{ route('tutorials.destroy', $tutorial) }}" method="POST" onsubmit="return confirm('Hapus tutorial ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-400 hover:text-red-300 transition">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-10 text-center text-gray-500 italic">
                                    Belum ada data tutorial.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>