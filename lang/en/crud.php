<?php

return [
    'common' => [
        'actions' => 'Aksi',
        'create' => 'Tambah',
        'edit' => 'Edit',
        'update' => 'Update',
        'new' => 'Baru',
        'cancel' => 'Cancel',
        'attach' => 'Attach',
        'detach' => 'Detach',
        'save' => 'Simpan',
        'delete' => 'Hapus',
        'delete_selected' => 'Hapus Dipilih',
        'search' => 'Cari...',
        'back' => 'Kembali ke Page Awal',
        'are_you_sure' => 'Apa kamu yakin?',
        'no_items_found' => 'Data tidak ada',
        'created' => 'Berhasil di Tambah',
        'saved' => 'Berhasil di Simpan',
        'removed' => 'Berhasil di Hapus',
        'export' => [
            'pdf' => 'Export PDF',
            'excel' => 'Export XLS'
        ],
        'import' => 'Import'
    ],

    'types' => [
        'name' => 'Tipe Menu',
        'index_title' => 'List Tipe',
        'new_title' => 'Tipe Baru',
        'create_title' => 'Tambah Tipe Menu',
        'edit_title' => 'Edit Tipe',
        'show_title' => 'Lihat Tipe',
        'inputs' => [
            'name' => 'Nama',
            'icon' => 'Icon',
            'category_id' => 'Kategori',
        ],
    ],

    'customers' => [
        'name' => 'Pelanggan',
        'index_title' => 'List Pelanggan',
        'new_title' => 'Pelanggan Baru',
        'create_title' => 'Tambah Pelanggan',
        'edit_title' => 'Edit Pelanggan',
        'show_title' => 'Lihat Pelanggan',
        'inputs' => [
            'name' => 'Nama',
            'email' => 'Email',
            'no_telp' => 'No Telp',
            'address' => 'Alamat',
        ],
    ],

    'tables' => [
        'name' => 'Meja',
        'index_title' => 'List Meja',
        'new_title' => 'Meja Baru',
        'create_title' => 'Tambah Meja',
        'edit_title' => 'Edit Meja',
        'show_title' => 'Lihat Meja',
        'inputs' => [
            'table_number' => 'Nomor Meja',
            'capacity' => 'Kapasitas',
            'status' => 'Status Meja',
        ],
    ],

    'stocks' => [
        'name' => 'Stok',
        'index_title' => 'List Stok',
        'new_title' => 'Stok Baru',
        'create_title' => 'Tambah Stok',
        'edit_title' => 'Edit Stok',
        'show_title' => 'Lihat Stock',
        'inputs' => [
            'menu_id' => 'Pilih Menu',
            'quantity' => 'Kuantitas',
        ],
    ],

    'users' => [
        'name' => 'Pengguna',
        'index_title' => 'List Pengguna',
        'new_title' => 'Pengguna Baru',
        'create_title' => 'Tambah Pengguna',
        'edit_title' => 'Edit Pengguna',
        'show_title' => 'Lihat Pengguna',
        'inputs' => [
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
        ],
    ],

    'bookings' => [
        'name' => 'Pemesanan',
        'index_title' => 'List Pemesanan',
        'new_title' => 'Pemesanan Baru',
        'create_title' => 'Tambah Pemesanan',
        'edit_title' => 'Edit Pemesanan',
        'show_title' => 'Lihat Pemesanan',
        'inputs' => [
            'bookers_name' => 'Nama Pemesan',
            'date' => 'Tanggal Booking',
            'table_id' => 'Meja',
            'start_time' => 'Jam Mulai',
            'end_time' => 'Jam Akhir',
            'total_customer' => 'Total Pelanggan',
        ],
    ],

    'categories' => [
        'name' => 'Kategori',
        'index_title' => 'List Kategori',
        'new_title' => 'Kategori Baru',
        'create_title' => 'Tambah Kategori',
        'edit_title' => 'Edit Kategori',
        'show_title' => 'Lihat Kategori',
        'inputs' => [
            'name' => 'Nama',
            'icon' => 'Icon',
        ],
    ],

    'menus' => [
        'name' => 'Menu',
        'index_title' => 'List Menu',
        'new_title' => 'Menu Baru',
        'create_title' => 'Tambah Menu',
        'edit_title' => 'Edit Menu',
        'show_title' => 'Lihat Menu',
        'inputs' => [
            'name' => 'Nama',
            'price' => 'Harga',
            'image' => 'Gambar Menu',
            'description' => 'Deskripsi',
            'type_id' => 'Tipe Menu',
        ],
    ],

    'roles' => [
        'name' => 'Roles',
        'index_title' => 'List Role',
        'create_title' => 'Buat Role',
        'edit_title' => 'Edit Role',
        'show_title' => 'Lihat Role',
        'inputs' => [
            'name' => 'Nama',
        ],
    ],

    'permissions' => [
        'name' => 'Permission',
        'index_title' => 'List Permissions',
        'create_title' => 'Buat Permission',
        'edit_title' => 'Edit Permission',
        'show_title' => 'Lihat Permission',
        'inputs' => [
            'name' => 'Nama',
        ],
    ],

    'transaction' => [
        'name' => 'Transaksi',
        'index_title' => 'List Transaksi',
        'show_title' => 'Lihat Transaksi',
        'inputs' => [
            'id' => 'No Faktur',
            'date' => 'Tanggal Transaksi',
            'customer' => 'Pelanggan',
            'total_price' => 'Total Pembayaran',
            'payment_method' => 'Metode Pembayaran',
            'keterangan' => 'Keterangan Pembelian',
        ],
    ],
];
