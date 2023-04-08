@extends('layouts.app')

@section('content')
<div class="flex flex-col justify-center items-center h-screen bg-gray-100">
    <div class="mb-4">
        <img src="/image/esri-logo-vote.svg" alt="Logo" class="">
    </div>
    <div class="w-full max-w-md">
        <form class="px-8 pt-6 pb-8 mb-4" method="POST" action="{{ route('user.validation') }}" >
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="esri_id">
                    {{ __('ESRI ID') }}
                </label>
                <input class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="esri_id" name="esri_id" type="text" placeholder="ESM000">
                <p class="text-muted text-xs mt-4">Use the same user id that you use in iloginhr portal.</p>
                @error('esri_id')
                    <p class="text-red-500 mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-center pt-16">
                <button class=" w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Sign In
                </button>
            </div>

        </form>

    </div>
</div>

@endsection
