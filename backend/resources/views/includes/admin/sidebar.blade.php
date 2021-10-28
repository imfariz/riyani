<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-text mx-3">Riyani Admin</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>   
    <li class="nav-item">
        <a class="nav-link" href="{{ route('product.index') }}">
            <i class="fas fa-fw fa-hotel"></i>
            <span>Products</span></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('transactions.index') }}">
            <i class="fas fa-fw fa-hotel"></i>
            <span>Transactions</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

</ul>
<!-- End of Sidebar -->