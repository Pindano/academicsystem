<!doctype html>

<title>Academika</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.css" rel="stylesheet" />


<body style="font-family: Open Sans, sans-serif">



    @if (session('success'))
        <div
            id="success"
            x-data="{show: true}"
            x-init="setTimeout( ()=> show = false, 4000)"
            x-show="show"
            class="fixed bg-green-500  text-white py-2 px-4 rounded-xl bottom-3 right-3 text-sm">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1 1 0 010-1.414L17.086 10l-2.738-2.736a1 1 0 011.415-1.415l2.738 2.736 2.738-2.736a1 1 0 011.415 1.415L18.413 10l2.738 2.736a1 1 0 01-1.415 1.415l-2.738-2.736-2.738 2.736a1 1 0 01-1.415 0z"/></svg>
            </span>
        </div>
    @endif
</body>
