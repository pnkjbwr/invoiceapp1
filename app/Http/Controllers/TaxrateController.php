<?php

namespace App\Http\Controllers;

use App\Taxrate;
use Illuminate\Http\Request;

class TaxrateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $taxrates = Taxrate::all();
        return view('admin.taxrates.index', compact('taxrates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $taxrate = $request->except('_token');
        Taxrate::forceCreate($taxrate);
        return redirect()->route('taxrates.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Taxrate  $taxrate
     * @return \Illuminate\Http\Response
     */
    public function show(Taxrate $taxrate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Taxrate  $taxrate
     * @return \Illuminate\Http\Response
     */
    public function edit(Taxrate $taxrate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Taxrate  $taxrate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Taxrate $taxrate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Taxrate  $taxrate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Taxrate $taxrate)
    {
        //
    }
}
