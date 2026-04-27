<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="refresh" content="5"/>
    <title>{{ $tutorial->judul }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { theme: { extend: { colors: { t_navy: '#0A2031', t_slate: '#334756', t_gold: '#EFA501', t_black: '#000000' } } } }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism-tomorrow.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/plugins/toolbar/prism-toolbar.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/plugins/copy-to-clipboard/prism-copy-to-clipboard.min.css"/>
    <style>
        pre[class*="language-"] { border-radius: 0.75rem; margin: 0; font-size: 0.85rem; }
        :not(pre) > code[class*="language-"] { border-radius: 0.25rem; }
        .token.comment { font-style: italic; }
    </style>
</head>
<body class="bg-t_black text-gray-200 min-h-screen">

    <header class="bg-t_navy border-b border-t_gold sticky top-0 z-10 shadow-lg">
        <div class="max-w-4xl mx-auto px-6 py-4 flex items-start justify-between gap-4">
            <div>
                <h1 class="text-lg font-bold text-white leading-snug">{{ $tutorial->judul }}</h1>
                @if ($tutorial->kode_matkul)
                    <span class="inline-block mt-1 bg-t_gold text-t_black text-xs font-bold px-2.5 py-0.5 rounded-md">
                        {{ $tutorial->kode_matkul }}
                    </span>
                @endif
            </div>
            <div class="flex items-center gap-2 shrink-0">
                <span class="relative flex h-2.5 w-2.5">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-t_gold opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-yellow-500"></span>
                </span>
                <span class="text-xs text-gray-400 font-medium">Auto-refresh / 5s</span>
            </div>
        </div>
    </header>

    <main class="max-w-4xl mx-auto px-6 py-10 space-y-8">
        @forelse ($details as $detail)
            <article class="bg-t_navy border border-t_slate rounded-2xl overflow-hidden shadow-xl transition hover:border-t_gold">
                <div class="flex items-center gap-3 px-6 pt-5 pb-3 border-b border-t_slate">
                    <span class="flex items-center justify-center w-7 h-7 rounded-full bg-t_gold text-t_black text-xs font-bold shrink-0">
                        {{ $detail->order }}
                    </span>
                    <span class="text-xs font-bold uppercase tracking-wider {{ $detail->status === 'show' ? 'text-green-400' : 'text-gray-500' }}">
                        {{ $detail->status }}
                    </span>
                    <div class="flex gap-1.5 ml-auto flex-wrap justify-end">
                        @if ($detail->text) <span class="bg-t_black border border-t_slate text-t_gold text-xs font-bold px-2 py-0.5 rounded">Text</span> @endif
                        @if ($detail->gambar) <span class="bg-t_black border border-t_slate text-t_gold text-xs font-bold px-2 py-0.5 rounded">Gambar</span> @endif
                        @if ($detail->code) <span class="bg-t_black border border-t_slate text-t_gold text-xs font-bold px-2 py-0.5 rounded">Code</span> @endif
                        @if ($detail->url) <span class="bg-t_black border border-t_slate text-t_gold text-xs font-bold px-2 py-0.5 rounded">URL</span> @endif
                    </div>
                </div>

                <div class="px-6 py-5 space-y-5">
                    @if ($detail->text)
                        <div class="text-gray-200 text-sm leading-relaxed whitespace-pre-line">{{ $detail->text }}</div>
                    @endif
                    @if ($detail->gambar)
                        <div><img src="{{ asset('storage/' . $detail->gambar) }}" class="w-full max-w-2xl rounded-xl border border-t_slate object-contain shadow-md"/></div>
                    @endif
                    @if ($detail->code)
                        <div class="rounded-xl overflow-hidden border border-t_slate">
                            <div class="flex items-center justify-between bg-t_black px-4 py-2 border-b border-t_slate">
                                <span class="text-xs text-t_gold font-mono font-bold">Code snippet</span>
                            </div>
                            <pre class="!rounded-none !border-0"><code class="language-php">{{ $detail->code }}</code></pre>
                        </div>
                    @endif
                    @if ($detail->url)
                        <div>
                            <a href="{{ $detail->url }}" target="_blank" class="inline-flex items-center gap-2 text-sm text-t_gold hover:text-white underline underline-offset-4 transition">
                                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 0 0-5.656 0l-4 4a4 4 0 1 0 5.656 5.656l1.102-1.101m-.758-4.899a4 4 0 0 0 5.656 0l4-4a4 4 0 0 0-5.656-5.656l-1.1 1.1"/></svg>
                                {{ $detail->url }}
                            </a>
                        </div>
                    @endif
                </div>
            </article>
        @empty
            <div class="text-center py-20">
                <p class="text-gray-500 text-sm">Belum ada konten yang dipublikasikan.</p>
            </div>
        @endforelse
    </main>

    <footer class="border-t border-t_slate mt-16 py-6 text-center">
        <p class="text-xs text-gray-400">{{ $tutorial->creator_email }} &mdash; {{ $tutorial->kode_matkul }}</p>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-core.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/plugins/autoloader/prism-autoloader.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/plugins/toolbar/prism-toolbar.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/plugins/copy-to-clipboard/prism-copy-to-clipboard.min.js"></script>
</body>
</html>