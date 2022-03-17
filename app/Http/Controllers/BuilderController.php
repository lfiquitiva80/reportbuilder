<?php

namespace App\Http\Controllers;

use App\Http\Requests\BuilderStoreRequest;
use App\Http\Requests\BuilderUpdateRequest;
use App\Models\Builder;
use App\Models\Dependence;
use Illuminate\Http\Request;

class BuilderController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $builders = Builder::all();
        $dependence = Dependence::pluck('NOMBRE', 'DEPEN');
        

        return view('builder.index', compact('builders','dependence'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

         $dependence = Dependence::pluck('NOMBRE', 'DEPEN');        
        return view('builder.create', compact('dependence'));
    }

    /**
     * @param \App\Http\Requests\BuilderStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(BuilderStoreRequest $request)
    {
        
        
        $builder = Builder::create($request->all());


        $request->session()->flash('builder.id', $builder->id);

        return redirect()->route('builder.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Builder $builder
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Builder $builder)
    {
        return view('builder.show', compact('builder'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Builder $builder
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Builder $builder)
    {
        return view('builder.edit', compact('builder'));
    }

    /**
     * @param \App\Http\Requests\BuilderUpdateRequest $request
     * @param \App\Models\Builder $builder
     * @return \Illuminate\Http\Response
     */
    public function update(BuilderUpdateRequest $request, Builder $builder)
    {
        $builder->update($request->validated());

        $request->session()->flash('builder.id', $builder->id);

        return redirect()->route('builder.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Builder $builder
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Builder $builder)
    {
        $builder->delete();

        return redirect()->route('builder.index');
    }
}
