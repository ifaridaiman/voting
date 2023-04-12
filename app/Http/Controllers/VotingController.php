<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class VotingController extends Controller
{

    private function checkUser($user_id)
    {
        $user = User::where('id', $user_id)->firstOrFail();
        if ($user->voting_number > 2) {
            return redirect()->route('user.login');
        }else{
            return $user->id;
        }
    }

    public function vote_male($user_id)
    {
        $voter = $this->checkUser($user_id);
        $userAttend = User::where('attendance', 1)->where('category', 'king')->whereNotIn('id', [$user_id])->get();
        return view('vote.male', ['candidate' => $userAttend, 'user_id' => $voter]);
    }

    public function vote_female($user_id)
    {
        $voter = $this->checkUser($user_id);
        $userAttend = User::where('attendance', 1)->where('category', 'queen')->whereNotIn('id', [$user_id])->get();
        return view('vote.female', ['candidate' => $userAttend, 'user_id' => $voter]);
    }

    public function vote_process(Request $request)
    {
        $voter = User::where('id', $request->user_id)->firstOrFail();
        $voter->voting_number = $voter->voting_number + 1;
        $voter->save();

        $user = User::where('id', $request->candidate_id)->first();
        $user->vote_count = $user->vote_count + 1;
        $user->save();

        if ($user->category == 'king') {
            return redirect()->route('vote.female', $voter);
        } elseif ($user->category == 'queen') {
            return redirect()->route('vote.thanks');
        }
    }

    public function thankyou()
    {
        return view('vote.thankyou');
    }
}
