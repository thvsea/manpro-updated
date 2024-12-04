<header x-data="{ mobileMenuOpen: false }" class="p-4 bg-white shadow">
    <div class="container mx-auto">
        <div class="flex items-center justify-between">
            <!-- Logo -->
            <div class="text-2xl font-bold">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('Mekarsari.png') }}" alt="Mekar Sari" width="150">
                </a>
            </div>

            <!-- Mobile Menu Button -->
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="block md:hidden">
                <i class="text-2xl fas fa-bars"></i>
            </button>

            <!-- Desktop Navigation -->
            <nav class="hidden space-x-8 text-lg md:block">
                <a href="{{ route('home') }}" class="hover:text-gray-700">Home</a>
                <a href="{{ route('about') }}" class="hover:text-gray-700">About</a>
                <a href="{{ route('contact') }}" class="hover:text-gray-700">Contact</a>
            </nav>

            <!-- Desktop User Menu -->
            <div class="items-center hidden space-x-8 md:flex">
                <!-- User Icon and Dropdown -->
                <div class="relative z-50 group">
                    @auth
                        <!-- User Icon with the Name -->
                        <a href="{{ auth()->check() ? route('profile.edit') : route('login') }}" class="flex items-center space-x-2 text-xl hover:text-gray-700">
                            <i class="fas fa-user"></i>
                            <span class="ml-2">{{ auth()->user()->name }}</span>
                        </a>
                        <div class="absolute right-0 z-10 hidden w-48 bg-white border rounded-md shadow-lg group-hover:block">
                            <div class="py-1">
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    {{ __('Profile') }}
                                </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full px-4 py-2 text-sm text-left text-gray-700 hover:bg-gray-100">
                                        {{ __('Log Out') }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-xl hover:text-gray-700">
                            <i class="fas fa-sign-in-alt"></i>
                            Login
                        </a>
                    @endauth
                </div>

                @auth
                    <a href="{{ route('orders.view') }}" class="text-2xl hover:text-gray-700">
                        <i class="fa-solid fa-clipboard"></i>
                    </a>
                    <a href="{{ route('cart.index') }}" class="text-2xl hover:text-gray-700">
                        <i class="fas fa-shopping-cart"></i>
                    </a>
                @endauth
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileMenuOpen" class="md:hidden">
            <nav class="flex flex-col mt-4 space-y-4">
                <a href="{{ route('home') }}" class="flex items-center hover:text-gray-700">
                    <i class="fas fa-home"></i>
                    <span class="ml-2">Home</span>
                </a>
                <a href="{{ route('about') }}" class="flex items-center hover:text-gray-700">
                    <i class="fas fa-info-circle"></i>
                    <span class="ml-2">About</span>
                </a>
                <a href="{{ route('contact') }}" class="flex items-center hover:text-gray-700">
                    <i class="fas fa-envelope"></i>
                    <span class="ml-2">Contact</span>
                </a>
                
                @auth
                    <a href="{{ route('profile.edit') }}" class="flex items-center hover:text-gray-700">
                        <i class="fas fa-user"></i>
                        <span class="ml-2">Profile</span>
                    </a>
                    <a href="{{ route('orders.view') }}" class="flex items-center hover:text-gray-700">
                        <i class="fa-solid fa-clipboard"></i>
                        <span class="ml-2">Orders</span>
                    </a>
                    <a href="{{ route('cart.index') }}" class="flex items-center hover:text-gray-700">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="ml-2">Cart</span>
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center w-full text-left hover:text-gray-700">
                            <i class="fas fa-sign-out-alt"></i>
                            <span class="ml-2">{{ __('Log Out') }}</span>
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="hover:text-gray-700">Login</a>
                @endauth
            </nav>
        </div>
    </div>
</header>
