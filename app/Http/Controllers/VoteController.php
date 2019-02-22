<?php

namespace App\Http\Controllers;

use App\Http\Requests\VoteRequest;
use App\User;
use App\Vote;
use Auth;

class VoteController extends Controller
{
    public function store(VoteRequest $request)
    {
        $vote = new Vote($request->all());

        if (Auth::check()) {
            $user = Auth::user();
        } else {
            // Create user if not exists
            $user = User::where('email', $request->email)->first();
            if (!$user) {
                $user = new User(['email' => $request->email]);
                if (!$user->save()) {
                    return response()->json(['error' => 'Could not create the user'], 500);
                }
            }
        }

        // FULL DATA STORAGE
        // Prepare preferences to store in JSON format
        // $array = [];
        // foreach ($request->preferences as $project_id) {
        //     $array[] = Project::where('id', $project_id)
        //         ->first(['id', 'title', 'dynamic_id', 'created_at', 'updated_at']);
        // }

        $vote->preferences = json_encode($request->preferences, JSON_NUMERIC_CHECK);
        $vote->dynamic_id  = $request->dynamic_id;
        $vote->user_id     = $user->id;

        // Check if this user already sent their preferences
        if (Vote::where('user_id', $user->id)->where('dynamic_id', $request->dynamic_id)->exists()) {
            return response()->json(['error' => 'Vote already made'], 409);
        }

        if (!$vote->save()) {
            return response()->json(['error' => 'Could not store yout vote preferences'], 500);
        }

        return response()->json($vote);
    }
}
