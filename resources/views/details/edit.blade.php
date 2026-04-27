<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Edit Detail Tutorial</title>
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
            <a href="{{ route('tutorials.details.index', $tutorial) }}"
               class="text-slate-400 hover:text-slate-600 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <div>
                <h2 class="text-xl font-bold text-slate-800">Edit Detail Tutorial</h2>
                <p class="text-xs text-slate-500 mt-0.5">{{ $tutorial->judul }}</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm p-8">

            @if ($errors->any())
                <div class="mb-6 bg-red-50 border border-red-200 text-red-700
                            text-sm rounded-lg px-4 py-3">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST"
                  action="{{ route('tutorials.details.update', [$tutorial, $detail]) }}"
                  enctype="multipart/form-data"
                  class="space-y-5">
                @csrf
                @method('PUT')

                {{-- Order & Status --}}
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Order</label>
                        <input type="number" name="order"
                               value="{{ old('order', $detail->order) }}"
                               class="w-full px-3.5 py-2.5 border rounded-lg text-sm text-slate-800
                                      focus:outline-none focus:ring-2 focus:ring-blue-500
                                      focus:border-transparent
                                      {{ $errors->has('order') ? 'border-red-400 bg-red-50' : 'border-slate-300' }}"/>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Status</label>
                        <select name="status"
                                class="w-full px-3.5 py-2.5 border rounded-lg text-sm text-slate-800
                                       focus:outline-none focus:ring-2 focus:ring-blue-500
                                       focus:border-transparent
                                       {{ $errors->has('status') ? 'border-red-400 bg-red-50' : 'border-slate-300' }}">
                            <option value="hide"
                                {{ old('status', $detail->status) === 'hide' ? 'selected' : '' }}>Hide</option>
                            <option value="show"
                                {{ old('status', $detail->status) === 'show' ? 'selected' : '' }}>Show</option>
                        </select>
                    </div>
                </div>

                {{-- Text --}}
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        Text <span class="text-slate-400 font-normal">(opsional)</span>
                    </label>
                    <textarea name="text" rows="4"
                              placeholder="Isi konten teks..."
                              class="w-full px-3.5 py-2.5 border border-slate-300 rounded-lg text-sm
                                     text-slate-800 placeholder-slate-400 resize-y
                                     focus:outline-none focus:ring-2 focus:ring-blue-500
                                     focus:border-transparent">{{ old('text', $detail->text) }}</textarea>
                </div>

                {{-- Gambar --}}
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        Gambar <span class="text-slate-400 font-normal">(opsional, jpeg/png/jpg, maks 2MB)</span>
                    </label>
                    @if ($detail->gambar)
                        <div class="mb-3 flex items-center gap-3 p-3 bg-slate-50
                                    border border-slate-200 rounded-lg">
                            <img src="{{ Storage::disk('public')->url($detail->gambar) }}"
                                 alt="Gambar saat ini"
                                 class="w-16 h-16 object-cover rounded-lg border border-slate-200"/>
                            <div>
                                <p class="text-xs text-slate-500">Gambar saat ini</p>
                                <p class="text-xs text-slate-400 mt-0.5 truncate max-w-xs">
                                    {{ $detail->gambar }}
                                </p>
                            </div>
                        </div>
                    @endif
                    <input type="file" name="gambar" accept="image/jpeg,image/png,image/jpg"
                           class="w-full text-sm text-slate-600 file:mr-4 file:py-2 file:px-4
                                  file:rounded-lg file:border-0 file:text-sm file:font-semibold
                                  file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100
                                  border border-slate-300 rounded-lg px-3 py-2
                                  {{ $errors->has('gambar') ? 'border-red-400 bg-red-50' : '' }}"/>
                    @if ($detail->gambar)
                        <p class="text-xs text-slate-400 mt-1">Biarkan kosong jika tidak ingin mengganti gambar.</p>
                    @endif
                </div>

                {{-- Code --}}
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        Code <span class="text-slate-400 font-normal">(opsional)</span>
                    </label>
                    <textarea name="code" rows="5"
                              placeholder="Tulis kode di sini..."
                              class="w-full px-3.5 py-2.5 border border-slate-300 rounded-lg text-sm
                                     text-slate-800 placeholder-slate-400 resize-y font-mono
                                     focus:outline-none focus:ring-2 focus:ring-blue-500
                                     focus:border-transparent">{{ old('code', $detail->code) }}</textarea>
                </div>

                {{-- URL --}}
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">
                        URL <span class="text-slate-400 font-normal">(opsional)</span>
                    </label>
                    <input type="text" name="url"
                           value="{{ old('url', $detail->url) }}"
                           placeholder="https://..."
                           class="w-full px-3.5 py-2.5 border border-slate-300 rounded-lg text-sm
                                  text-slate-800 placeholder-slate-400
                                  focus:outline-none focus:ring-2 focus:ring-blue-500
                                  focus:border-transparent"/>
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="submit"
                            class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold
                                   py-2.5 rounded-lg text-sm transition">
                        Perbarui
                    </button>
                    <a href="{{ route('tutorials.details.index', $tutorial) }}"
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