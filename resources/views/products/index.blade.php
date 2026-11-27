<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tabel Produk</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>

<body class="bg-slate-50 text-slate-700">
    @include('navbar')

    <main class="p-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Tabel Produk</h1>
        </div>
        <button onclick="toggle_modal()" class="inline-flex items-center gap-1.5 bg-blue-600 hover:bg-blue-700
        text-white font-medium py-2.5 px-4 rounded-lg shadow-sm transition-colors text-sm">
            + Tambah Product
        </button>
    </div>

    {{-- Pesan sukses --}}
    @if (session('success'))
        <div class="mb-4 rounded-lg bg-green-100 text-green-700 px-4 py-3 text-sm">
            {{ session('success') }}
        </div>
    @endif

    {{-- Pesan error validasi --}}
    @if ($errors->any())
        <div class="mb-4 rounded-lg bg-red-100 text-red-700 px-4 py-3 text-sm">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="table-auto w-full text-left border-collapse">

                <thead>
                    <tr class="bg-slate-100/80 border-b border-slate-200 text-slate-600 text-xs uppercase tracking-wider font-semibold">
                        <th class="py-3.5 px-5">Nama Barang</th>
                        <th class="py-3.5 px-5">Harga Barang</th>
                        <th class="py-3.5 px-5">Stok Barang</th>
                        <th class="py-3.5 px-5">Deskripsi Barang</th>
                        <th class="py-3.5 px-5 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-200">
                    @forelse ($products as $product)
                        <tr class="hover:bg-slate-50">
                            <td class="py-4 px-5">{{ $product->nama_barang }}</td>
                            <td class="py-4 px-5">Rp. {{ number_format($product->harga_barang, 0, ',', '.') }}</td>
                            <td class="py-4 px-5">{{ $product->stok_barang }}</td>
                            <td class="py-4 px-5">{{ $product->deskripsi_barang }}</td>
                            <td class="py-3.5 px-5 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <button type="button" onclick="toggle_edit_modal({{ Js::from($product) }})"
                                        title="Edit produk"
                                        class="inline-flex items-center justify-center w-9 h-9 rounded-lg bg-green-50 text-green-600 hover:bg-green-600 hover:text-white transition-colors">
                                        <span class="material-icons text-lg">edit</span>
                                    </button>

                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                        onsubmit="return confirm('Hapus produk ini?')" class="m-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="Hapus produk"
                                            class="inline-flex items-center justify-center w-9 h-9 rounded-lg bg-red-50 text-red-600 hover:bg-red-600 hover:text-white transition-colors">
                                            <span class="material-icons text-lg">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-6 px-5 text-center text-slate-400">Belum ada produk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    </main>

    {{-- Modal Tambah Item --}}
    <div id="modal-tambah-item" class="fixed inset-0 z-50 p-4 bg-black/50 hidden items-center justify-center">
        <div class="bg-white p-6 rounded-xl shadow-lg w-full max-w-md">
            <h2 class="text-lg font-semibold mb-4">Tambah Produk Baru</h2>

            <form action="{{ route('products.store') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label for="nama_barang" class="block mb-1 font-medium">Nama Barang</label>
                    <input type="text" id="nama_barang" name="nama_barang" required
                        class="w-full border border-slate-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label for="harga_barang" class="block mb-1 font-medium">Harga Barang</label>
                    <input type="number" id="harga_barang" name="harga_barang" min="0" step="1" required
                        class="w-full border border-slate-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label for="stok_barang" class="block mb-1 font-medium">Stok Barang</label>
                    <input type="number" id="stok_barang" name="stok_barang" min="0" step="1" required
                        class="w-full border border-slate-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label for="deskripsi_barang" class="block mb-1 font-medium">Deskripsi Barang</label>
                    <textarea id="deskripsi_barang" name="deskripsi_barang" rows="3"
                        class="w-full border border-slate-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                </div>

                <div class="flex justify-end gap-3 pt-2">
                    <button type="button" onclick="toggle_modal()"
                        class="py-2 px-4 rounded-lg border border-slate-300 text-slate-600 hover:bg-slate-100 text-sm">
                        Batal
                    </button>
                    <button type="submit"
                        class="py-2 px-4 rounded-lg bg-blue-600 hover:bg-blue-700 text-white font-medium text-sm">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal Edit Item --}}
    <div id="modal-edit-item" class="fixed inset-0 z-50 p-4 bg-black/50 hidden items-center justify-center">
        <div class="bg-white p-6 rounded-xl shadow-lg w-full max-w-md">
            <h2 class="text-lg font-semibold mb-4">Edit Produk</h2>

            <form id="form-edit" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label for="edit_nama_barang" class="block mb-1 font-medium">Nama Barang</label>
                    <input type="text" id="edit_nama_barang" name="nama_barang" required
                        class="w-full border border-slate-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label for="edit_harga_barang" class="block mb-1 font-medium">Harga Barang</label>
                    <input type="number" id="edit_harga_barang" name="harga_barang" min="0" step="1" required
                        class="w-full border border-slate-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label for="edit_stok_barang" class="block mb-1 font-medium">Stok Barang</label>
                    <input type="number" id="edit_stok_barang" name="stok_barang" min="0" step="1" required
                        class="w-full border border-slate-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label for="edit_deskripsi_barang" class="block mb-1 font-medium">Deskripsi Barang</label>
                    <textarea id="edit_deskripsi_barang" name="deskripsi_barang" rows="3"
                        class="w-full border border-slate-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                </div>

                <div class="flex justify-end gap-3 pt-2">
                    <button type="button" onclick="close_edit_modal()"
                        class="py-2 px-4 rounded-lg border border-slate-300 text-slate-600 hover:bg-slate-100 text-sm">
                        Batal
                    </button>
                    <button type="submit"
                        class="py-2 px-4 rounded-lg bg-green-600 hover:bg-green-700 text-white font-medium text-sm">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggle_modal() {
            const modal = document.getElementById('modal-tambah-item');
            modal.classList.toggle('hidden');
            modal.classList.toggle('flex');
        }

        function toggle_edit_modal(item) {
            const modal = document.getElementById('modal-edit-item');
            document.getElementById('form-edit').action = '/products/' + item.id;
            document.getElementById('edit_nama_barang').value = item.nama_barang;
            document.getElementById('edit_harga_barang').value = item.harga_barang;
            document.getElementById('edit_stok_barang').value = item.stok_barang;
            document.getElementById('edit_deskripsi_barang').value = item.deskripsi_barang ?? '';
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function close_edit_modal() {
            const modal = document.getElementById('modal-edit-item');
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }
    </script>
</body>

</html>