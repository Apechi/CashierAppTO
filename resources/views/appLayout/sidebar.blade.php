<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">



        @auth

            <li class="nav-heading">Application</li>

            @can('view-any', App\Models\Category::class)
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs(['categories.index', 'categories.show']) ? '' : 'collapsed' }}"
                        href="{{ route('categories.index') }}">
                        <i class="bi bi-list"></i>
                        <span>Kategori</span>
                    </a>
                </li>
            @endcan
            @can('view-any', App\Models\Type::class)
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('types.index') ? '' : 'collapsed' }}"
                        href="{{ route('types.index') }}">
                        <i class="bi bi-collection-play"></i>
                        <span>Tipe Menu</span>
                    </a>
                </li>
            @endcan
            @can('view-any', App\Models\Menu::class)
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('menus.index') ? '' : 'collapsed' }}"
                        href="{{ route('menus.index') }}">
                        <i class="bi bi-card-list"></i>
                        <span>Menu</span>
                    </a>
                </li>
            @endcan
            @can('view-any', App\Models\Stock::class)
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('stocks.index') ? '' : 'collapsed' }}"
                        href="{{ route('stocks.index') }}">
                        <i class="bi bi-archive"></i>
                        <span>Stok</span>
                    </a>
                </li>
            @endcan
            @can('view-any', App\Models\Table::class)
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('tables.index') ? '' : 'collapsed' }}"
                        href="{{ route('tables.index') }}">
                        <i class="bi bi-table"></i>
                        <span>Meja</span>
                    </a>
                </li>
            @endcan
            @can('view-any', App\Models\Customer::class)
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('customers.index') ? '' : 'collapsed' }}"
                        href="{{ route('customers.index') }}">
                        <i class="bi bi-people"></i>
                        <span>Pelanggan</span>
                    </a>
                </li>
            @endcan
            @can('view-any', App\Models\Booking::class)
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('bookings.index') ? '' : 'collapsed' }}"
                        href="{{ route('bookings.index') }}">
                        <i class="bi bi-journal-bookmark-fill"></i>
                        <span>Pemesanan</span>
                    </a>
                </li>
            @endcan
            @can('view-any', App\Models\ProdukTitipan::class)
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('titipan.index') ? '' : 'collapsed' }}"
                        href="{{ route('titipan.index') }}">
                        <i class="bi bi-bag-dash-fill"></i>
                        <span>Produk Titipan</span>
                    </a>
                </li>
            @endcan
            @can('view-any', App\Models\Laporan::class)
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs(['absensi.index']) ? '' : 'collapsed' }}"
                        href="{{ route('absensi.index') }}">
                        <i class="bi bi-person-workspace"></i>
                        <span>Absensi Karyawan</span>
                    </a>
                </li>
            @endcan
            @can('view-any', App\Models\Laporan::class)
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs(['absensi.laporan']) ? '' : 'collapsed' }}"
                        href="{{ route('absensi.laporan') }}">
                        <i class="bi bi-activity"></i>
                        <span>Laporan Karyawan</span>
                    </a>
                </li>
            @endcan



            @can('view-any', App\Models\Transaction::class)
                <li class="nav-heading">Transaksi</li>

                @can('view-any', App\Models\TransactionDetail::class)
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs(['transaction.index']) ? '' : 'collapsed' }}"
                            href="{{ route('transaction.index') }}">
                            <i class="bi bi-cart-fill"></i>
                            <span>Transaksi</span>
                        </a>
                    </li>
                @endcan
            @endcan
            @can('view-any', App\Models\Transaction::class)
                @can('view-any', App\Models\TransactionDetail::class)
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs(['transaction.listTransaksi']) ? '' : 'collapsed' }}"
                            href="{{ route('transaction.listTransaksi') }}">
                            <i class="bi bi-basket-fill"></i>
                            <span>List Transaksi</span>
                        </a>
                    </li>
                @endcan
            @endcan

            @can('view-any', App\Models\Laporan::class)
                @can('view-any', App\Models\Laporan::class)
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs(['transaction.laporan']) ? '' : 'collapsed' }}"
                            href="{{ route('transaction.laporan') }}">
                            <i class="bi bi-bar-chart-fill"></i>
                            <span>Laporan Transaksi</span>
                        </a>
                    </li>
                @endcan
            @endcan



            @if (Auth::user()->can('view-any', Spatie\Permission\Models\Role::class) ||
                    Auth::user()->can('view-any', Spatie\Permission\Models\Permission::class))
                <li class="nav-heading">Admin Utilities</li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('users.index') ? '' : 'collapsed' }}"
                        href="{{ route('users.index') }}">
                        <i class="bi bi-person"></i>
                        <span>User</span>
                    </a>
                </li>


                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('roles.index') ? '' : 'collapsed' }}"
                        href="{{ route('roles.index') }}">
                        <i class="bi bi-shield-check"></i>
                        <span>Role</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('permissions.index') ? '' : 'collapsed' }}"
                        href="{{ route('permissions.index') }}">
                        <i class="bi bi-check2-all"></i>
                        <span>Permission</span>
                    </a>
                </li>
            @endif


        @endauth

        <li class="nav-heading">Other</li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('/tentang') ? '' : 'collapsed' }}" href="/tentang">
                <i class="bi bi-question"></i>
                <span>Tentang Aplikasi</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('/layanan') ? '' : 'collapsed' }}" href="/layanan">
                <i class="bi bi-person-check"></i>
                <span>Layanan Aplikasi</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('/contact') ? '' : 'collapsed' }}" href="/contact">
                <i class="bi bi-telephone"></i>
                <span>Contact Us</span>
            </a>
        </li>
    </ul>

</aside><!-- End Sidebar-->
