@extends('vote.layouts.vote')

@section('vote-form')
<div class="text-center pb-10">
    <p class="font-bold text-2xl">Vote for best King attire </p>
</div>
<div class="grid grid-cols-2 gap-4 p-4">
    @foreach($candidate as $key => $value)
        <div class="bg-white w-36 h-56 mx-auto">

            <form id="vote-form" method="POST" action="{{ route('vote.process') }}">
                @csrf
                <input type="hidden" name="candidate_id" value="{{ $value->id }}">
                <input type="hidden" name="user_id" value="{{ $user_id}}">
                <button class=" w-full mx-auto p-2 text-blue-300 hover:text-blue-500 font-bold" type="button" onclick="confirmVote()">
                    <span>Vote Me</span>
                    <img src="{{ $value->img_path }}"/>
                </button>
            </form>
        </div>
    @endforeach
</div>
@endsection
