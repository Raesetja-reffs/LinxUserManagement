<div class="sidebar">
    <div class="top p-3">
        <div class="logo">
            {{-- <i class="bx bxl-codepen"></i> --}}
            <img src="{{asset('images/dimslogo.png')}}" alt="" class="pe-2" width="30" height="30">
            <span class="fw-bold">LINX USER MANAGER</span>
        </div>
    </div>
    <i class="bx bx-menu" id="btnNav"></i>

    <ul class="p-0">
        <li>
            <a href="{!!url("/")!!}">
                <i class="bx bx-grid-alt"></i>
                <span class="nav-item fw-bold text-nowrap">Dashboard</span>
            </a>
            <span class="tooltip fw-bold text-nowrap">Dashboard</span>
        </li>
    </ul>

    <ul class="p-0">
        <li>
            <a href="{!!url("/dimsUserManager")!!}">
                <i class="bx bx-user-circle"></i>
                <span class="nav-item fw-bold text-nowrap">Dims Users</span>
            </a>
            <span class="tooltip fw-bold text-nowrap">Dims Users</span>
        </li>
    </ul>

    <ul class="p-0">
        <li>
            <a href="{!!url("/apis")!!}">
                <i class="bx bx-cloud-upload"></i>
                <span class="nav-item fw-bold text-nowrap">API's</span>
            </a>
            <span class="tooltip fw-bold text-nowrap">API's</span>
        </li>
    </ul>

    <ul class="p-0 position-absolute bottom-0">
        <li>
            <a href="" id="logout">
                <i class="bx bx-log-out"></i>
                <span class="nav-item fw-bold">Logout</span>
            </a>
            <span class="tooltip fw-bold">Logout</span>
        </li>
    </ul>
</div>