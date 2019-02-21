<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Project;
use App\User;
use Auth;

class ProjectController extends Controller
{
    // store method with ajax requests
    public function store(ProjectRequest $request, $dynamic_id = false)
    {
        $project = new Project($request->all());

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

        $project->dynamic_id = $request->dynamic_id;
        $project->user_id    = $user->id;

        if (!$project->save()) {
            return response()->json(['error' => 'Could not store Project'], 500);
        }

        return response()->json($project);
    }
}
