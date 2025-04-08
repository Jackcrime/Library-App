@extends('layouts.main')

@section('contents')
<div class="min-h-screen bg-cover bg-center flex items-center justify-center px-6 py-12"
    x-data="{ darkMode: false }" :class="{'bg-gray-900 text-white': darkMode, 'bg-white text-gray-800': !darkMode}"
    :style="'background-image: url({{ asset('assets/background.jpg') }});'">

    <div class="shadow-xl rounded-2xl p-10 w-full max-w-3xl my-12"
        :class="darkMode 
        ? 'bg-gray-800 text-white border-gray-600' 
        : 'bg-white text-gray-800 border-gray-300'">

        <h1 class="text-4xl font-extrabold text-center mb-6">
            <i class="fa-solid fa-user-circle" :class="{'text-blue-600': !darkMode, 'text-blue-300': darkMode}"></i> My Profile
        </h1>

        <form id="profile-form" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Profile Picture -->
            <div class="flex flex-col items-center mb-6">
                <div class="relative w-32 h-32 rounded-full bg-gradient-to-r from-blue-500 to-teal-500 p-1 shadow-lg">
                    <img id="profile-pic" src="{{ Auth::user()->foto ?: asset('assets/default.jpg') }}"
                        alt="User  Profile" class="w-full h-full rounded-full object-cover border-4 border-white">
                    <label for="foto" class="absolute bottom-0 right-0 bg-blue-600 text-white p-2 rounded-full cursor-pointer shadow-md">
                        <i class="fa-solid fa-camera"></i>
                        <input type="file" id="foto" name="foto" class="hidden" accept="image/*" onchange="previewImage(event)">
                    </label>
                </div>
                <div class="mt-4 text-center">
                    <h2 class="text-2xl font-semibold">{{ Auth::user()->nama }}</h2>
                    <p class="text-gray-600"><i class="fa-solid fa-envelope"></i> {{ ucfirst(Auth::user()->email) }}</p>
                    <p class="text-gray-600"><i class="fa-solid fa-user"></i> {{ ucfirst(Auth::user()->jenis) }}</p>
                </div>
            </div>

            <!-- Form Fields -->
            <div class="space-y-4">
                <div>
                    <label for="nama" class="block text-sm font-medium">Name</label>
                    <div class="flex items-center border rounded-lg shadow-sm p-2"
                        :class="darkMode 
                        ? 'bg-gray-700 border-gray-600 text-white' 
                        : 'bg-white border-gray-300 text-gray-800'">

                        <i class="fa-solid fa-user px-3"
                            :class="darkmode ? 'text-gray-300' : 'text-gray-400'"></i>
                        <input type="text" id="nama" name="nama" value="{{ Auth::user()->nama }}"
                            class="w-full px-4 py-2 border-none focus:ring-blue-500 focus:outline-none"
                            :class="darkMode 
                        ? 'bg-gray-700 border-gray-600 text-white' 
                        : 'bg-white border-gray-300 text-gray-800'" required>
                    </div>
                </div>

                <!-- Phone -->
                <div>
                    <label for="telepon" class="block text-sm font-medium">Phone</label>
                    <div class="flex items-center border rounded-lg shadow-sm p-2"
                        :class="darkMode 
                        ? 'bg-gray-700 border-gray-600 text-white' 
                        : 'bg-white border-gray-300 text-gray-800'">

                        <i class="fa-solid fa-phone px-3"
                            :class="darkmode ? 'text-gray-300' : 'text-gray-400'"></i>
                        <input type="text" id="telepon" name="telepon" value="{{ Auth::user()->telepon }}"
                            class="w-full px-4 py-2 border-none focus:ring-blue-500 focus:outline-none"
                            :class="darkMode 
                        ? 'bg-gray-700 border-gray-600 text-white' 
                        : 'bg-white border-gray-300 text-gray-800'">
                    </div>
                </div>

                <!-- Address -->
                <div>
                    <label for="alamat" class="block text-sm font-medium">Address</label>
                    <div class="flex items-center border rounded-lg shadow-sm p-2"
                        :class="darkMode 
                        ? 'bg-gray-700 border-gray-600 text-white' 
                        : 'bg-white border-gray-300 text-gray-800'">

                        <i class="fa-solid fa-location-dot px-3"
                            :class="darkmode ? 'text-gray-300' : 'text-gray-400'"></i>
                        <textarea id="alamat" name="alamat"
                            class="w-full px-4 py-2 border-none focus:ring-blue-500 focus:outline-none"
                            :class="darkMode 
                        ? 'bg-gray-700 border-gray-600 text-white' 
                        : 'bg-white border-gray-300 text-gray-800'">{{ Auth::user()->alamat }}</textarea>
                    </div>
                </div>

                <!-- Password Fields -->
                <div>
                    <label for="password" class="block text-sm font-medium">New Password</label>
                    <div class="relative flex items-center border rounded-lg shadow-sm p-2"
                        :class="darkMode 
            ? 'bg-gray-700 border-gray-600 text-white' 
            : 'bg-white border-gray-300 text-gray-800'">

                        <i class="fa-solid fa-lock px-3"
                            :class="darkMode ? 'text-gray-300' : 'text-gray-400'"></i>

                        <input type="password" id="password" name="password" placeholder="Enter new password"
                            class="w-full px-4 py-2 border-none focus:ring-blue-500 focus:outline-none"
                            :class="darkMode 
                ? 'bg-gray-700 text-white' 
                : 'bg-white text-gray-800'">

                        <i id="togglePassword"
                            class="fa-solid fa-eye cursor-pointer px-3 absolute right-3"
                            :class="darkMode ? 'text-gray-300' : 'text-gray-400'"></i>
                    </div>
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium">Confirm New Password</label>
                    <div class="relative flex items-center border rounded-lg shadow-sm p-2"
                        :class="darkMode 
            ? 'bg-gray-700 border-gray-600 text-white' 
            : 'bg-white border-gray-300 text-gray-800'">

                        <i class="fa-solid fa-lock px-3"
                            :class="darkMode ? 'text-gray-300' : 'text-gray-400'"></i>

                        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm new password"
                            class="w-full px-4 py-2 border-none focus:ring-blue-500 focus:outline-none"
                            :class="darkMode 
                ? 'bg-gray-700 text-white' 
                : 'bg-white text-gray-800'">

                        <i id="toggleConfirmPassword"
                            class="fa-solid fa-eye cursor-pointer px-3 absolute right-3"
                            :class="darkMode ? 'text-gray-300' : 'text-gray-400'"></i>
                    </div>
                </div>

            </div>

            <!-- Buttons -->
            <div class="mt-6 flex items-center justify-between space-x-3">
                <button type="submit"
                    class="flex-1 bg-gradient-to-r from-blue-600 to-teal-600 text-white py-2 rounded-lg shadow-md hover:scale-105 transition-all font-semibold flex justify-center items-center gap-2">
                    <i class="fa-solid fa-save"></i> Update Profile
                </button>
                <button type="button" id="delete-photo-button"
                    class="w-1/3 bg-red-600 text-white py-2 rounded-lg shadow-md hover:bg-red-700 transition font-semibold flex justify-center items-center gap-2">
                    <i class="fa-solid fa-trash"></i> Delete
                </button>
            </div>
        </form>

        <!-- Dark/Light Mode Toggle -->
        <div class="flex justify-center mt-4">
            <button @click="darkMode = !darkMode" class="rounded-full">
                <i class="fa-solid" :class="{'fa-sun text-white bg-gray-800': darkMode, 'fa-moon text-gray-900 bg-white': !darkMode}"></i>
            </button>
        </div>
    </div>
</div>

<script>
    // Toggle Password Visibility
    document.getElementById('togglePassword').addEventListener('click', function() {
        toggleVisibility('password', this);
    });

    document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
        toggleVisibility('password_confirmation', this);
    });

    function toggleVisibility(inputId, icon) {
        const inputField = document.getElementById(inputId);
        if (inputField.type === 'password') {
            inputField.type = 'text';
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            inputField.type = 'password';
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    }

    // Preview Profile Picture
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function() {
            document.getElementById('profile-pic').src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }

    // Delete Profile Picture
    document.getElementById('delete-photo-button').addEventListener('click', function() {
        if (confirm('Are you sure you want to delete your profile picture?')) {
            const formData = new FormData();
            formData.append('_method', 'DELETE');
            formData.append('_token', '{{ csrf_token() }}');

            fetch('{{ route("profile.deletePhoto") }}', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('profile-pic').src = '{{ asset("assets/default.jpg") }}';
                        alert('Profile picture deleted successfully.');
                    } else {
                        alert('Error deleting profile picture.');
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    });
</script>
@endsection