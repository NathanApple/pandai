<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PointProductController extends Controller
{
    //
    public function index(){
        return view('product.index');
    }

    public function purchase(Request $request){
        $user = User::find(Auth::user()->id);

        $user->points = $user->points + $request->points;

        $user->update();

        return redirect(route('product'))->with('success','Transaction Succesfull');

    }
}
