<nav class="sticky top-0 z-40 bg-white border-b border-slate-200 shadow-sm">
    <div class="w-full px-4 md:px-6 h-16 flex justify-between items-center">

        <div class="flex items-center gap-4 md:gap-8 h-full">
            {{-- Judul aplikasi (teks disembunyikan di layar kecil) --}}
            <a href="{{ route('products.index') }}" class="flex items-center gap-2">
                <span class="inline-flex items-center justify-center w-9 h-9 rounded-lg bg-blue-600 text-white text-sm font-extrabold tracking-tight">
                    RG
                </span>
                <span class="hidden md:inline font-bold text-lg text-slate-800 tracking-wide">Rumah Gadget</span>
            </a>

            <div class="flex gap-4 md:gap-6 h-full text-sm font-medium">
                {{-- Menu Produk --}}
                <a href="{{ route('products.index') }}"
                    class="{{ request()->routeIs('products.*')
                        ? 'text-blue-600 border-blue-600'
                        : 'text-slate-500 border-transparent hover:text-blue-600' }} flex items-center gap-1.5 h-full border-b-2 transition-colors">
                    <span class="material-icons text-lg">inventory_2</span>
                    Produk
                </a>

                {{-- Menu Transaksi (halaman belum dibuat, sementara pakai #) --}}
                <a href="#"
                    class="text-slate-500 border-transparent hover:text-blue-600 flex items-center gap-1.5 h-full border-b-2 transition-colors">
                    <span class="material-icons text-lg">receipt_long</span>
                    Transaksi
                </a>
            </div>
        </div>

        {{-- Info user & tombol logout di pojok kanan --}}
        <div class="flex items-center gap-2 md:gap-4">
            @auth
                <span class="hidden md:flex items-center gap-1.5 text-sm text-slate-600">
                    <span class="material-icons text-xl text-slate-400">account_circle</span>
                    {{ auth()->user()->name }}
                </span>
            @endauth

            <form method="POST" action="{{ route('logout') }}" class="m-0">
                @csrf
                <button type="submit" title="Keluar"
                    class="flex items-center gap-1.5 text-sm font-medium text-slate-500 hover:text-red-600 hover:bg-red-50 px-2 md:px-3 py-2 rounded-lg transition-colors">
                    <span class="material-icons text-lg">logout</span>
                    <span class="hidden sm:inline">Keluar</span>
                </button>
            </form>
        </div>

    </div>
</nav>
