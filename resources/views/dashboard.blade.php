<x-app-layout>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">
                <div class="p-6">
                    <div class="flex justify-center">
                        <div
                            class="p-4 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-md">
                            @if (auth()->user()->role == 'student')
                                @include('qr-code')
                            @elseif(auth()->user()->role == 'teacher')
                                @include('verify-student')
                            @endif
                        </div>
                    </div>
                    <div class="mt-8 text-center">
                        <a href="{{ route('profile.edit') }}"
                            class="px-6 py-2 bg-blue-600 text-white font-semibold rounded-md shadow hover:bg-blue-700 transition">
                            Edit Profile
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://unpkg.com/html5-qrcode/minified/html5-qrcode.min.js"></script>
