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
                        <form method="POST" action="/teacher/unassign-class" class="mt-2">
                            @csrf
                            <input type="hidden" name="teacher_id" value="{{ $teacher->id }}">
                            <button type="submit" class="text-white bg-red-600 hover:bg-red-700 px-4 py-2 rounded-lg">Unassign Class</button>
                        </form>
                        @endforeach
                    @else
                        <p class="text-gray-700">No class assigned.</p>
                        <form method="POST" action="/teacher/assign-class" class="mt-2">
                            @csrf
                            <input type="hidden" name="teacher_id" value="{{ $teacher->id }}">
                            <label for="class" class="block mb-2 text-sm font-medium text-gray-900">Select Class</label>
                            <select id="class" name="class_id" class="block w-full p-2 border border-gray-300 rounded-lg mb-4">

                                @foreach($classes as $class)
                                    <option value="{{ $class->id }}">{{ $class->classname }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="text-white bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-lg">Assign Class</button>
                        </form>
                    @endif
                </div>
                <div class="mt-6">
                    <h3 class="text-lg font-medium">Assigned Subjects</h3>
                    @if($teacher->subjects->isNotEmpty())
                        <ul class="list-disc list-inside text-gray-700">
                            @foreach($teacher->subjects as $subject)
                                <li>{{ $subject->subjectname }}
                                        (Class: {{ $subject->darasa->classname  }})

                                    <form method="POST" action="/teacher/unassign-subject" class="inline">
                                        @csrf
                                        <input type="hidden" name="pivot_id" value="{{ $subject->pivot->id }}">                                        <input type="hidden" name="teacher_id" value="{{ $teacher->id }}">
                                        <input type="hidden" name="subject_id" value="{{ $subject->id }}">
                                        <button type="submit" class="text-red-600 hover:text-red-700 ml-2">Unassign</button>
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-700">No subjects assigned.</p>
                    @endif
                    <form method="POST" action="/teacher/assign-subjects" class="mt-2">
                        @csrf
                        <input type="hidden" name="teacher_id" value="{{ $teacher->id }}">
                        <label for="subject" class="block mb-2 text-sm font-medium text-gray-900">Select Subject</label>
                        <select id="subject" name="subject_id" class="block w-full p-2 border border-gray-300 rounded-lg mb-4">
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}">{{ $subject->subjectname }}</option>
                            @endforeach
                        </select>
                        <label for="classes" class="block mb-2 text-sm font-medium text-gray-900">Select Classes</label>
                        <select id="classes" name="class_ids[]" multiple class="block w-full p-2 border border-gray-300 rounded-lg mb-4">
                            @foreach($classes as $class)
                                <option value="{{ $class->id }}">{{ $class->classname }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="text-white bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-lg">Assign Subjects</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-teachernav>
