<x-layout>
        <div class="container mx-auto p-6 bg-white shadow-md">
            <div class="flex">
                <!-- Sidebar -->
                <div class="w-1/4 bg-gray-800 text-white h-screen">
                    <div class="p-4">
                        <h2 class="text-2xl font-bold mb-4">Parent Dashboard</h2>
                        <ul class="space-y-4">
                            <li>
                                <a href="#overview" class="block p-2 rounded hover:bg-gray-700">Overview</a>
                            </li>
                            <li>
                                <a href="#performance" class="block p-2 rounded hover:bg-gray-700">Student Performance</a>
                            </li>
                            <li>
                                <a href="#attendance" class="block p-2 rounded hover:bg-gray-700">Attendance Records</a>
                            </li>
                            <li>
                                <a href="#activities" class="block p-2 rounded hover:bg-gray-700">School Activities</a>
                            </li>
                            <li>
                                <a href="/chat" class="block p-2 rounded hover:bg-gray-700">Inbox</a>
                            </li>
                            <li>
                                <a href="#feedback" class="block p-2 rounded hover:bg-gray-700">Feedback and Support</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Main Content -->
                <div class="w-3/4 p-6">
                    <!-- Overview Section -->
                    <section id="overview" class="mb-6">
                        <h2 class="text-xl font-semibold mb-4">Overview</h2>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="bg-gray-100 p-4 rounded-lg">
                                <h3 class="text-lg font-medium">Overall Performance</h3>
                                <p>Average Grade: A</p>
                                <p>Attendance: 95%</p>
                            </div>
                            <div class="bg-gray-100 p-4 rounded-lg">
                                <h3 class="text-lg font-medium">Recent Grades</h3>
                                <ul>
                                    <li>Math: A</li>
                                    <li>Science: B+</li>
                                    <li>English: A-</li>
                                </ul>
                            </div>
                            <div class="bg-gray-100 p-4 rounded-lg">
                                <h3 class="text-lg font-medium">Upcoming Events</h3>
                                <ul>
                                    <li>Parent-Teacher Meeting: June 15</li>
                                    <li>School Trip: July 20</li>
                                </ul>
                            </div>
                        </div>
                    </section>
        
                    <!-- Student Performance Section -->
                    <section id="performance" class="mb-6">
                        <h2 class="text-xl font-semibold mb-4">Student Performance</h2>
                        <div class="bg-gray-100 p-4 rounded-lg">
                            <h3 class="text-lg font-medium">Subject-wise Performance</h3>
                            <p>Details of grades and assignments.</p>
                        </div>
                    </section>
        
                    <!-- Attendance Section -->
                    <section id="attendance" class="mb-6">
                        <h2 class="text-xl font-semibold mb-4">Attendance Records</h2>
                        <div class="bg-gray-100 p-4 rounded-lg">
                            <h3 class="text-lg font-medium">Attendance Logs</h3>
                            <p>Daily, weekly, and monthly attendance records.</p>
                        </div>
                    </section>
        
                    <!-- School Activities Section -->
                    <section id="activities" class="mb-6">
                        <h2 class="text-xl font-semibold mb-4">School Activities</h2>
                        <div class="bg-gray-100 p-4 rounded-lg">
                            <h3 class="text-lg font-medium">Event Calendar</h3>
                            <p>Calendar of upcoming events with options to RSVP.</p>
                        </div>
                    </section>
        
                    <!-- Communication Tools Section -->
                    <section id="communication" class="mb-6">
                        <h2 class="text-xl font-semibold mb-4">Communication Tools</h2>
                        <div class="bg-gray-100 p-4 rounded-lg">
                            <h3 class="text-lg font-medium">Messages</h3>
                            <p>Messaging system to communicate with teachers.</p>
                        </div>
                    </section>
        
                    <!-- Feedback and Support Section -->
                    <section id="feedback" class="mb-6">
                        <h2 class="text-xl font-semibold mb-4">Feedback and Support</h2>
                        <div class="bg-gray-100 p-4 rounded-lg">
                            <h3 class="text-lg font-medium">Provide Feedback</h3>
                            <p>Option to provide feedback and access support resources.</p>
                        </div>
                    </section>
                </div>
            </div>
        </div>


</x-layout>

