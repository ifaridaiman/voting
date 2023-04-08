@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <div class="flex justify-center">
        <div class="w-full md:w-1/2 lg:w-1/3">
            <div class="bg-white rounded-lg shadow-lg p-8">
                <h2 class="text-2xl font-bold mb-8">{{ __('Upload File') }}</h2>
                <form method="POST" action="{{ route('ingest.ingest') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label for="csv_file" class="block text-gray-700 font-bold mb-2">{{ __('Choose a file to upload') }}</label>
                        <input type="file" class="form-input w-full @error('file') border-red-500 @enderror" id="csv_file" name="csv_file" required>

                        @error('file')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        {{ __('Upload') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
