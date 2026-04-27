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
<body class="text-slate-100 min-h-screen" style="background-color: #0A2031; font-family: 'Poppins', sans-serif;">

    {{-- Header --}}
    <header class="border-b sticky top-0 z-10 shadow-lg" style="background-color: #0A2031; border-color: #334756;">
        <div class="max-w-4xl mx-auto px-6 py-4 flex items-start justify-between gap-4">
            <div>
                <h1 class="text-lg font-bold leading-snug" style="color: #ffffff;">
                    {{ $tutorial->judul }}
                </h1>
                @if ($tutorial->kode_matkul)
                    <span class="inline-block mt-1 text-xs font-semibold px-2.5 py-0.5 rounded-full" style="background-color: #EFA501; color: #0A2031;">
                        {{ $tutorial->kode_matkul }}
                    </span>
                @endif
            </div>
            <div class="flex items-center gap-2 shrink-0">
                <span class="relative flex h-2.5 w-2.5">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full" style="background-color: #EFA501; opacity: 0.75;"></span>
                    <span class="relative inline-flex rounded-full h-2.5 w-2.5" style="background-color: #EFA501;"></span>
                </span>
                <span class="text-xs" style="color: #999;">Auto-refresh / 5s</span>
            </div>
        </div>
    </header>

    {{-- Content --}}
    <main class="max-w-4xl mx-auto px-6 py-10 space-y-8">

        @forelse ($details as $detail)
            <article class="rounded-2xl overflow-hidden shadow-md transition border" style="background-color: #0A2031; border-color: #334756;" onmouseover="this.style.borderColor='#EFA501';" onmouseout="this.style.borderColor='#334756';">

                {{-- Step Badge --}}
                <div class="flex items-center gap-3 px-6 pt-5 pb-3" style="border-bottom: 1px solid #334756;">
                    <span class="flex items-center justify-center w-7 h-7 rounded-full text-white text-xs font-bold shrink-0" style="background-color: #EFA501; color: #0A2031;">
                        {{ $detail->order }}
                    </span>
                    <span class="text-xs font-semibold uppercase tracking-wider" style="color: {{ $detail->status === 'show' ? '#EFA501' : '#666' }};">
                        {{ $detail->status }}
                    </span>

                    {{-- Content type badges --}}
                    <div class="flex gap-1.5 ml-auto flex-wrap justify-end">
                        @if ($detail->text)
                            <span class="text-xs font-medium px-2 py-0.5 rounded" style="background-color: rgba(128, 90, 213, 0.2); color: #b19cd9;">Text</span>
                        @endif
                        @if ($detail->gambar)
                            <span class="text-xs font-medium px-2 py-0.5 rounded" style="background-color: rgba(233, 30, 99, 0.2); color: #f06292;">Gambar</span>
                        @endif
                        @if ($detail->code)
                            <span class="text-xs font-medium px-2 py-0.5 rounded" style="background-color: rgba(255, 152, 0, 0.2); color: #ffb74d;">Code</span>
                        @endif
                        @if ($detail->url)
                            <span class="text-xs font-medium px-2 py-0.5 rounded" style="background-color: rgba(0, 150, 136, 0.2); color: #4db8ac;">URL</span>
                        @endif
                    </div>
                </div>

                <div class="px-6 py-5 space-y-5">

                    {{-- Text --}}
                    @if ($detail->text)
                        <div class="text-sm leading-relaxed whitespace-pre-line" style="color: #ddd;">
                            {{ $detail->text }}
                        </div>
                    @endif

                    {{-- Gambar --}}
                    @if ($detail->gambar)
                        <div>
                            <img src="{{ asset('storage/' . $detail->gambar) }}"
                                 alt="Gambar step {{ $detail->order }}"
                                 class="w-full max-w-2xl rounded-xl object-contain shadow-md" style="border: 1px solid #334756;"/>
                        </div>
                    @endif

                    {{-- Code --}}
                    @if ($detail->code)
                        <div class="rounded-xl overflow-hidden" style="border: 1px solid #334756;">
                            <div class="flex items-center justify-between px-4 py-2" style="background-color: #334756; border-bottom: 1px solid #334756;">
                                <span class="text-xs font-mono font-semibold" style="color: #999;">PHP</span>
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
                               class="inline-flex items-center gap-2 text-sm underline underline-offset-4 transition" style="color: #EFA501;" onmouseover="this.style.color='#d68900';" onmouseout="this.style.color='#EFA501';">
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
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full mb-4" style="background-color: #334756;">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor"
                         stroke-width="1.5" viewBox="0 0 24 24" style="color: #666;">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5
                                 A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0
                                 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5
                                 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0
                                 .621.504 1.125 1.125 1.125h12.75c.621 0
                                 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9z"/>
                    </svg>
                </div>
                <p class="text-sm" style="color: #666;">Belum ada konten yang dipublikasikan.</p>
            </div>
        @endforelse

    </main>

    {{-- Footer --}}
    <footer class="mt-16 py-6 text-center" style="border-top: 1px solid #334756;">
        <p class="text-xs" style="color: #666;">
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