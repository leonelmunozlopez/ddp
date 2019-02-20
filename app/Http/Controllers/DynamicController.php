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
        $dynamics = Dynamic::orderBy('ends_at', 'DESC')->paginate();
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

        if ($dynamic->save()) {
            return redirect()->route('storeDynamic')->with('success', 'Dinámica creada correctamente');
        }

        return redirect()->route('storeDynamic')->with('error', 'Ha ocurrido un error');
    }

    public function show($code)
    {
        $dynamic = Dynamic::where('code', $code)->firstOrFail();
        return view('dynamics.show', ['dynamic' => $dynamic]);
    }
}
