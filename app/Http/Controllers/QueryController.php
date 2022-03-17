<?php

namespace App\Http\Controllers;

use App\Http\Requests\QueryStoreRequest;
use App\Http\Requests\QueryUpdateRequest;
use App\Models\Query;
use App\Models\Builder;
use Illuminate\Http\Request;
use App\Exports\QueriesExport;
use App\Exports\ConsultaExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Jobs\ProcessQuery;
use App\Jobs\ConsultaPersonalizada;

class QueryController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        
        $queries = Query::Search($request->nombre)->where('schema_id',1)->OrderBy('name','ASC')->get();

      
        return view('query.index', compact('queries'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('query.create');
    }

    /**
     * @param \App\Http\Requests\QueryStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(QueryStoreRequest $request)
    {
        $query = Query::create($request->validated());

        $request->session()->flash('query.id', $query->id);

        return redirect()->route('query.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\query $query
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Query $query)
    {
        return view('query.show', compact('query'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\query $query
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Query $query)
    {
        return view('query.edit', compact('query'));
    }

    /**
     * @param \App\Http\Requests\QueryUpdateRequest $request
     * @param \App\query $query
     * @return \Illuminate\Http\Response
     */
    public function update(QueryUpdateRequest $request, Query $query)
    {
        $query->update($request->validated());

        $request->session()->flash('query.id', $query->id);

        return redirect()->route('query.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\query $query
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Query $query)
    {
        $query->delete();

        return redirect()->route('query.index');
    }

    public function export(Request $request) 
    {
       
        $file = $request->vista . '.csv';
        (new QueriesExport($request->vista))->queue($file);

        return back()->with('status', 'Se realizó con éxito la descarga!');
        
        //ProcessQuery::dispatch($request->vista)->onQueue('exports');
        //(new QueriesExport($request->vista))->queue('invoices.xlsx')->onQueue('exports');
        // (new QueriesExport($request->vista))->store('invoices.csv');
        //return (new QueriesExport($request->vista))->queue('invoices.xlsx')->onQueue('exports');
        //return back()->with('status', 'Se realizó con éxito la descarga!');
        //return new QueriesExport($request->vista);

    }


   public function consulta($id)
    {
        $consulta = Builder::find($id);

        $file = 'Consulta'. '.csv';
        //\Excel::store(new ConsultaExport($consulta->Consulta), 'consulta.xlsx');

        ConsultaPersonalizada::dispatch($consulta->Consulta,$consulta->Columnas)->onQueue('exports');

        

        return back()->with('status', 'Se realizó con éxito la descarga!'); 

    }
}
