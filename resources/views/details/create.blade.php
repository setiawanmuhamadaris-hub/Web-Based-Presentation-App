<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Tambah Detail Tutorial</title>
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
            <a href="{{ route('tutorials.details.index', $tutorial) }}" class="text-t_gold hover:text-white transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <div>
                <h2 class="text-xl font-bold text-white">Tambah Detail Tutorial</h2>
                <p class="text-sm text-t_gold mt-0.5">{{ $tutorial->judul }}</p>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-2xl p-8 border-t-4 border-t_gold">
            @if ($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 text-red-700 text-sm rounded-lg px-4 py-3">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('tutorials.details.store', $tutorial) }}" enctype="multipart/form-data" class="space-y-5">
                @csrf
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-bold text-t_navy mb-1">Order</label>
                        <input type="number" name="order" value="{{ old('order') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-t_gold"/>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-t_navy mb-1">Status</label>
                        <select name="status" class="w-full px-4 py-3 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-t_gold">
                            <option value="hide" {{ old('status', 'hide') === 'hide' ? 'selected' : '' }}>Hide</option>
                            <option value="show" {{ old('status') === 'show' ? 'selected' : '' }}>Show</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-bold text-t_navy mb-1">Text <span class="text-gray-400 font-normal">(opsional)</span></label>
                    <textarea name="text" rows="4" class="w-full px-4 py-3 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-t_gold">{{ old('text') }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-bold text-t_navy mb-1">Gambar <span class="text-gray-400 font-normal">(opsional, maks 2MB)</span></label>
                    <input type="file" name="gambar" accept="image/jpeg,image/png,image/jpg" class="w-full text-sm border border-gray-300 rounded-lg px-3 py-2"/>
                </div>
                <div>
                    <label class="block text-sm font-bold text-t_navy mb-1">Code <span class="text-gray-400 font-normal">(opsional)</span></label>
                    <textarea name="code" rows="5" class="w-full px-4 py-3 border border-gray-300 rounded-lg text-sm font-mono focus:outline-none focus:ring-2 focus:ring-t_gold">{{ old('code') }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-bold text-t_navy mb-1">URL <span class="text-gray-400 font-normal">(opsional)</span></label>
                    <input type="text" name="url" value="{{ old('url') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-t_gold"/>
                </div>
                <div class="flex gap-3 pt-4">
                    <button type="submit" class="flex-1 bg-t_navy hover:bg-t_black text-white font-bold py-3 rounded-lg text-sm transition">Simpan</button>
                    <a href="{{ route('tutorials.details.index', $tutorial) }}" class="flex-1 text-center bg-gray-200 hover:bg-gray-300 text-t_slate font-bold py-3 rounded-lg text-sm transition">Batal</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>