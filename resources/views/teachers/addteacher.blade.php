<x-layout></x-layout>
<x-teachernav>
    <div class="max-w-4xl mx-auto bg-white p-5 rounded-md shadow-md">
        <form action="{{ route('school.store') }}" method="POST" id="school-form" class="my-11">
            @csrf
            <div class="max-w-4xl mx-auto bg-white p-5 rounded-md shadow-md mt-10">
                <h2 class="center-text text-2xl font-bold mb-6">Teacher Information</h2>
                <div id="staff-members">
                    <div class="staff-member flex space-x-4 mb-4">
                        <div>
                            <label for="first_name" class="block text-sm font-medium text-gray-700">First name</label>
                            <input type="text" name="first_name[]" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div>
                            <label for="last_name" class="block text-sm font-medium text-gray-700">Last name</label>
                            <input type="text" name="last_name[]" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div>
                            <label for="email_address" class="block text-sm font-medium text-gray-700">Email address</label>
                            <input type="text" name="email_address[]" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                        </div>
                        <div>
                            <label for="phone_number" class="block text-sm font-medium text-gray-700">Phone number</label>
                            <input type="text" name="phone_number[]" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
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
            var staffMembers = document.getElementById('staff-members');
            var newStaffMember = staffMembers.children[0].cloneNode(true);
            var inputs = newStaffMember.getElementsByTagName('input');
            for (var i = 0; i < inputs.length; i++) {
                inputs[i].value = '';
            }
            staffMembers.appendChild(newStaffMember);
        });

        document.getElementById('school-form').addEventListener('submit', function (e) {
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
