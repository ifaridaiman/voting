@extends('vote.layouts.vote')

@section('vote-form')
<div class="text-center pb-10">
    <p class="font-bold text-2xl">Vote for best Queen attire </p>
</div>
@if($candidate->isEmpty())
    <p class="text-center">There are no candidates to vote for.</p>
    <div class="text-center mt-4">
        <a href="{{ route('user.login') }}" class="text-blue-500 hover:text-blue-700">Go back to login page</a>
    </div>
@else
    <div class="grid grid-cols-2 gap-4 p-4">
        @foreach($candidate as $key => $value)
            <div class="bg-white w-36 h-56 mx-auto overflow-hidden">

                <form id="vote-form" method="POST" action="{{ route('vote.process') }}">
                    @csrf
                    <input type="hidden" name="candidate_id" value="{{ $value->id }}">
                    <input type="hidden" name="user_id" value="{{ $user_id}}">
                    <button class="w-full mx-auto p-2 text-blue-300 hover:text-blue-500 font-bold relative" type="button" onclick="confirmVote()">
                        <span>Vote Me</span>
                        <img class="w-full h-full object-fit-contain" src="{{ $value->img_path }}"/>
                    </button>
                </form>
            </div>
        @endforeach
    </div>
@endif
@endsection
