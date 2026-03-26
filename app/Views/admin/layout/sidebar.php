<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="<?= base_url('admin/dashboard') ?>" class="brand-link">
        <span class="brand-text font-weight-light">GCShow Admin</span>
    </a>

    <div class="sidebar">
        <nav>
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" data-accordion="false" role="menu">

                <li class="nav-item">
                    <a href="<?= base_url('admin/dashboard') ?>" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= base_url('admin/eventos') ?>" class="nav-link">
                        <i class="nav-icon fas fa-calendar"></i>
                        <p>Eventos</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= base_url('admin/galeria') ?>" class="nav-link">
                        <i class="nav-icon fas fa-images"></i>
                        <p>Galeria</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= base_url('admin/institucional') ?>" class="nav-link">
                        <i class="nav-icon fas fa-building"></i>
                        <p>Institucional</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?= base_url('admin/newsletter') ?>" class="nav-link">
                        <i class="nav-icon fas fa-envelope"></i>
                        <p>Newsletter</p>
                    </a>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>
                            Loja
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('admin/produtos') ?>" class="nav-link">
                                <i class="fas fa-box-open nav-icon"></i>
                                <p>Produtos</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?= base_url('admin/categorias') ?>" class="nav-link">
                                <i class="fas fa-tags nav-icon"></i>
                                <p>Categorias</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?= base_url('admin/pedidos') ?>" class="nav-link">
                                <i class="fas fa-receipt nav-icon"></i>
                                <p>Pedidos</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?= base_url('admin/relatorios/vendas') ?>" class="nav-link">
                                <i class="fas fa-chart-line nav-icon"></i>
                                <p>Relatório de vendas</p>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>
    </div>
</aside>
