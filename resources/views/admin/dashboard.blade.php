<x-layout>
    <x-navbar>
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
            <div class="grid grid-cols-3 gap-4 mb-4">

                <a href="/admin/school" class="flex flex-col items-center justify-center h-24 rounded bg-gray-50 dark:bg-gray-800 p-4">
                    <svg class="w-10 h-10 text-gray-500 dark:text-gray-400 mb-2" fill="none" stroke="currentColor"
                         viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 2L2 7h20L12 2z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M2 17h20v5H2v-5z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M2 12h20v5H2v-5z"></path>
                    </svg>
                    <p class="text-lg text-gray-700 dark:text-gray-300">Schools</p>
                    <p class="text-2xl text-gray-400 dark:text-gray-500">{{\App\Models\School::count()}}</p>
                </a>
                <!-- Total Parents Card -->
                <a href="/admin/parents" class="flex flex-col items-center justify-center h-24 rounded bg-gray-50 dark:bg-gray-800 p-4">
                    <svg class="w-10 h-10 text-gray-500 dark:text-gray-400 mb-2" fill="none" stroke="currentColor"
                         viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M16 14a4 4 0 10-8 0M12 18v4M4 22h16"></path>
                    </svg>
                    <p class="text-lg text-gray-700 dark:text-gray-300">Parents</p>
                    <p class="text-2xl text-gray-400 dark:text-gray-500">{{\App\Models\Parents::count()}}</p>
                </a>
                <!-- Total Teachers Card -->
                <a href="/admin/teachers" class="flex flex-col items-center justify-center h-24 rounded bg-gray-50 dark:bg-gray-800 p-4">
                    <svg class="w-10 h-10 text-gray-500 dark:text-gray-400 mb-2" fill="none" stroke="currentColor"
                         viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 12c2.21 0 4-1.79 4-4S14.21 4 12 4 8 5.79 8 8s1.79 4 4 4z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 14c-2.33 0-7 1.17-7 3.5V20h14v-2.5c0-2.33-4.67-3.5-7-3.5z"></path>
                    </svg>
                    <p class="text-lg text-gray-700 dark:text-gray-300">Teachers</p>
                    <p class="text-2xl text-gray-400 dark:text-gray-500">{{\App\Models\Teacher::count()}}</p>
                </a>
                <!-- Total Students Card -->
                <a href="/admin/students" class="flex flex-col items-center justify-center h-24 rounded bg-gray-50 dark:bg-gray-800 p-4">
                    <svg class="w-10 h-10 text-gray-500 dark:text-gray-400 mb-2" fill="none" stroke="currentColor"
                         viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 2L2 7h20L12 2z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 11v11m0 0H5v-6h14v6h-7z"></path>
                    </svg>
                    <p class="text-lg text-gray-700 dark:text-gray-300">Students</p>
                    <p class="text-2xl text-gray-400 dark:text-gray-500">{{\App\Models\Student::count()}}</p>
                </a>
            </div>
        </div>
    </x-navbar>


</x-layout>

