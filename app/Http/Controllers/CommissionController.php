<?php

namespace App\Http\Controllers;

use App\Models\Commission;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Retrieve the authenticated user
        $user = Auth::user();
        
        if ($user->role == 'admin' ) {
            $commissions = Commission::all();
        } else {
            // Retrieve the data that belongs to the user
            $commissions = Commission::where('user_id', $user->id)->get();
        }

        // Return the view and pass the data to it           
        return view('commission', ['commissions' => $commissions]);
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
        $user_id = Auth::id();
        $user_name = Auth::user()->name;
        $current_datetime = Carbon::now();
        try {    
            $this->validate($request, [
                'card' => 'required',
                'treatment' => 'required',
                'productcourse' => 'required',
                'product' => 'required',
                'course' => 'required',
                'service' => 'required',
                'commission' => 'required',
            ]);  
            Commission::updateOrCreate(
            [            
                'id' => $request->id,
            ],
            [
                'date' => $current_datetime,
                'user_id' => $user_id,
                'user_name' => $user_name,
                'card' => $request->card,
                'treatment' => $request->treatment,
                'productcourse' => $request->productcourse,
                'product' => $request->product,
                'course' => $request->course,
                'service' => $request->service,                
                'commission' => $request->commission,            
            ]);           
            return redirect()->route('commission');
        } catch (Exception $e) {
            dd($e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Commission  $commission
     * @return \Illuminate\Http\Response
     */
    public function show(Commission $commission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Commission  $commission
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $commission = Commission::findorFail($id);
        return response()->json($commission);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Commission  $commission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Commission $commission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Commission  $commission
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $commission=Commission::findOrFail($id);

        if(is_null($commission)) {
            return abort(404);
        }

        $commission->delete();

        return back();
    
    }
}
