<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Edit Tutorial</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-t_navy min-h-screen"">
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Edit Tutorial</title>
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
            <h2 class="text-xl font-bold text-white">Edit Tutorial</h2>
        </div>

        <div class="bg-white rounded-xl shadow-2xl p-8 border-t-4 border-t_gold">
            @if ($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 text-red-700 text-sm rounded-lg px-4 py-3">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('tutorials.update', $tutorial) }}" class="space-y-5">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-sm font-bold text-t_navy mb-1">Judul</label>
                    <input type="text" name="judul" value="{{ old('judul', $tutorial->judul) }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-t_gold"/>
                </div>
                <div>
                    <label class="block text-sm font-bold text-t_navy mb-1">Kode Mata Kuliah</label>
                    <select name="kode_matkul" class="w-full px-4 py-3 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-t_gold">
                        <option value="">-- Pilih Mata Kuliah --</option>
                        @foreach ($makulList as $makul)
                            <option value="{{ $makul['kdmk'] }}" {{ old('kode_matkul', $tutorial->kode_matkul) == $makul['kdmk'] ? 'selected' : '' }}>{{ $makul['nama'] }} ({{ $makul['kdmk'] }})</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-bold text-t_navy mb-1">URL Presentation</label>
                    <input type="text" name="url_presentation" value="{{ old('url_presentation', $tutorial->url_presentation) }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-t_gold"/>
                </div>
                <div>
                    <label class="block text-sm font-bold text-t_navy mb-1">Creator Email</label>
                    <input type="email" name="creator_email" value="{{ old('creator_email', $tutorial->creator_email) }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-t_gold"/>
                </div>
                <div class="flex gap-3 pt-4">
                    <button type="submit" class="flex-1 bg-t_navy hover:bg-t_black text-white font-bold py-3 rounded-lg text-sm transition">Perbarui</button>
                    <a href="{{ route('tutorials.index') }}" class="flex-1 text-center bg-gray-200 hover:bg-gray-300 text-t_slate font-bold py-3 rounded-lg text-sm transition">Batal</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
    <nav class="border-b px-6 py-4 flex items-center justify-between shadow-sm" style="background-color: #ffffff; border-color: #334756;">
        <h1 class="text-lg font-bold" style="color: #0A2031;">Tutorial App</h1>
        <a href="{{ route('logout') }}"
           class="inline-flex items-center justify-center w-10 h-10 rounded-lg transition"
           title="Logout"
           style="background-color: #EFA501; color: white; text-decoration: none;"
           onmouseover="this.style.backgroundColor='#d68900'; this.style.transform='scale(1.05)';"
           onmouseout="this.style.backgroundColor='#EFA501'; this.style.transform='scale(1);">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                <path d="M17 7l-1.41 1.41L18.17 11H8v2h10.17l-2.58 2.58L17 17l5-5zM4 5h8V3H4c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h8v-2H4V5z"/>
            </svg>
        </a>
    </nav>

    <div class="max-w-2xl mx-auto px-4 py-8">

        <div class="mb-6 flex items-center gap-3">
            <a href="{{ route('tutorials.index') }}"
               class="transition" style="color: #999;">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <h2 class="text-xl font-bold" style="color: #0A2031;">Edit Tutorial</h2>
        </div>

        <div class="bg-white rounded-2xl shadow-sm p-8" style="background-color: #ffffff;">

            @if ($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 text-red-700 text-sm rounded-lg px-4 py-3">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('tutorials.update', $tutorial) }}" class="space-y-5">
                @csrf
                @method('PUT')

                {{-- Judul --}}
                <div>
                    <label class="block text-sm font-medium mb-1" style="color: #0A2031;">Judul</label>
                    <input type="text" name="judul"
                           value="{{ old('judul', $tutorial->judul) }}"
                           placeholder="Masukkan judul tutorial"
                           class="w-full px-3.5 py-2.5 border rounded-lg text-sm" 
                           style="border-color: #334756; color: #0A2031; background-color: #ffffff;" 
                           onfocus="this.style.borderColor='#EFA501'; this.style.boxShadow='0 0 0 3px rgba(239, 165, 1, 0.1)';" 
                           onblur="this.style.borderColor='#334756'; this.style.boxShadow='none';"
                           {{ $errors->has('judul') ? 'style="border-color: #dc3545;"' : '' }}/>
                </div>

                {{-- Kode Matkul --}}
                <div>
                    <label class="block text-sm font-medium mb-1" style="color: #0A2031;">Kode Mata Kuliah</label>
                    <select name="kode_matkul"
                            class="w-full px-3.5 py-2.5 border rounded-lg text-sm" 
                            style="border-color: #334756; color: #0A2031; background-color: #ffffff;" 
                            onfocus="this.style.borderColor='#EFA501'; this.style.boxShadow='0 0 0 3px rgba(239, 165, 1, 0.1)';" 
                            onblur="this.style.borderColor='#334756'; this.style.boxShadow='none';"
                            {{ $errors->has('kode_matkul') ? 'style="border-color: #dc3545;"' : '' }}>
                        <option value="">-- Pilih Mata Kuliah --</option>
                        @foreach ($makulList as $makul)
                            <option value="{{ $makul['kdmk'] }}"
                                {{ old('kode_matkul', $tutorial->kode_matkul) == $makul['kdmk'] ? 'selected' : '' }}>
                                {{ $makul['nama'] }} ({{ $makul['kdmk'] }})
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- URL Presentation --}}
                <div>
                    <label class="block text-sm font-medium mb-1" style="color: #0A2031;">URL Presentation</label>
                    <input type="text" name="url_presentation"
                           value="{{ old('url_presentation', $tutorial->url_presentation) }}"
                           placeholder="https://..."
                           class="w-full px-3.5 py-2.5 border rounded-lg text-sm" 
                           style="border-color: #334756; color: #0A2031; background-color: #ffffff;" 
                           onfocus="this.style.borderColor='#EFA501'; this.style.boxShadow='0 0 0 3px rgba(239, 165, 1, 0.1)';" 
                           onblur="this.style.borderColor='#334756'; this.style.boxShadow='none';"
                           {{ $errors->has('url_presentation') ? 'style="border-color: #dc3545;"' : '' }}/>
                </div>

                {{-- Creator Email --}}
                <div>
                    <label class="block text-sm font-medium mb-1" style="color: #0A2031;">Creator Email</label>
                    <input type="email" name="creator_email"
                           value="{{ old('creator_email', $tutorial->creator_email) }}"
                           placeholder="contoh@email.com"
                           class="w-full px-3.5 py-2.5 border rounded-lg text-sm" 
                           style="border-color: #334756; color: #0A2031; background-color: #ffffff;" 
                           onfocus="this.style.borderColor='#EFA501'; this.style.boxShadow='0 0 0 3px rgba(239, 165, 1, 0.1)';" 
                           onblur="this.style.borderColor='#334756'; this.style.boxShadow='none';"
                           {{ $errors->has('creator_email') ? 'style="border-color: #dc3545;"' : '' }}/>
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="submit"
                            class="flex-1 text-white font-semibold py-2.5 rounded-lg text-sm transition"
                            style="background-color: #0A2031;"
                            onmouseover="this.style.backgroundColor='#082442';"
                            onmouseout="this.style.backgroundColor='#0A2031';">
                        Perbarui
                    </button>
                    <a href="{{ route('tutorials.index') }}"
                       class="flex-1 text-center font-semibold py-2.5 rounded-lg text-sm transition"
                       style="background-color: #334756; color: #ffffff;"
                       onmouseover="this.style.backgroundColor='#445c6f';"
                       onmouseout="this.style.backgroundColor='#334756';">
                        Batal
                    </a>
                </div>

            </form>
        </div>
    </div>
</body>
</html>