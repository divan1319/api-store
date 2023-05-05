<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use App\Models\Municipio;
use App\Models\Ocupation;
use Illuminate\Http\Request;

class ResidenciaController extends Controller
{
    public function getDepartamentos(){
        $dep = Departamento::all();
        $occp= Ocupation::all();
        return [
            'departamentos' => $dep,
            'ocupaciones' => $occp
        ];
    }

    public function getMunicipio($id){
        $mun = Municipio::all()->where('departamento_id',$id);
        return [
            'municipios' => $mun
        ];
    }
}
