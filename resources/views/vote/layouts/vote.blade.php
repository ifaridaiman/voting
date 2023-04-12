@extends('layouts.app')

@section('content')
<div class="bg-gray-100 @if(count($candidate) > 2)h-full @else h-screen @endif">
    <div class="flex flex-col justify-top items-center bg-gray-100 p-8">
        <img src="/image/esri-logo-vote.svg" alt="Logo" class="">
    </div>
    @yield('vote-form')
</div>
<script>
    function confirmVote() {
       
        if(confirm("Are you sure you want to vote for this candidate?")) {
            // Submit the vote form
            document.getElementById("vote-form").submit();
        }
    }
</script>

@endsection
