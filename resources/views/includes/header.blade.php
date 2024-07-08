<div class="navbar bg-gray-800 p-4 shadow-lg">
    <div class="navbar-inner flex items-center justify-between">
        <a id="logo" href="/" class="text-white text-2xl font-bold">Simbarka</a>

        <ul class="nav flex space-x-4">
            @guest
                <li><a href="/" class="text-gray-300 hover:text-white transition duration-300">Home</a></li>
                <li><a href="{{ route('login.form') }}" class="text-gray-300 hover:text-white transition duration-300">Login</a></li>
            @else
                <li><a href="/" class="text-gray-300 hover:text-white transition duration-300">Home</a></li>
                <li class="relative">
                    <span id="user-dropdown" class="text-gray-300 hover:text-white transition duration-300 cursor-pointer">{{ Auth::user()->name }}</span>
                    <ul id="dropdown-menu" class="hidden origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-gray-800 ring-1 ring-black ring-opacity-5 focus:outline-none" aria-labelledby="user-dropdown">
                        <li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="block px-4 py-2 text-sm text-white hover:bg-gray-700">Logout</a>
                            </form>
                        </li>
                    </ul>
                </li>
            @endguest
        </ul>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Tampilkan dropdown saat nama pengguna di klik
        document.getElementById('user-dropdown').addEventListener('click', function () {
            document.getElementById('dropdown-menu').classList.toggle('hidden');
        });

        // Sembunyikan dropdown saat klik di luar dropdown
        document.addEventListener('click', function (event) {
            const dropdownMenu = document.getElementById('dropdown-menu');
            const userDropdown = document.getElementById('user-dropdown');
            if (!userDropdown.contains(event.target)) {
                dropdownMenu.classList.add('hidden');
            }
        });

        // Ajax request untuk logout
        document.getElementById('logout-form').addEventListener('submit', function (event) {
            event.preventDefault();
            axios.post('{{ route('logout') }}')
                .then(function (response) {
                    // Redirect ke halaman setelah logout berhasil
                    window.location.href = '/';
                })
                .catch(function (error) {
                    console.error('Logout error:', error);
                });
        });
    });
</script>
