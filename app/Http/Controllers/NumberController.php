<?php

namespace App\Http\Controllers;

use App\Models\Number;
use App\Models\NumberItem;
use Illuminate\Http\Request;

class NumberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->query('company')) {
            $numbers = Number::where('company_id', $request->query('company'))->get();
        }else{
            $numbers = Number::all();
        }

        return view('admin.numbers.index', compact('numbers'));
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
        $data = $request->validate([
            'company_id' => 'required',
            'phone_number' => 'required'
        ]);

        $number = Number::create($data);

        //check if items
        if($number->company->items->count() > 0){
            return view('admin.items.show', ['number_id' => $number->id, 'company' => $number->company]);
        }else{
            return redirect()->back()->with(['message' => 'Number added']);
        }
    }

    public function store_item(Request $request)
    {
        $request->validate([
            'number_id' => 'required'
        ]);

        $items = $request->items;
        
        if(is_array($items)) {
            NumberItem::create([
                'number_id' => $request->number_id,
                'items' => implode(", ", $items)
            ]);
        }

        return redirect()->action([CompanyController::class, 'show'], [Number::find($request->number_id)->company->slug])->with(['message' => 'Number added']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Number  $number
     * @return \Illuminate\Http\Response
     */
    public function show(Number $number)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Number  $number
     * @return \Illuminate\Http\Response
     */
    public function edit(Number $number)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Number  $number
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Number $number)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Number  $number
     * @return \Illuminate\Http\Response
     */
    public function destroy(Number $number)
    {
        $number->delete();

        return redirect()->route('admin.numbers.index')->with('message', 'Number deleted.');
    }
}
