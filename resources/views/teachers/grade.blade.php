<x-layout>
</x-layout>
<x-teachernav>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg my-12">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>

                <th scope="col" class="px-6 py-3">Class Name</th>
                <th scope="col" class="px-6 py-3">Subject</th>
                <th scope="col" class="px-6 py-3">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($subjects as $subject)
                @foreach($subject->darasas as $darasa)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">

                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $darasa->classname }}
                        </td>
                        <td class="px-6 py-4">{{ $subject->subjectname }}</td>
                        <td class="px-6 py-4">
                            <a href="/{{ $examination->id }}/{{$darasa->id }}/{{ $teacher->id }}/{{ $subject->id }}/" data-modal-target="crud-modal" data-modal-toggle="crud-modal" class="grade-btn block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                               data-teacher="{{ $teacher->id }}"
                               data-class="{{ $darasa->id }}"
                              data-subject="{{ $subject->id }}"
                               data-examination="{{ $examination->id }}"
                               type="button">
                                Grade
                            </a>
                        </td>
                    </tr>
                @endforeach
            @endforeach
            </tbody>
        </table>
    </div>

    <div id="crud-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white" id="modal-title">
                        Grading
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <div class="p-4 md:p-5">
                    <table id="student-table" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead>
                        <tr>
                            <th>Admission Number</th>
                            <th>Student Name</th>
                            <th>Grade</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>

                    <button id="submit-grades" type="button" class="mt-4 block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit Grades</button>
                </div>
            </div>
        </div>
    </div>
    <div
        id="success"

        x-init="setTimeout( ()=> show = false, 4000)"

        class="fixed bg-green-500  text-white py-2 px-4 rounded-xl bottom-3 right-3 text-sm">

    </div>

</x-teachernav>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let teacherId, classId, subjectId, examinationId, token;

        document.querySelectorAll('.grade-btn').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();

                teacherId = this.getAttribute('data-teacher');
                classId = this.getAttribute('data-class');
                subjectId = this.getAttribute('data-subject');
                examinationId = this.getAttribute('data-examination');
                token = document.head.querySelector('meta[name="csrf-token"]').getAttribute('content');

                fetch(`/teacher/${teacherId}/grade/${classId}/${subjectId}`, {
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': token,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        // Check if data.class and data.subject exist
                        if (data.class && data.subject) {
                            document.getElementById('modal-title').textContent = `Grading for ${data.class.classname} - ${data.subject.subjectname}`;
                        } else {
                            console.error('Class or subject data missing in response');
                            return;
                        }

                        let tbody = document.querySelector('#student-table tbody');
                        tbody.innerHTML = '';

                        // Render students if available
                        if (data.students && data.students.length > 0) {
                            data.students.forEach(student => {
                                let tr = document.createElement('tr');
                                tr.innerHTML = `
                                <td>${student.id}</td>
                                <td>${student.name}</td>
                                <td><input type="text" name="grades[${student.id}]" value=""></td>
                            `;
                                tbody.appendChild(tr);
                            });
                        } else {
                            console.warn('No students found for this class');
                        }

                        document.getElementById('crud-modal').classList.remove('hidden');
                    })
                    .catch(error => {
                        console.error('Error fetching or parsing data:', error);
                    });
            });
        });

        document.querySelector('[data-modal-toggle="crud-modal"]').addEventListener('click', function() {
            document.getElementById('crud-modal').classList.add('hidden');
        });

        document.getElementById('submit-grades').addEventListener('click', function() {
            let formData = new FormData();
            document.querySelectorAll('#student-table input[type="text"]').forEach(input => {
                formData.append(input.name, input.value);
            });

            console.log('Teacher ID:', teacherId);
            console.log('Class ID:', classId);
            console.log('Subject ID:', subjectId);
            console.log('Examination ID:', examinationId);

            formData.append('examination_id', examinationId);
            formData.append('teacherId', teacherId);
            formData.append('classId', classId);
            formData.append('subjectId', subjectId);

            fetch(`/teacher/${teacherId}/grade/${classId}/${subjectId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json'
                },
                body: formData
            })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    document.getElementById('success').textContent = data.message;
                })
                .catch(error => {
                    console.error('Error submitting grades:', error);
                });
        });
    });
</script>
