<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="refresh" content="5"/>
    <title>{{ $tutorial->judul }}</title>

    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Prism.js Syntax Highlighter --}}
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism-tomorrow.min.css"/>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/plugins/toolbar/prism-toolbar.min.css"/>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/plugins/copy-to-clipboard/prism-copy-to-clipboard.min.css"/>

    <style>
        pre[class*="language-"] {
            border-radius: 0.75rem;
            margin: 0;
            font-size: 0.85rem;
        }
        :not(pre) > code[class*="language-"] {
            border-radius: 0.25rem;
        }
        .token.comment { font-style: italic; }
    </style>
</head>
<body class="bg-slate-950 text-slate-100 min-h-screen">

    {{-- Header --}}
    <header class="bg-slate-900 border-b border-slate-800 sticky top-0 z-10 shadow-lg">
        <div class="max-w-4xl mx-auto px-6 py-4 flex items-start justify-between gap-4">
            <div>
                <h1 class="text-lg font-bold text-white leading-snug">
                    {{ $tutorial->judul }}
                </h1>
                @if ($tutorial->kode_matkul)
                    <span class="inline-block mt-1 bg-blue-600 text-blue-100 text-xs
                                 font-semibold px-2.5 py-0.5 rounded-full">
                        {{ $tutorial->kode_matkul }}
                    </span>
                @endif
            </div>
            <div class="flex items-center gap-2 shrink-0">
                <span class="relative flex h-2.5 w-2.5">
                    <span class="animate-ping absolute inline-flex h-full w-full
                                 rounded-full bg-green-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-green-500"></span>
                </span>
                <span class="text-xs text-slate-400">Auto-refresh / 5s</span>
            </div>
        </div>
    </header>

    {{-- Content --}}
    <main class="max-w-4xl mx-auto px-6 py-10 space-y-8">

        @forelse ($details as $detail)
            <article class="bg-slate-900 border border-slate-800 rounded-2xl overflow-hidden
                            shadow-md transition hover:border-slate-700">

                {{-- Step Badge --}}
                <div class="flex items-center gap-3 px-6 pt-5 pb-3 border-b border-slate-800">
                    <span class="flex items-center justify-center w-7 h-7 rounded-full
                                 bg-blue-600 text-white text-xs font-bold shrink-0">
                        {{ $detail->order }}
                    </span>
                    <span class="text-xs font-semibold uppercase tracking-wider
                                 {{ $detail->status === 'show' ? 'text-green-400' : 'text-slate-500' }}">
                        {{ $detail->status }}
                    </span>

                    {{-- Content type badges --}}
                    <div class="flex gap-1.5 ml-auto flex-wrap justify-end">
                        @if ($detail->text)
                            <span class="bg-purple-900/60 text-purple-300 text-xs
                                         font-medium px-2 py-0.5 rounded">Text</span>
                        @endif
                        @if ($detail->gambar)
                            <span class="bg-pink-900/60 text-pink-300 text-xs
                                         font-medium px-2 py-0.5 rounded">Gambar</span>
                        @endif
                        @if ($detail->code)
                            <span class="bg-amber-900/60 text-amber-300 text-xs
                                         font-medium px-2 py-0.5 rounded">Code</span>
                        @endif
                        @if ($detail->url)
                            <span class="bg-cyan-900/60 text-cyan-300 text-xs
                                         font-medium px-2 py-0.5 rounded">URL</span>
                        @endif
                    </div>
                </div>

                <div class="px-6 py-5 space-y-5">

                    {{-- Text --}}
                    @if ($detail->text)
                        <div class="text-slate-200 text-sm leading-relaxed whitespace-pre-line">
                            {{ $detail->text }}
                        </div>
                    @endif

                    {{-- Gambar --}}
                    @if ($detail->gambar)
                        <div>
                            <img src="{{ asset('storage/' . $detail->gambar) }}"
                                 alt="Gambar step {{ $detail->order }}"
                                 class="w-full max-w-2xl rounded-xl border border-slate-700
                                        object-contain shadow-md"/>
                        </div>
                    @endif

                    {{-- Code --}}
                    @if ($detail->code)
                        <div class="rounded-xl overflow-hidden border border-slate-700">
                            <div class="flex items-center justify-between bg-slate-800
                                        px-4 py-2 border-b border-slate-700">
                                <span class="text-xs text-slate-400 font-mono font-semibold">
                                    PHP
                                </span>
                            </div>
                            <pre class="!rounded-none !border-0"><code class="language-php">{{ $detail->code }}</code></pre>
                        </div>
                    @endif

                    {{-- URL --}}
                    @if ($detail->url)
                        <div>
                            <a href="{{ $detail->url }}"
                               target="_blank"
                               rel="noopener noreferrer"
                               class="inline-flex items-center gap-2 text-sm text-cyan-400
                                      hover:text-cyan-300 underline underline-offset-4 transition">
                                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor"
                                     stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M13.828 10.172a4 4 0 0 0-5.656 0l-4 4a4 4 0 1 0
                                             5.656 5.656l1.102-1.101m-.758-4.899a4 4 0 0 0
                                             5.656 0l4-4a4 4 0 0 0-5.656-5.656l-1.1
                                             1.1"/>
                                </svg>
                                {{ $detail->url }}
                            </a>
                        </div>
                    @endif

                </div>
            </article>
        @empty
            <div class="text-center py-20">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full
                            bg-slate-800 mb-4">
                    <svg class="w-7 h-7 text-slate-600" fill="none" stroke="currentColor"
                         stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5
                                 A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0
                                 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5
                                 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0
                                 .621.504 1.125 1.125 1.125h12.75c.621 0
                                 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9z"/>
                    </svg>
                </div>
                <p class="text-slate-500 text-sm">Belum ada konten yang dipublikasikan.</p>
            </div>
        @endforelse

    </main>

    {{-- Footer --}}
    <footer class="border-t border-slate-800 mt-16 py-6 text-center">
        <p class="text-xs text-slate-600">
            {{ $tutorial->creator_email }} &mdash; {{ $tutorial->kode_matkul }}
        </p>
    </footer>

    {{-- Prism.js Scripts --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-core.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/plugins/autoloader/prism-autoloader.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/plugins/toolbar/prism-toolbar.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/plugins/copy-to-clipboard/prism-copy-to-clipboard.min.js"></script>

</body>
</html>