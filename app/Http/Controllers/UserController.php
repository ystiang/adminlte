<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('user', ['users' => $users]);
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
            $user = User::updateOrCreate(
            [            
                'id' => $request->id,
            ],
            [
                'role' => $request->role,          
            ]);   
            if ($request->role == 'admin') {
                $user->assignRole('admin');
            } else {
                $user->assignRole('user');
            }
                    
            return redirect()->route('package');
        } catch (Exception $e) {
            dd($e);
        }
    }

    
    public function edit($id)
    {
        $user = User::findorFail($id);
        return response()->json($user);
    }   

    
    public function destroy($id)
    {
        $user=User::findOrFail($id);

        if(is_null($user)) {
            return abort(404);
        }

        $user->delete();

        return back();
    }
}
