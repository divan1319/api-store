<?php

namespace App\Http\Controllers;

use App\Models\Dato;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Ramsey\Uuid\v8;

class PerfilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //llamando a tabla datos para ver si tiene informacion de cada usuario
        $user = User::select('id','name','email','username','estado_dato','rol')->where('id',$id)->get();
        $userFind=User::find($id);
        $profile = $userFind->profile;
        return [
            'user'=>$user,
            'profile'=>$profile
        ];

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
