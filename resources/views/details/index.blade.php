<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Detail Tutorial — Tutorial App</title>
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
<body class="bg-navy min-h-screen text-gray-200 flex flex-col items-center">

    {{-- Head Bar --}}
    <header class="w-full bg-black/50 backdrop-blur-md border-b border-slate py-4 mb-10">
        <div class="max-w-6xl mx-auto px-4 flex items-center justify-between">
            <div class="text-gold font-bold text-lg tracking-wider">TUTORIAL APP</div>
            
            <nav class="flex items-center gap-6">
                <a href="{{ url('/') }}" class="flex items-center gap-2 text-sm font-medium hover:text-gold transition group">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 group-hover:scale-110 transition">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                    Home
                </a>
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
        <div class="mb-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-white">{{ $tutorial->judul }}</h1>
                    <p class="text-sm text-gray-400 mt-1 uppercase tracking-widest">Detail Konten Presentasi</p>
                </div>
                <a href="{{ route('tutorials.details.create', $tutorial) }}" 
                   class="bg-gold hover:bg-yellow-600 text-black font-bold px-6 py-2.5 rounded-lg transition shadow-lg">
                    + Tambah Konten
                </a>
            </div>
        </div>

        {{-- Tabel Container --}}
        <div class="bg-slate rounded-xl shadow-2xl overflow-hidden border border-gray-700">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-black text-gold border-b border-gray-700">
                        <tr>
                            <th class="px-6 py-4 font-semibold uppercase">Order</th>
                            <th class="px-6 py-4 font-semibold uppercase">Status</th>
                            <th class="px-6 py-4 font-semibold uppercase">Tipe Konten</th>
                            <th class="px-6 py-4 font-semibold uppercase text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700">
                        @forelse ($details as $detail)
                            <tr class="hover:bg-navy/50 transition">
                                <td class="px-6 py-4 font-bold text-white text-lg">#{{ $detail->order }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 rounded text-xs font-bold uppercase {{ $detail->status == 'show' ? 'bg-green-900/50 text-green-400 border border-green-500/30' : 'bg-gray-800 text-gray-400 border border-gray-700' }}">
                                        {{ $detail->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-wrap gap-2">
                                        @if($detail->text) <span class="bg-black text-gray-300 text-[10px] px-2 py-0.5 rounded border border-gray-700">TEXT</span> @endif
                                        @if($detail->gambar) <span class="bg-black text-gray-300 text-[10px] px-2 py-0.5 rounded border border-gray-700">IMAGE</span> @endif
                                        @if($detail->code) <span class="bg-black text-gray-300 text-[10px] px-2 py-0.5 rounded border border-gray-700">CODE</span> @endif
                                        @if($detail->url) <span class="bg-black text-gray-300 text-[10px] px-2 py-0.5 rounded border border-gray-700">URL</span> @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center gap-4">
                                        <a href="{{ route('tutorials.details.edit', [$tutorial, $detail]) }}" class="text-blue-400 hover:text-blue-300 transition">Edit</a>
                                        <form action="{{ route('tutorials.details.destroy', [$tutorial, $detail]) }}" method="POST" onsubmit="return confirm('Hapus konten ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-400 hover:text-red-300 transition">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center text-gray-500 italic">Belum ada detail konten.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>