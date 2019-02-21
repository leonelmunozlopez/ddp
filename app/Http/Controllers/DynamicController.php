<?php

namespace App\Http\Controllers;

use App\Dynamic;
use App\Http\Requests\DynamicRequest;
use Illuminate\Support\Str;

class DynamicController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'show']);
    }

    public function index()
    {
        $dynamics = Dynamic::orderBy('ends_at', 'ASC')->paginate();
        return view('dashboard', ['dynamics' => $dynamics]);
    }

    public function create()
    {
        return view('dynamics.create');
    }

    public function store(DynamicRequest $request)
    {
        $dynamic = new Dynamic($request->all());

        do {
            $code          = Str::random(8);
            $dynamic->code = $code;
        } while (Dynamic::where('code', $code)->exists());

        if (!$dynamic->save()) {
            return redirect()->route('dashboard')->with('error', 'Ha ocurrido un error');
        }

        return redirect()->route('dashboard')->with('success', 'Dinámica creada correctamente');
    }

    public function show($code)
    {
        $dynamic = Dynamic::where('code', $code)->firstOrFail();
        return view('dynamics.show', ['dynamic' => $dynamic]);
    }

    public function edit($code)
    {
        $dynamic = Dynamic::where('code', $code)->firstOrFail();
        return view('dynamics.edit', ['dynamic' => $dynamic]);
    }

    public function update(DynamicRequest $request, $id)
    {
        $dynamic = Dynamic::findOrFail($id);

        if (!$dynamic->update($request->all())) {
            return redirect()->route('updateDynamic')->with('error', 'Ha ocurrido un error');
        }

        return redirect()->route('showDynamic', ['code' => $dynamic->code])->with('success', 'Dinámica editada correctamente');
    }

}
