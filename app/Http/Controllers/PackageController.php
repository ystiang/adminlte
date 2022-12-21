<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Exception;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packages = Package::all();
        return view('package', ['packages' => $packages]);
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
        try {
            // Validate the form input
            $this->validate($request, [
                'package' => 'required',
                'treatment' => 'required',
                'method' => 'required',
                'price' => 'required',
            ]);    
            Package::updateOrCreate(
            [            
                'id' => $request->id,
            ],
            [
                'package' => $request->package,
                'treatment' => $request->treatment,
                'method' => $request->method,
                'price' => $request->price,     
                'commission_rate' => $request->commission_rate,
                'commission_amount' => $request->commission_amount,       
            ]);           
            return redirect()->route('package');
        } catch (Exception $e) {
            dd($e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function show(Package $package)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $package = Package::findorFail($id);
        return response()->json($package);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Find the data
        $package = Package::findorFail($id);

        // Show the data

        // Update the data
        $package->package = $request->package;
        $package->treatment = $request->treatment;
        $package->method = $request->method;
        $package->price = $request->price;
        // $package->commission_rate = $request->commission_rate;
        // $package->commission_amount = $request->commission_amount;
        $package->save();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $package=Package::findOrFail($id);

        if(is_null($package)) {
            return abort(404);
        }

        $package->delete();

        return back();
    }
}
