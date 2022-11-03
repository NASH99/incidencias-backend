<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;

class AuthenticationController extends Controller
{
    public function login(Request $request){
        $user = Usuario::where('correo',$request->email)->where('clave',$request->password)->firstOrFail();
        return response()->json($user);
    }
}
