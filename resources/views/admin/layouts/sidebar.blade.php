<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link " href="/home">
                <i class="bi bi-grid"></i>
                <span>Bosh sahifa</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="{{ route('orderIndex') }}">
                <i class="bi bi-grid"></i>
                <span>Yangi Buyurtmalar</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="{{ route('orderProgress') }}">
                <i class="bi bi-grid"></i>
                <span>Jarayondagi buyurtmalar</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="{{ route('orderDone') }}">
                <i class="bi bi-grid"></i>
                <span>Yetkazib berilgan buyrtmalar</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="{{ route('orderCancel') }}">
                <i class="bi bi-grid"></i>
                <span>Bekor qilingan buyrtmalar</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link " href="{{ route('category.index') }}">
                <i class="bi bi-grid"></i>
                <span>Mahsulot Toifalari</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="{{ route('product.index') }}">
                <i class="bi bi-grid"></i>
                <span>Mahsulotlar</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="{{ route('incoming.index') }}">
                <i class="bi bi-grid"></i>
                <span>Mahsulot kirim qilish</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="{{ route('product.less') }}">
                <i class="bi bi-grid"></i>
                <span>Kam qolgan mahsulotlar</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="{{ route('product.minus') }}">
                <i class="bi bi-grid"></i>
                <span>Minusga otgan mahsulotlar</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="{{ route('pstatus') }}">
                <i class="bi bi-grid"></i>
                <span>Aksiyadagi mahsulotlar</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="{{ route('courier.index') }}">
                <i class="bi bi-grid"></i>
                <span>Kruyerlar</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="{{ route('clients') }}">
                <i class="fa fa-users"></i>
                <span>Клиенты</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="{{ route('rek.index') }}">
                <i class="bi bi-grid"></i>
                <span>Reklamma</span>
            </a>
        </li>
    </ul>
</aside>
