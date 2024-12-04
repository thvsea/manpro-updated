<div class="flex items-center justify-center h-screen bg-gray-100">

    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold text-center mb-6 text-gray-800">Login</h2>

        <form action="#" method="POST" class="space-y-4">
            <!-- Email Input -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" required
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <!-- Password Input -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" id="password" name="password" required
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <!-- Login Button -->
            <div>
                <button type="submit"
                        class="w-full bg-indigo-600 text-white font-semibold py-2 rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    Login
                </button>
            </div>
        </form>

        <!-- Register Link -->
        <p class="mt-4 text-sm text-center text-gray-600">
            Don't have an account? <a href="#" class="text-indigo-500 hover:underline">Sign up</a>
        </p>
    </div>

</div>