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
                @can('home.index')
                    <li class="nav-item">
                        <a href="{{ route('home.index') }}" @class(['nav-link', 'active' => isset($sidebar) && $sidebar === 'home'])>
                            <i class="nav-icon bi bi-house-fill"></i>
                            <p>Home</p>
                        </a>
                    </li>
                @endcan

                @can('product.index')
                    <li class="nav-item">
                        <a href="{{ route('product.index') }}" @class(['nav-link', 'active' => isset($sidebar) && $sidebar === 'produtos'])>
                            <i class="nav-icon bi bi-box-seam-fill"></i>
                            <p>
                                Produtos
                            </p>
                        </a>
                    </li>
                @endcan

                @if(auth()->user()->can('machine.index') || auth()->user()->can('machinebreakdown.index'))
                    <li @class(['nav-item', 'menu-open' => isset($menuOpen) && $menuOpen === 'menuOpen'])>
                        <a href="#" class="nav-link">
                            <i class="nav-icon bi bi-lightning-fill"></i>
                            <p>
                                Máquinas
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('machine.index')
                                <li class="nav-item">
                                    <a href="{{ route('machine.index') }}" @class(['nav-link', 'active' => isset($sidebar) && $sidebar === 'máquinas'])>
                                        <i class="nav-icon bi bi-nut-fill"></i>
                                        <p>
                                            Máquina
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('machinebreakdown.index')
                                <li class="nav-item">
                                    <a href="{{ route('machinebreakdown.index') }}" @class(['nav-link', 'active' => isset($sidebar) && $sidebar === 'paradas'])>
                                        <i class="nav-icon bi bi-exclamation-triangle-fill"></i>
                                        <p>
                                            Paradas
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endif

                @can('employee.index')
                    <li class="nav-item">
                        <a href="{{ route('employee.index') }}" @class(['nav-link', 'active' => isset($sidebar) && $sidebar === 'colaboradores'])>
                            <i class="nav-icon bi bi-person-vcard-fill"></i>
                            <p>
                                Colaboradores
                            </p>
                        </a>
                    </li>
                @endcan

                @can('task.index')
                    <li class="nav-item">
                        <a href="{{ route('task.index') }}" @class(['nav-link', 'active' => isset($sidebar) && $sidebar === 'apontamentos'])>
                            <i class="nav-icon bi bi-clipboard-fill"></i>
                            <p>
                                Apontamentos
                            </p>
                        </a>
                    </li>
                @endcan

                @if(auth()->user()->can('ppe.index'))
                    <li @class(['nav-item', 'menu-open'=> isset($menuOpen) && $menuOpen == "menuOpenEpi"])>
                        <a href="#" class="nav-link">
                            <i class="nav-icon bi-shield-fill-check"></i>
                            <p>
                                EPIs
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('ppe-movements.index')
                            <li class="nav-item">
                                <a href="{{ route('ppe-movements.index') }}" @class(['nav-link', 'active' => isset($sidebar) && $sidebar == 'ppeMovements'])>
                                    <i class="nav-icon bi bi-folder-fill"></i>
                                    <p>
                                        Movimentação
                                    </p>
                                </a>
                            </li>
                            @endcan
                            @can('ppe.index')
                                <li class="nav-item">
                                    <a href="{{ route('ppe.index') }}" @class(['nav-link', 'active' => isset($sidebar) && $sidebar == 'epi'])>
                                        <i class="nav-icon bi bi-shield-fill"></i>
                                        <p>
                                            EPI
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endif

                @can('user.index')
                    <li class="nav-header">AUTENTICAÇÃO</li>
                    <li class="nav-item">
                        <a href="{{ route('user.index') }}" @class(['nav-link', 'active' => isset($sidebar) && $sidebar === 'users'])>
                            <i class="nav-icon bi bi-person"></i>
                            <p>
                                Usuários
                            </p>
                        </a>
                    </li>
                @endcan

                @can('role.index')
                    <li class="nav-header">PERMISSÃO</li>
                    <li class="nav-item">
                        <a href="{{ route('role.index') }}" @class(['nav-link', 'active' => isset($sidebar) && $sidebar === 'roles']) >
                            <i class="nav-icon bi bi-diagram-3-fill"></i>
                            <p>
                                Papéis
                            </p>
                        </a>
                    </li>
                @endcan
            </ul>
        </nav>
    </div>
</aside>
