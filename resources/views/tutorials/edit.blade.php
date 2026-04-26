<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Edit Tutorial</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 min-h-screen">

    <nav class="bg-white border-b border-slate-200 px-6 py-4 flex items-center justify-between shadow-sm">
        <h1 class="text-lg font-bold text-slate-800">Tutorial App</h1>
        <a href="{{ route('logout') }}"
           class="text-sm text-red-500 hover:text-red-700 font-medium transition">Logout</a>
    </nav>

    <div class="max-w-2xl mx-auto px-4 py-8">

        <div class="mb-6 flex items-center gap-3">
            <a href="{{ route('tutorials.index') }}"
               class="text-slate-400 hover:text-slate-600 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <h2 class="text-xl font-bold text-slate-800">Edit Tutorial</h2>
        </div>

        <div class="bg-white rounded-2xl shadow-sm p-8">

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
                    <label class="block text-sm font-medium text-slate-700 mb-1">Judul</label>
                    <input type="text" name="judul"
                           value="{{ old('judul', $tutorial->judul) }}"
                           placeholder="Masukkan judul tutorial"
                           class="w-full px-3.5 py-2.5 border rounded-lg text-sm text-slate-800
                                  placeholder-slate-400 focus:outline-none focus:ring-2
                                  focus:ring-blue-500 focus:border-transparent
                                  {{ $errors->has('judul') ? 'border-red-400 bg-red-50' : 'border-slate-300' }}"/>
                </div>

                {{-- Kode Matkul --}}
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Kode Mata Kuliah</label>
                    <select name="kode_matkul"
                            class="w-full px-3.5 py-2.5 border rounded-lg text-sm text-slate-800
                                   focus:outline-none focus:ring-2 focus:ring-blue-500
                                   focus:border-transparent
                                   {{ $errors->has('kode_matkul') ? 'border-red-400 bg-red-50' : 'border-slate-300' }}">
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
                    <label class="block text-sm font-medium text-slate-700 mb-1">URL Presentation</label>
                    <input type="text" name="url_presentation"
                           value="{{ old('url_presentation', $tutorial->url_presentation) }}"
                           placeholder="https://..."
                           class="w-full px-3.5 py-2.5 border rounded-lg text-sm text-slate-800
                                  placeholder-slate-400 focus:outline-none focus:ring-2
                                  focus:ring-blue-500 focus:border-transparent
                                  {{ $errors->has('url_presentation') ? 'border-red-400 bg-red-50' : 'border-slate-300' }}"/>
                </div>

                {{-- Creator Email --}}
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Creator Email</label>
                    <input type="email" name="creator_email"
                           value="{{ old('creator_email', $tutorial->creator_email) }}"
                           placeholder="contoh@email.com"
                           class="w-full px-3.5 py-2.5 border rounded-lg text-sm text-slate-800
                                  placeholder-slate-400 focus:outline-none focus:ring-2
                                  focus:ring-blue-500 focus:border-transparent
                                  {{ $errors->has('creator_email') ? 'border-red-400 bg-red-50' : 'border-slate-300' }}"/>
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="submit"
                            class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold
                                   py-2.5 rounded-lg text-sm transition">
                        Perbarui
                    </button>
                    <a href="{{ route('tutorials.index') }}"
                       class="flex-1 text-center bg-slate-100 hover:bg-slate-200 text-slate-700
                              font-semibold py-2.5 rounded-lg text-sm transition">
                        Batal
                    </a>
                </div>

            </form>
        </div>
    </div>
</body>
</html>