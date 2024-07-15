<x-layout></x-layout>
<x-teachernav>


    <div class="max-w-4xl mx-auto bg-white p-5 rounded-md shadow-md">
        <h3 class="text-lg font-medium leading-6 text-gray-900">Parent Profile</h3>
        <p class="mt-1 text-sm text-gray-600">This is the parent's details.</p>
        <form action="/teacher/addparent" method="POST" id="parent-form" class="my-11">
            @csrf
            <div class="shadow sm:rounded-md sm:overflow-hidden">
                <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                    <div class="grid grid-cols-3 gap-6">
                        <div class="col-span-3 sm:col-span-2">
                            <label for="parent_name" class="block text-sm font-medium text-gray-700">Parent Name</label>
                            <div class="mt-1 flex rounded-md shadow-sm">
                                <input type="text" name="parent_name" id="parent_name" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300" placeholder="" required>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-3 gap-6">
                        <div class="col-span-3 sm:col-span-2">
                            <label for="parent_email" class="block text-sm font-medium text-gray-700">Email</label>
                            <div class="mt-1 flex rounded-md shadow-sm">
                                <input type="text" name="parent_email" id="parent_email" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300" placeholder="Kiambu" required>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-3 gap-6">
                        <div class="col-span-3 sm:col-span-2">
                            <label for="parent_phonenumber" class="block text-sm font-medium text-gray-700">Phone Number</label>
                            <div class="mt-1 flex rounded-md shadow-sm">
                                <input type="text" name="parent_phonenumber" id="parent_phonenumber" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300" placeholder="0712345689" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="max-w-4xl mx-auto bg-white p-5 rounded-md shadow-md mt-10">
                <h2 class="center-text text-2xl font-bold mb-6">Student Information</h2>
                <div id="students">

                    <div class="staff-member flex space-x-4 mb-4">
                        <input type="hidden" name="teacher_id" value="{{auth()->user()->id}}">

                        <div>
                            <label for="first_name" class="block text-sm font-medium text-gray-700">Admission Number</label>
                            <input type="text" name="admission[]" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                        </div>
                        <div>
                            <label for="first_name" class="block text-sm font-medium text-gray-700">First name</label>
                            <input type="text" name="first_name[]" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                        </div>
                        <div>
                            <label for="last_name" class="block text-sm font-medium text-gray-700">Last name</label>
                            <input type="text" name="last_name[]" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                        </div>


                        <div class="flex items-end">
                            <button type="button" id="add-staff" class="focus:outline-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-500 hover:text-green-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Save
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('add-staff').addEventListener('click', function () {
            var staffMembers = document.getElementById('students');
            var newStaffMember = staffMembers.children[0].cloneNode(true);
            var inputs = newStaffMember.getElementsByTagName('input');
            for (var i = 0; i < inputs.length; i++) {
                inputs[i].value = '';
            }
            var addButton = newStaffMember.querySelector('button');
            if (addButton) {
                addButton.remove();
            }
            staffMembers.appendChild(newStaffMember);
        });

        document.getElementById('parent-form').addEventListener('submit', function (e) {
            if (this.classList.contains('submitted')) {
                e.preventDefault();
            } else {
                this.classList.add('submitted');
            }
        });
    </script>

    <div class="hidden sm:block" aria-hidden="true">
        <div class="py-5">
            <div class="border-t border-gray-200"></div>
        </div>
    </div>
</x-teachernav>

