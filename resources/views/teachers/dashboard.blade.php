<x-layout></x-layout>


    <x-teachernav>

        <div class="container mx-auto mt-10">
            <div class="bg-white shadow-lg rounded-lg `p-6">
                <div class="flex items-center">
                    <div class="bg-blue-500 text-white rounded-full h-16 w-16 flex items-center justify-center">
                        <span class="text-2xl font-bold">{{ substr($teacher->name, 0, 2) }}</span>
                    </div>
                    <div class="ml-4">
                        <h1 class="text-2xl font-bold">{{ $teacher->name }}</h1>
                        <p class="text-gray-600">{{ $teacher->email }}</p>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-6 mt-6">
                    <div>
                        <h2 class="text-xl font-semibold">Basic Info</h2>
                        <div class="mt-2">
                            <p class="text-gray-600">User principal name: <span class="font-medium">{{ $teacher->email }}</span></p>
                            <p class="text-gray-600">Created date time: <span class="font-medium">{{ $teacher->created_at }}</span></p>
                        </div>
                    </div>

                </div>
                <div class="mt-6">
                    <h2 class="text-xl font-semibold">Manage Class and Subjects</h2>
                    <div class="mt-2">
                        <h3 class="text-lg font-medium">Assigned Class</h3>
                        @if($teacher->classes->isNotEmpty())
                            @foreach($teacher->classes as $class)
                                <p class="text-gray-700">Class: {{ $class->classname }}</p>
                            @endforeach
                        @else
                            <p class="text-gray-700">No class assigned.</p>

                        @endif
                    </div>
                    <div class="mt-6">
                        <h3 class="text-lg font-medium">Assigned Subjects</h3>
                        @if($teacher->subjects->isNotEmpty())
                            <ul class="list-disc list-inside text-gray-700">
                                @foreach($teacher->subjects as $subject)
                                    <li>{{ $subject->subjectname }}
                                        (Class: {{ $subject->darasa->classname  }})
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-gray-700">No subjects assigned.</p>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </x-teachernav>


