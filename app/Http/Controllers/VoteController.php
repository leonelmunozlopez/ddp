<?php

namespace App\Http\Controllers;

use App\Http\Requests\VoteRequest;

class VoteController extends Controller
{
    public function store(VoteRequest $request)
    {
        dd($request->all());
    }
}
