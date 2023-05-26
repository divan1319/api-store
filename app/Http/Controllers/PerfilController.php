<?php

namespace App\Http\Controllers;

use App\Http\Requests\GuardarDatosRequest;
use App\Http\Requests\PassRequest;
use App\Http\Requests\UserRequest;
use App\Models\Dato;
use App\Models\Departamento;
use App\Models\Municipio;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Expr\Cast\String_;

use function Ramsey\Uuid\v8;

class PerfilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dep = Departamento::all();
        $mun = Municipio::all();

        return [
            'departamentos' => $dep,
            'municipios' => $mun
        ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GuardarDatosRequest $request)
    {
        $data = $request->validated();

        $imagen = $request->file('imagen')->store('public/images');
        $nombreImagen = str_replace('public/images/', '', $imagen);

        $profile = Profile::create([
            'user_id' => $data['user_id'],
            'dui' => $data['dui'],
            'telefono' => $data['telefono'],
            'municipio_id' => $data['municipio_id'],
            'ocupation_id' => $data['ocupation_id'],
            'descripcion' => $data['descripcion'],
            'imagen' => $nombreImagen
        ]);

        return [
            'profile' => $profile
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //Mostrando perfil del usuario
        $estado = User::select('estado_dato')->where('id', $id)->get();
        $profile = Profile::with('user', 'municipio', 'ocupation')->where('user_id', $id)->get();

        return [
            'profile' => $profile,
            'estado' => $estado
        ];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(string $parametro, Request $request)
    {
        $datosReturn = null;

        if ($parametro === 'user') {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email',
                'username' => 'required',
            ]);
            if ($validator->fails()) {
                $datosReturn = ['error' => 'No puedes dejar ningun campo vacio'];
            } else {
                $usuario = User::find($request->id);
                $usuario->fill($request->only(['name', 'email', 'username']));
                $usuario->save();
                $datosReturn = ['user' => $usuario];
            }
            
        } else if ($parametro === 'security') {

            $userPass = User::find($request->id);

            if (password_verify($request->actual_pass, $userPass->password)) {
                if ($request->password == $request->actual_pass) {
                    $datosReturn = ['error' => 'No puedes poner la misma password'];
                } else {
                    $userPass->password = bcrypt($request->password);
                    $userPass->save();
                    $datosReturn = ['user' => 'Password actualizada correctamente'];
                }
            } else {
                $datosReturn = ['error' => 'Tienes que escribir tu password actual para confirmar el cambio de contrasena'];
            }
        }

        return $datosReturn;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
