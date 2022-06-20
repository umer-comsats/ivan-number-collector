<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Item;
use App\Models\Number;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::all();

        return view('admin.companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:companies,name',
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $input['name'] = $request->name;
        $input['action_line'] = $request->action_line;
        $input['slug'] = Str::slug( $request->name);
        $items = $request->items;

        if ($image = $request->file('logo')) {
            $destinationPath = public_path('logo/');
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['logo_path'] = "$profileImage";
        }

        $company = Company::create($input);

        if (is_array($items) || is_object($items)){
            foreach ($items as $item) {
                Item::create([
                    'company_id' => $company->id,
                    'name' => $item
                ]);
            }
        }
        

        return redirect()->route('admin.companies.index')->with('message', 'Company created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $company = Company::where('slug', $slug)->first();

        return view('admin.companies.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view('admin.companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        $request->validate([
            'name' => 'required',
            'logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $input['name'] = $request->name;
        $input['action_line'] = $request->action_line;
        $input['slug'] = Str::slug( $request->name);
        $items = $request->items;

        if ($image = $request->file('logo')) {
            unlink(public_path("logo/$company->logo_path"));
            $destinationPath = public_path('logo/');
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['logo_path'] = "$profileImage";
        }

        $company->update($input);

        $company->items()->delete();

        if (is_array($items) || is_object($items)){
            foreach ($items as $item) {
                if(!empty($item)) {
                    Item::create([
                        'company_id' => $company->id,
                        'name' => $item
                    ]);
                }
            }
        }

        return redirect()->route('admin.companies.index')->with('message', 'Company updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        if ($company->logo_path && File::exists(public_path("logo/$company->logo_path"))) {
            unlink(public_path("logo/$company->logo_path"));
        }

        Number::where('company_id', $company->id)->delete();
        $company->delete();

        return redirect()->route('admin.companies.index')->with('message', 'Company deleted.');
    }
}
