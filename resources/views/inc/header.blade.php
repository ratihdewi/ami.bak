<header class="header" id="header">
    <div class="logo">
        <img src="/asset/logo_modified.png" alt="Logo-UPer" width="225"/>
    </div>
    <div class="sidebarToggle">
        <button type="button" id="sidebarToggle" class="btn border border-0">
            <i class="bx bx-menu h4"></i>
        </button>
    </div>
    <div class="btn-group profile_account">
        <button
            class="btn btn-secondary dropdown-toggle rounded-pill"
             
            data-bs-toggle="dropdown"
            aria-expanded="false"
        >
            <img src="/asset/profile.png" alt="Account" width="25" />
            {{ Auth::user()->name }}
        </button>
        <ul class="dropdown-menu">
            <li>
                <a class="dropdown-item" href="/auditor-detailauditor" style="text-decoration: none; color:black">Profil</a>
            </li>
            <li
                @if (Auth::user()->role_id != '3')
                    hidden
                @endif
                @if (Auth::user()->peran == 'superadmin')
                    class="roleSuperAdmin opacity-50 disabled"
                @endif
            >
                <a class="dropdown-item" href="/changerolespm/{{ Auth::user()->id }}" style="text-decoration: none; color:black">Beralih Role (Super Admin)</a>
            </li>
            <li
                @if (Auth::user()->role_id != '1')
                    hidden
                @endif
                @if (Auth::user()->peran == 'spm')
                    class="roleSPM disabled"
                @endif
            >
                <a class="dropdown-item" href="/changerolespm/{{ Auth::user()->id }}" style="text-decoration: none; color:black">Beralih Role (SPM)</a>
            </li>
            <li 
                @if (count(Auth::user()->auditor()->get('user_id')) == 0 )
                    hidden
                @endif
                @if (Auth::user()->peran == 'auditor')
                    class="roleAuditor disabled"
                @endif
            >
                <a class="dropdown-item" href="/changeroleauditor/{{ Auth::user()->id }}" style="text-decoration: none; color:black">Beralih Role (Auditor)</a>
            </li>
            <li
                @if (count(Auth::user()->auditee()->get('user_id')) == 0)
                    @if (count(Auth::user()->anggotaauditee()->get()) == 0)
                        hidden
                    @else
                        @foreach (Auth::user()->anggotaauditee()->get()->unique('auditee_id') as $item)
                            @if ( ($item->posisi == '0'))
                                hidden
                            @endif
                        @endforeach
                    @endif
                @endif
                @if (Auth::user()->peran == 'auditee')
                    class="roleAuditee disabled"
                @endif
            >
                <a class="dropdown-item" href="/changeroleauditee/{{ Auth::user()->id }}" style="text-decoration: none; color:black">Beralih Role (Auditee)</a>
            </li>
            <li
                @if (Auth::user()->role_id == 1)
                    hidden
                @endif
                @if (Auth::user()->peran == 'user')
                    class="roleAuditee disabled"
                @endif
            >
                <a class="dropdown-item" href="/changeroleuser/{{ Auth::user()->id }}" style="text-decoration: none; color:black">Beralih Role (User)</a>
            </li>
            <li>
                <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    SignOut
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
</header>

@push('script')
    <script>
        $(document).ready(function() {
            // $("#nav-bar").toggleClass("");
            $("#sidebarToggle").on("click", function() {
                $("#nav-bar").toggleClass("active");
                $("#body-pd").toggleClass("body-pd");
                $(this).toggleClass("active");
            });
        });
    </script>
@endpush
