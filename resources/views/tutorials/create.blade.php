<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Tambah Tutorial</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { theme: { extend: { colors: { t_navy: '#0A2031', t_slate: '#334756', t_gold: '#EFA501', t_black: '#000000' } } } }
    </script>
</head>
<body class="bg-t_navy min-h-screen">

    <nav class="bg-t_black border-b border-t_slate px-6 py-4 flex items-center justify-between shadow-sm">
        <h1 class="text-lg font-bold text-t_gold">Tutorial App</h1>
        <a href="{{ route('logout') }}" class="text-sm text-gray-300 hover:text-white font-medium transition">Logout</a>
    </nav>

    <div class="max-w-2xl mx-auto px-4 py-8">
        <div class="mb-6 flex items-center gap-3">
            <a href="{{ route('tutorials.index') }}" class="text-t_gold hover:text-white transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <h2 class="text-xl font-bold text-white">Tambah Tutorial</h2>
        </div>

        <div class="bg-white rounded-xl shadow-2xl p-8 border-t-4 border-t_gold">
            @if ($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 text-red-700 text-sm rounded-lg px-4 py-3">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('tutorials.store') }}" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-sm font-bold text-t_navy mb-1">Judul</label>
                    <input type="text" name="judul" value="{{ old('judul') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-t_gold"/>
                </div>
                <div>
                    <label class="block text-sm font-bold text-t_navy mb-1">Kode Mata Kuliah</label>
                    <select name="kode_matkul" class="w-full px-4 py-3 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-t_gold">
                        <option value="">-- Pilih Mata Kuliah --</option>
                        @foreach ($makulList as $makul)
                            <option value="{{ $makul['kdmk'] }}" {{ old('kode_matkul') == $makul['kdmk'] ? 'selected' : '' }}>{{ $makul['nama'] }} ({{ $makul['kdmk'] }})</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-bold text-t_navy mb-1">URL Presentation</label>
                    <input type="text" name="url_presentation" value="{{ old('url_presentation') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-t_gold"/>
                </div>
                <div>
                    <label class="block text-sm font-bold text-t_navy mb-1">Creator Email</label>
                    <input type="email" name="creator_email" value="{{ old('creator_email') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-t_gold"/>
                </div>
                <div class="flex gap-3 pt-4">
                    <button type="submit" class="flex-1 bg-t_navy hover:bg-t_black text-white font-bold py-3 rounded-lg text-sm transition">Simpan</button>
                    <a href="{{ route('tutorials.index') }}" class="flex-1 text-center bg-gray-200 hover:bg-gray-300 text-t_slate font-bold py-3 rounded-lg text-sm transition">Batal</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>