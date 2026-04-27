<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Login — Tutorial App</title>
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
<body class="bg-t_navy min-h-screen flex items-center justify-center px-4 ">

    <div class="w-full max-w-sm bg-white rounded-xl shadow-2xl p-8 border-t-4 border-[#EFA501]">

        {{-- Brand --}}
        <div class="mb-8 text-center">
            <div class="inline-flex items-center justify-center w-12 h-12 bg-[#000000] rounded-lg mb-4">
                <svg class="w-6 h-6 text-[#EFA501]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                </svg>
            </div>
            <h1 class="text-xl font-bold text-[#0A2031]">Tutorial App</h1>
            <p class="text-sm text-[#334756] mt-1">Silakan masuk ke akun Anda</p>
        </div>

        {{-- Form --}}
        <form method="POST" action="{{ route('login.post') }}" class="space-y-5">
            @csrf

            <div>
                <label class="block text-xs font-semibold text-[#334756] uppercase mb-1">Email</label>
                <input type="email" name="email" required class="w-full px-4 py-3 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-[#EFA501]" />
            </div>

            <div>
                <label class="block text-xs font-semibold text-[#334756] uppercase mb-1">Password</label>
                <input type="password" name="password" required class="w-full px-4 py-3 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-[#EFA501]" />
            </div>

            <button type="submit" class="w-full bg-[#0A2031] hover:bg-[#000000] text-white font-bold py-3 rounded-lg text-sm transition duration-200">
                MASUK
            </button>
        </form>
    </div>

</body>
</html>