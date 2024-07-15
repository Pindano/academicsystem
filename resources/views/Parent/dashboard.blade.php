<x-layout></x-layout>
<x-parentnav :parent="$parent">
    <div class="max-w-4xl mx-auto bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
        <div class="flex items-center mb-4">
            <label for="studentSelect" class="mr-2 font-semibold">Select Student:</label>
            <select id="studentSelect" class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:border-blue-500">
                @foreach($students as $student)
                    <option value="{{$student->id}}">{{$student->name}}</option>
                @endforeach
            </select>
            <button id="fetchExamsBtn" class="ml-4 px-4 py-2 bg-blue-500 text-white rounded-lg shadow-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">
                Fetch Exams
            </button>
        </div>

        <div id="exam-list" class="mt-4" style="display: none;">
            <h2 class="text-lg font-semibold mb-2">Exams</h2>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Exam Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Term
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Class
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>

                    </tr>
                    </thead>
                    <tbody id="exam-items"></tbody>
                </table>
            </div>
        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const studentSelect = document.getElementById('studentSelect');
            const fetchExamsBtn = document.getElementById('fetchExamsBtn');
            const examListSection = document.getElementById('exam-list');
            const examReportSection = document.getElementById('exam-report');

            fetchExamsBtn.addEventListener('click', function() {
                const studentId = studentSelect.value;
                fetchExams(studentId);
            });
        });

        function fetchExams(studentId) {
            let token = document.head.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch(`/student/${studentId}/exams`, {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json'
                }
            })
                .then(response => response.json())
                .then(data => {
                    const marks = data.exams || [];
                    const examList = document.getElementById('exam-items');
                    examList.innerHTML = '';

                    marks.forEach(mark => {
                        const row = document.createElement('tr');
                        row.classList.add('bg-white', 'border-b', 'dark:bg-gray-800', 'dark:border-gray-700', 'hover:bg-gray-50', 'dark:hover:bg-gray-600');
                        row.innerHTML = `
                        <td class="px-6 py-4">${mark.exam_name}</td>
                        <td class="px-6 py-4">${mark.term}</td>
                        <td class="px-6 py-4">${mark.class_name}</td>
                        <td class="px-6 py-4">
                            <a  class="font-medium text-blue-600 dark:text-blue-500 hover:underline" href="/parent/${studentId}/performance">View Report</a>
                        </td>
                    `;
                        examList.appendChild(row);
                    });

                    document.getElementById('exam-list').style.display = 'block';
                })
                .catch(error => {
                    console.error('Error fetching exams:', error);
                });
        }

    </script>
</x-parentnav>
