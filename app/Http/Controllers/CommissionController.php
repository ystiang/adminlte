<?php

namespace App\Http\Controllers;

use App\Models\Commission;
use App\Models\Package;
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
        $month = Carbon::now()->format('F Y');
        
        $course_sale = Commission::where('user_id', $user->id)->where('category', 'Course')->whereMonth('date', Carbon::now()->month)->sum('price');
        $product_sale = Commission::where('user_id', $user->id)->where('category', 'Product')->whereMonth('date', Carbon::now()->month)->sum('price');
        $service_sale =  Commission::where('user_id', $user->id)->where('category', 'Service')->whereMonth('date', Carbon::now()->month)->sum('price');
        $course_comm = Commission::where('user_id', $user->id)->where('category', 'Course')->whereMonth('date', Carbon::now()->month)->sum('commission');
        $product_comm = Commission::where('user_id', $user->id)->where('category', 'Product')->whereMonth('date', Carbon::now()->month)->sum('commission');
        $service_comm =  Commission::where('user_id', $user->id)->where('category', 'Service')->whereMonth('date', Carbon::now()->month)->sum('commission');
        $total_sale = $course_sale+$product_sale+$service_sale;
        $total_comm = $course_comm+$product_comm+$service_comm;

        if ($user->role == 'admin' ) {
            $commissions = Commission::all();            
        } else {
            // Retrieve the data that belongs to the user
            $commissions = Commission::where('user_id', $user->id)->get();            
        }

        $treatments = Package::all();

        $data = [
            'commissions' => $commissions,
            'treatments' => $treatments,
            'month' => $month,
            'course_sale' => $course_sale,
            'product_sale' => $product_sale,
            'service_sale' => $service_sale,
            'course_comm' => $course_comm,
            'product_comm' => $product_comm,
            'service_comm' => $service_comm,
            'total_sale' => $total_sale,
            'total_comm' => $total_comm
        ];

        // Return the view and pass the data to it           
        return view('commission')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return $request;
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
        $treatment = Package::where('id', $request->treatment)->first();
        try {    
            $this->validate($request, [
                'customer_name' => 'required',
                'card' => 'required',
                'treatment' => 'required',
                'category' => 'required',                
            ]);  

            $course_sale = 0;
            $product_sale = 0;
            $service_sale = 0;
            $course_comm = 0;
            $product_comm = 0;
            $service_comm = 0;

            $price = $treatment->price;
            $rate = $treatment->commission_rate;

            if($treatment->method == 'Amount') {
                $comm = $treatment->commission_amount; 
            } elseif($treatment->method == 'Percentage') {
                $comm = $price * $rate;
            }

            if($request->category == 'Course') {
                $category = $request->category;
                $course_sale = $price;  
                $course_comm = $comm;              
            } elseif($request->category == 'Product') {
                $category = $request->category;                
                $product_sale = $price;      
                $product_comm = $comm;            
            } elseif($request->category == 'Service') {
                $category = $request->category;                
                $service_sale = $price;
                $service_comm = $comm;  
            } else {                
                
            }

            

            $total_sale = $course_sale + $product_sale + $service_sale;  
            $total_comm = $course_comm + $product_comm + $service_comm;            

            Commission::updateOrCreate(
            [            
                'id' => $request->id,
            ],
            [
                'date' => $current_datetime,
                'user_id' => $request->user_id,
                'user_name' => $request->user_name,
                'customer_name' => $request->customer_name,
                'card' => $request->card,
                'category' => $category,
                'treatment' => $treatment->treatment,         
                'price' => $treatment->price,
                'product' => $product_comm,
                'course' => $course_comm,
                'service' => $service_comm,                
                'commission' => $total_comm,            
            ]);           
            return redirect()->route('commission');
        } catch (Exception $e) {
            dd($e);
        }
        // return $treatment->price;
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
