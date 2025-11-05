<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
        <!--begin::Brand Link-->
        <a href="./index.html" class="brand-link">
            <!--begin::Brand Image-->
            <img
                src="{{ asset('/') }}dist-lte/assets/img/AdminLTELogo.png"
                alt="AdminLTE Logo"
                class="brand-image opacity-75 shadow"
            />
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-light">LOGISTIC</span>
            <!--end::Brand Text-->
        </a>
        <!--end::Brand Link-->
    </div>
    <!--end::Sidebar Brand-->
    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul
                class="nav sidebar-menu flex-column"
                data-lte-toggle="treeview"
                role="navigation"
                aria-label="Main navigation"
                data-accordion="false"
                id="navigation">

                <li class="nav-item">
                    <a href="/dashboard" class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-header">MENU</li>
                <!-- Purchasing -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-ui-checks-grid"></i>
                        <p>
                            Purchasing
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a
                                href="./docs/components/main-header.html"
                                class="nav-link"
                            >
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Main Header</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a
                                href="./docs/components/main-sidebar.html"
                                class="nav-link"
                            >
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Main Sidebar</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- End Purchasing -->
                <!-- Gudang -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-ui-checks-grid"></i>
                        <p>
                            Gudang
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a
                                href="./docs/components/main-header.html"
                                class="nav-link"
                            >
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Main Header</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a
                                href="./docs/components/main-sidebar.html"
                                class="nav-link"
                            >
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Main Sidebar</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- End Gudang -->

                <!-- Gudang -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-fuel-pump"></i>
                        <p>
                            Solar Management
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a
                                href="{{ route('units.index') }}"
                                class="nav-link"
                            >
                                <i class="nav-icon bi bi-circle"></i>
                                <p>All Unit</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a
                                href="{{ route('stations.index') }}"
                                class="nav-link"
                            >
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Station</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a
                                href="./docs/components/main-sidebar.html"
                                class="nav-link"
                            >
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Transaction</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a
                                href="./docs/components/main-sidebar.html"
                                class="nav-link"
                            >
                                <i class="nav-icon bi bi-circle"></i>
                                <p>Report</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- End Gudang -->

                <li class="nav-header">USER MANAGEMENT</li>
                <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link">
                        <i class="nav-icon bi bi-person-lines-fill"></i>
                        <p>Menu User</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="./docs/layout.html" class="nav-link">
                        <i class="nav-icon bi bi-grip-horizontal"></i>
                        <p>Layout</p>
                    </a>
                </li>
            </ul>
            <!--end::Sidebar Menu-->
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>
