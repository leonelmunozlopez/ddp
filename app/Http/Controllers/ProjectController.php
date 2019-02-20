<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Project;
use App\User;
use Auth;

class ProjectController extends Controller
{
    // store method with ajax requests
    public function store(ProjectRequest $request)
    {
        $project = new Project($request->all());

        if (Auth::check()) {
            $user = Auth::user();
        } else {
            // Create user if not exists
            $user = User::where('email', $data['email']);
            if (!$user) {
                if (!$user->create(['name' => $data['name'], 'email' => $data['email']])) {
                    return response()->json(['error' => 'Could not create the user'], 500);
                }
            }
        }

        $project->user_id = $user->id;
        if (!$project->save()) {
            return response()->json(['error' => 'Could not store Project'], 500);
        }

        return response()->json($project);
    }
}
