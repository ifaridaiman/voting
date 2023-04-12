@extends('layouts.app')

@section('header')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
@endsection

@section('content')
    <div class="flex flex-col justify-center items-center h-screen bg-gray-100 p-4">
        <div class="mb-4">
            <img src="/image/esri-logo-vote.svg" alt="Logo" class="">
        </div>
        <div class="w-full max-w-md">

            <div class="button-container flex flex-col gap-4 p-4">
                <p class="text-center">Are you {{ $name }}?</p>
                <button class="confirm-button w-full bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Confirm</button>
                <button class="cancel-button w-full bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Not Me</button>
            </div>

            <form class="login-form hidden pt-6 pb-8 mb-4" method="POST" action="{{ route('user.update_image_service') }}">
                @csrf
                @method('put')

                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2" for="esri_id">
                        {{ __('Snap your OOTD') }}
                    </label>

                    <div id="my_camera" class="mx-auto"></div>
                    <input type="file" id="file-input" class="hidden" accept="image/*">

                    <br />
                    <button id="take-snapshot-button" class="border border-black border-solid p-2 rounded w-full" type="button">Snap your OOTD</button>
                    <input type="hidden" name="image" class="image-tag">
                    <input type="hidden" name="username" value="{{ $name }}">
                    <input type="hidden" name="user_id" value="{{ $user_id }}">
                </div>

                <div class="flex flex-col">
                    <div id="results" style="overflow:auto">Your captured image will appear here...</div>
                </div>

                <div class="flex items-center justify-center pt-16">
                    <button class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline disabled:bg-gray-400" type="submit" disabled>
                        Submit your OOTD
                    </button>
                </div>
            </form>

        </div>
    </div>

    <script>
        // Get references to the buttons and the form
        const confirmButton = document.querySelector('.confirm-button');
        const cancelButton = document.querySelector('.cancel-button');
        const form = document.querySelector('.login-form');

        // Add a click event listener to the Confirm button
        confirmButton.addEventListener('click', () => {
            // Hide the buttons
            document.querySelector('.button-container').classList.add('hidden');
            // Show the form
            form.classList.remove('hidden');
        });

        // Add a click event listener to the Cancel button
        cancelButton.addEventListener('click', () => {
            // Redirect to the login page
            window.location.href = '/';
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script type="text/javascript">
        const fileInput = document.getElementById('file-input');
        const takeSnapshot     = document.getElementById('take-snapshot-button');
    const imageTag = document.querySelector('.image-tag');
    const resultsDiv = document.getElementById('results');
    const submitButton = document.querySelector('button[type="submit"]');

    // Check if device supports Webcam.js
    const isWebcamSupported = () => {
        return navigator.mediaDevices && navigator.mediaDevices.getUserMedia;
    };

    // If device supports Webcam.js, use it to take snapshot
    // if (isWebcamSupported()) {
    //     Webcam.set({
    //         width: 300,
    //         height: 150,
    //         image_format: 'jpeg',
    //         jpeg_quality: 90,
    //     });

    //     Webcam.attach('#my_camera');

    //     takeSnapshot.addEventListener('click', () => {
    //         Webcam.snap((data_uri) => {
    //             imageTag.value = data_uri;
    //             resultsDiv.innerHTML = '<img src="' + data_uri + '"/>';

    //             // Enable submit button when results are ready
    //             if (submitButton) {
    //                 submitButton.addEventListener('click', () => {
    //                     if (!Webcam.loaded) {
    //                         alert('Please take a photo first!');
    //                         return false;
    //                     }
    //                 });
    //                 submitButton.disabled = false;
    //                 submitButton.classList.remove('bg-gray-500');
    //                 submitButton.classList.add('bg-blue-500');
    //             }

    //             // Show "Retake your shot" button
    //             takeSnapshot.value = 'Retake your shot';
    //         });
    //     });
    // } else {
        // If device does not support Webcam.js, use input type file to take snapshot
        takeSnapshot.addEventListener('click', () => {
            fileInput.click();
        });

        fileInput.addEventListener('change', (event) => {
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = (event) => {
                const data_uri = event.target.result;
                imageTag.value = data_uri;
                resultsDiv.innerHTML = '<img src="' + data_uri + '"/>';

                // Enable submit button when results are ready
                if (submitButton) {
                    submitButton.addEventListener('click', () => {
                        if (!file) {
                            alert('Please select a photo first!');
                            return false;
                        }
                    });
                    submitButton.disabled = false;
                    submitButton.classList.remove('bg-gray-500');
                    submitButton.classList.add('bg-blue-500');
                }

                // Show "Retake your shot" button
                takeSnapshot.value = 'Retake your shot';
            };

            reader.readAsDataURL(file);
        });
    // }
</script>
@endsection
