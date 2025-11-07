<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <div class="sidebar-brand">
        <a href="{{ route('home.index') }}" class="brand-link">
            <img src="{{ Vite::asset('resources/images/AdminLTELogo.png') }}"
                 alt="AdminLTE Logo"
                 class="brand-image opacity-75 shadow"
            />
            <span class="brand-text fw-light">Logster</span>
        </a>
    </div>
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul
                class="nav sidebar-menu flex-column"
                data-lte-toggle="treeview"
                role="navigation"
                aria-label="Main navigation"
                data-accordion="false"
                id="navigation"
            >
                <li class="nav-item">
                    <a href="{{ route('home.index') }}" @class(['nav-link', 'active' => isset($sidebar) && $sidebar === 'home'])>
                        <i class="nav-icon bi bi-house-fill"></i>
                        <p>Home</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('product.index') }}" @class(['nav-link', 'active' => isset($sidebar) && $sidebar === 'produtos'])>
                        <i class="nav-icon bi bi-box-seam-fill"></i>
                        <p>
                            Produtos
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('machine.index') }}" @class(['nav-link', 'active' => isset($sidebar) && $sidebar === 'máquinas'])>
                        <i class="nav-icon bi bi-nut-fill"></i>
                        <p>
                            Máquinas
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('employee.index') }}" @class(['nav-link', 'active' => isset($sidebar) && $sidebar === 'colaboradores'])>
                        <i class="nav-icon bi bi-person-vcard-fill"></i>
                        <p>
                            Colaboradores
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-clipboard-fill"></i>
                        <p>
                            Apontamentos
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-shield-fill-check"></i>
                        <p>
                            EPIs
                        </p>
                    </a>
                </li>
                <li class="nav-header">AUTENTICAÇÃO</li>
                <li class="nav-item">
                    <a href="{{ route('user.index') }}" @class(['nav-link', 'active' => isset($sidebar) && $sidebar === 'users'])>
                        <i class="nav-icon bi bi-person"></i>
                        <p>
                            Usuários
                        </p>
                    </a>
                </li>
                <li class="nav-header">PERMISSÃO</li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-gear-wide-connected"></i>
                        <p>
                            Papéis
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
