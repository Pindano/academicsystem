<x-layout></x-layout>
<form method="post" action="/login">
    @csrf
    <div class="mb-6">
        <label for="email" class="block mb-2 uppercase font-bold text-xs text-gray-700">

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

        </label>
        <input class="border border-gray-400 p-2 w-full rounded"
               type="password"
               name="password"
               id="password"
               required
        >

    </div>
    <div class="mb-6">
        <input class="border border-gray-400 p-2 w-full rounded"
               type="submit"
               name="submit"
               id="submit"
               value="Login"
               required
        >
    </div>



</form>

