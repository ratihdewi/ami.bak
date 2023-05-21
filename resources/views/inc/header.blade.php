<header class="header" id="header">
    <div class="header_toggle">
        <i class="bx bx-menu" id="header-toggle"></i>
    </div>
    <div class="profile_account">
        <button
            class="btn btn-secondary dropdown-toggle rounded-pill"
            type="button"
            data-bs-toggle="dropdown"
            aria-expanded="false"
        >
            <img src="asset/profile.png" alt="Account" width="25" />
            {{ Auth::user()->name }}
        </button>
        <ul class="dropdown-menu ">
            <li><a class="dropdown-item" href="#">Profile</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
        </ul>
    </div>
</header>
