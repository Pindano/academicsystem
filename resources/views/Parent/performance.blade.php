<x-layout></x-layout>

<x-parentnav>
    <div class="container mx-auto p-6">
        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="text-center mb-6">
                <h1 class="text-2xl font-bold">Performance Report</h1>
                <p class="text-gray-600">Exam: {{ $marks->first()->exam_name }} | Term: {{ $marks->first()->term }}</p>
                <p class="text-gray-600">Student: {{ $marks->first()->student_name }}</p>
                <p class="text-gray-600">Class: {{ $marks->first()->class_name }}</p>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border-collapse border border-gray-200">
                    <thead>
                    <tr>
                        <th class="py-2 px-4 border-b border-gray-200 text-left">Subject</th>
                        <th class="py-2 px-4 border-b border-gray-200 text-left">Performance</th>
                        <th class="py-2 px-4 border-b border-gray-200 text-left">Grade</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($marks as $mark)
                        <tr>
                            <td class="py-2 px-4 border-b border-gray-200">{{ $mark->subject_name }}</td>
                            <td class="py-2 px-4 border-b border-gray-200">{{ $mark->performance }}</td>
                            <td class="py-2 px-4 border-b border-gray-200">{{ $mark->grade }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td class="py-2 px-4 border-b border-gray-200 font-bold">Total</td>
                        <td class="py-2 px-4 border-b border-gray-200 font-bold">
                            {{ $marks->sum('performance') }}
                        </td>
                        <td class="py-2 px-4 border-b border-gray-200 font-bold">
                            Average Grade: {{ $averageGrade }}
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-parentnav>
