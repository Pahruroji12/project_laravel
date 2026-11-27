<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Rumah Gadget</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>

<body class="min-h-screen bg-slate-100 flex items-center justify-center p-4 text-slate-700">

    <div class="w-full max-w-sm">
        {{-- Logo & judul --}}
        <div class="text-center mb-6">
            <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-blue-600 text-white text-xl font-extrabold tracking-tight shadow-md mb-3">
                RG
            </div>
            <h1 class="text-2xl font-bold text-slate-800">Rumah Gadget</h1>
            <p class="text-sm text-slate-500 mt-1">Masuk sebagai admin untuk mengelola produk</p>
        </div>

        {{-- Kartu form login --}}
        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
            <form method="POST" action="{{ route('login.proses') }}" class="space-y-4">
                @csrf

                <div>
                    <label for="email" class="block mb-1 text-sm font-medium">Email</label>
                    <div class="relative">
                        <span class="material-icons absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xl">mail</span>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                            placeholder="admin@admin.com" required autofocus
                            class="w-full border border-slate-300 rounded-lg py-2.5 pl-10 pr-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>

                <div>
                    <label for="password" class="block mb-1 text-sm font-medium">Password</label>
                    <div class="relative">
                        <span class="material-icons absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xl">lock</span>
                        <input type="password" id="password" name="password" placeholder="••••••••" required
                            class="w-full border border-slate-300 rounded-lg py-2.5 pl-10 pr-3 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>

                <button type="submit"
                    class="w-full inline-flex items-center justify-center gap-1.5 bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 rounded-lg shadow-sm transition-colors text-sm">
                    <span class="material-icons text-lg">login</span>
                    Masuk
                </button>
            </form>

            {{-- Pesan error ditaruh di bawah form --}}
            @error('login_error')
                <div class="mt-4 flex items-center gap-2 rounded-lg bg-red-50 border border-red-200 text-red-600 px-3 py-2 text-sm">
                    <span class="material-icons text-lg">error_outline</span>
                    {{ $message }}
                </div>
            @enderror
        </div>

        <p class="text-center text-xs text-slate-400 mt-6">&copy; {{ date('Y') }} Rumah Gadget</p>
    </div>

</body>

</html>
