<?php

namespace App\Http\Controllers;

use App\Http\Requests\DependenceStoreRequest;
use App\Http\Requests\DependenceUpdateRequest;
use App\Models\Dependence;
use Illuminate\Http\Request;

class DependenceController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $dependences = Dependence::all();

        return view('dependence.index', compact('dependences'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('dependence.create');
    }

    /**
     * @param \App\Http\Requests\DependenceStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(DependenceStoreRequest $request)
    {
        $dependence = Dependence::create($request->validated());

        $request->session()->flash('dependence.id', $dependence->id);

        return redirect()->route('dependence.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Dependence $dependence
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Dependence $dependence)
    {
        return view('dependence.show', compact('dependence'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Dependence $dependence
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Dependence $dependence)
    {
        return view('dependence.edit', compact('dependence'));
    }

    /**
     * @param \App\Http\Requests\DependenceUpdateRequest $request
     * @param \App\Models\Dependence $dependence
     * @return \Illuminate\Http\Response
     */
    public function update(DependenceUpdateRequest $request, Dependence $dependence)
    {
        $dependence->update($request->validated());

        $request->session()->flash('dependence.id', $dependence->id);

        return redirect()->route('dependence.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Dependence $dependence
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Dependence $dependence)
    {
        $dependence->delete();

        return redirect()->route('dependence.index');
    }
}
