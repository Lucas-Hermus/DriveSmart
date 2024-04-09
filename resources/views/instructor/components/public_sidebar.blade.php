<link href="{{ asset('instructor-public/css/sidebar.css') }}" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<nav class="vertical-menu-wrapper">
    <div class="vertical-menu-logo">
        <span class="open-menu-btn"><hr><hr><hr></span>
    </div>
    <ul class="vertical-menu">

        <a href="{{ route('instructor.dashboard.index') }}" class="navItem">
            <li class="menu-item">
                <i class='bx bxs-dashboard'></i>
                <span>Start pagina</span>
            </li>
        </a>
        <a href="{{ route('instructor.dashboard.contact') }}" class="navItem">
            <li class="menu-item">
                <i class='bx bxs-credit-card-front'></i>
                <span>Contact</span>
            </li>
        </a>
        <a href="{{ route('login') }}" class="navItem">
            <li class="menu-item">
                <i class='bx bxs-car'></i>
                <span>Inloggen</span>
            </li>
        </a>
    </ul>
</nav>
<div class="content-wrapper">
    @yield("content")
</div>
<script>
    function signOut() {
        axios.post('{{ route("signOut") }}')
            .then(response => {
                window.location.href = '{{ route("login") }}';
            })
            .catch(error => {
                // Handle error
                console.error('Error signing out:', error);
            });
    }
</script>
