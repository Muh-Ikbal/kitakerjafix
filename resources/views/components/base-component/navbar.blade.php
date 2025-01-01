<nav class="bg-[#1E56A0] border-b-2 fixed top-0 flex justify-between left-0 w-full z-50">
    {{-- logo --}}

    <div class="block md:flex justify-between items-center px-5 py-4">
        <div class="p-2">
            <a href="/">
                <img src="{{ asset('img/kita-kerja.png') }}" class="h-12 w-12" alt="">
            </a>
        </div>
        <div id="mobile-navbar" class=" hidden md:hidden mt-3 #md:mt-0">
            <div>
                <ul class=" flex flex-col md:flex-row gap-4 font-semibold text-white">
                    <li class=""><a href="/"> Home</a></li>
                    <li><a href="#"> About</a></li>
                    <li><a href="/layanan"> Layanan</a></li>
                    @guest
                        <li><a href="{{ route('login') }}">
                                Sign In
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('register') }}">
                                Sign Up
                            </a>
                        </li>
                    @endguest

                </ul>
            </div>

        </div>
    </div>
    <div class="flex gap-2 md:gap-8 md:items-center  font-semibold px-5 py-4  md:mt-0">
        <div id="mobile-navbar" class=" hidden py-4 md:flex items-center gap-28 mt-3 #md:mt-0">
            <div>
                <ul class=" flex flex-col md:flex-row gap-4 #md:gap-12 font-semibold text-white">
                    <li class=""><a href="/"> Home</a></li>
                    <li><a href="#"> About</a></li>
                    <li><a href="/layanan"> Layanan</a></li>
                </ul>
            </div>

        </div>
        {{-- Jika belum login --}}
        <div class="hidden md:flex items-center gap-3 ">
            @guest

                <a href="{{ route('login') }}">
                    <button class="bg-white py-2 px-6 rounded-[12px] text-[#1e56a0]">Sign In
                    </button>
                </a>

                <a href="{{ route('register') }}">
                    <button class="bg-[#FFB000] py-2 px-6 rounded-[12px] text-white">
                        Sign Up
                    </button>
                </a>
            @endguest
        </div>


        {{-- Jika sudah login --}}
        @auth
            <div class=" py-4 md:flex md:items-center">
                <button id="modal-btn" class="mt-0 ">
                    <img src="{{ asset('profile.svg') }}" class="w-6 " alt="">
                </button>
            </div>

            {{-- modal --}}
            <div id="my-modal" class="modal">
                <div class="modal-content md:w-[40%] md:my-[10%]">
                    <div class="my-2 px-2">
                        <span class="close ">&times;</span>
                        {{-- <h2>Modal Header</h2> --}}
                    </div>
                    <div class="modal-body">
                        <h2 class="text-center text-lg border-b-2 font-bold">{{ auth()->user()->name }}</h2>
                        <ul class="flex flex-col gap-3 font-semibold mt-2">
                            <li><a href="{{ route('order.myorder') }}">my order</a></li>
                            <li><a href="/profile">profile</a></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="">
                                        Log Out
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                    <div class="">
                        {{-- <h3>Modal Footer</h3> --}}
                    </div>
                </div>
            </div>
        @endauth
        <div class="md:hidden px-3 py-4">
            <button>
                <img class="w-6" id="toggle-navbar" src="{{ asset('mobile-menu-icon.svg') }}" alt="">
            </button>
        </div>
    </div>
    {{-- modal --}}




</nav>
