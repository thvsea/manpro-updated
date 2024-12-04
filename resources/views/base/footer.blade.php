<footer class="bg-white text-black py-8">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="w-2/3 pr-4">
                    <img src="{{ asset('Mekarsari.png') }}" alt="Mekar Sari" width="400">
                    <p class="text-gray-400">JL Teuku Umar No.9, Keprabon, Kec. Banjarsari, Kota Surakarta, Jawa Tengah 57131</p>
                </div>
                <div>
                    <h5 class="text-lg text-gray-400 py-12">Links</h5>
                    <ul class="space-y-6">
                        <li><a href="{{route('home')}}" class="hover:underline">Home</a></li>
                        <li><a href="{{route('shop')}}" class="hover:underline">Shop</a></li>
                        <li><a href="{{route('about')}}" class="hover:underline">About</a></li>
                        <li><a href="{{route('contact')}}" class="hover:underline">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h5 class="text-lg text-gray-400 py-12">Help</h5>
                    <ul class="space-y-6">
                        <li><a href="#" class="hover:underline">Payment Options</a></li>
                        <li><a href="#" class="hover:underline">Returns</a></li>
                        <li><a href="#" class="hover:underline">Privacy Policies</a></li>
                    </ul>
                </div>
                <div>
                    <h5 class="text-lg text-gray-400 py-12">Newsletter</h5>
                    <form>
                        <div class="flex items-center">
                            <input type="email" class="w-64 p-2 rounded-l-md border border-black" placeholder="Enter Your Email Address" required>
                            <button class="bg-white-500 text-black px-4 py-2 rounded-r-md">Subscribe</button>
                        </div>
                    </form>
                </div>
            </div>
            <hr class="mt-10">
            <div class="text-center mt-8">
                <p class="text-sm">&copy; 2024 MekarSari. All rights reserved.</p>
            </div>
        </div>
    </footer>