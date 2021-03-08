<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AGT_User;
Use Alert;
use Auth;

class AGTController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    Public function index(){
        $data['agt_user'] = AGT_User::orderBy('id','desc')->get();
        return view('home',$data);
    }
    Public function store(Request $request){
        $request->validate([
            'name'      => 'required',
            'email'     => 'required|email',
            'pincode'   => 'digits:6',
            'image'     => 'required'
        ]);
        $email = $request->email;

        if(!AGT_User::where('email',$email)->exists()){
            $filename = time() . "." . $request->image->extension();
            $request->image->move(public_path("image"),$filename);

            $user = new AGT_User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->pincode = $request->pincode;
            $user->image = $filename;
            $user->save();
            toast('User Successfully Added!','success');
        }else{
            toast('E-mail Already exists.','error');
        }
        return redirect()->back();

    }

    public function drop($id){
        AGT_User::where('id',$id)->delete();
        toast('Record Successfully Deleted!','success');
        return redirect()->back();
    }
    public function edit(Request $request, $id){
        $request->validate([
            'name'      => 'required',
            'email'     => 'required|email',
            'pincode'   => 'digits:6'
        ]);

        AGT_User::where('id',$id)->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'pincode'=>$request->pincode
        ]);

        toast('Record Successfully Updated!','success');
        return redirect()->back();

    }

}
