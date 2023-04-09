@extends('vote.layouts.vote')

@section('vote-form')
<div class="text-center pb-10">
    <p class="font-bold text-2xl">Vote for best King attire </p>
</div>
<div class="grid grid-cols-2 gap-4 p-4">
    @foreach($candidate as $key => $value)
        <div class="bg-white w-36 h-44 mx-auto">
            <img src="{{ $value->img_path }}"/>
            <form id="vote-form" method="POST" action="{{ route('vote.process') }}">
                @csrf
                <input type="hidden" name="candidate_id" value="{{ $value->id }}">
                <input type="hidden" name="user_id" value="{{ $user_id}}">
                <button class=" " type="button" onclick="confirmVote()">Vote Me</button>
            </form>
        </div>
    @endforeach
</div>
@endsection
