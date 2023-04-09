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
        <form class="login-form hidden pt-6 pb-8 mb-4" method="POST" action="{{ route('user.update_image_service') }}" >
            @csrf
            @method('put')

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="esri_id">
                    {{ __('Snap your OOTD') }}
                </label>
                <div class="hidden" id="my_camera"></div>
                <br/>
                <input class="border border-black border-solid p-2 rounded w-full" type=button value="Snap your OOTD" onClick="take_snapshot()">
                <input type="hidden" name="image" class="image-tag">
                <input type="hidden" name="username" value="{{ $name }}">
            </div>
            <div class="flex flex-col">
                <div id="results" style="overflow:auto">Your captured image will appear here...</div>
            </div>


            <div class="flex items-center justify-center pt-16">
                <button class=" w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline disabled:bg-gray-400" type="submit" disabled>
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
    Webcam.set({
        width: 640,
        height: 480,
        image_format: 'jpeg',
        jpeg_quality: 90,

    });

    Webcam.attach( '#my_camera' );
    function take_snapshot() {
    Webcam.snap( function(data_uri) {
        $(".image-tag").val(data_uri);
        document.getElementById('results').innerHTML = '<img style="transform: rotate(270deg);" src="'+data_uri+'"/>';

        // Enable submit button when results are ready
        const submitButton = document.querySelector('button[type="submit"]');
        submitButton.addEventListener('click', () => {
            if (!Webcam.loaded) {
                alert('Please take a photo first!');
                return false;
            }
        });
        submitButton.disabled = false;
        submitButton.classList.remove('bg-gray-500');
        submitButton.classList.add('bg-blue-500');

         // Show "Retake your shot" button
        const takeSnapshotButton = document.querySelector('input[type="button"]');
        takeSnapshotButton.value = "Retake your shot";
    } );


}


</script>
@endsection
