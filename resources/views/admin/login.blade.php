<x-layout></x-layout>
<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="bg-white p-8 rounded-lg shadow-lg max-w-md w-full">
        <h2 class="text-2xl font-bold mb-8 text-gray-800 text-center">Welcome back</h2>
        <form method="post" action="/admin">
            @csrf
            <div class="mb-6">
                <label for="email" class="block mb-2 uppercase font-bold text-xs text-gray-700">
                    Email
                </label>
                <input class="border border-gray-400 p-2 w-full rounded"
                       type="text"
                       name="email"
                       id="email"
                       value="{{ old('email') }}"
                       required
                >
                @error('email')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="password" class="block mb-2 uppercase font-bold text-xs text-gray-700">
                    Password
                </label>
                <input class="border border-gray-400 p-2 w-full rounded"
                       type="password"
                       name="password"
                       id="password"
                       required
                >
                @error('password')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-6">
                <button type="submit"
                        class="bg-blue-500 text-white rounded py-2 px-4 hover:bg-blue-700 w-full">
                    Login
                </button>
            </div>
        </form>
    </div>
</div>

