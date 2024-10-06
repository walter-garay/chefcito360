<?php

namespace App\Http\Controllers;

use App\Models\Proveedores;
use Illuminate\Http\Request;

class ProveedoresController extends Controller
{

    public function index()
    {
        //
        return view('proveedores.index');
    }

    /*
    public function store(Request $request)
    {
        //
    }

    public function show(Proveedores $proveedores)
    {
        //
    }

    public function edit(Proveedores $proveedores)
    {
        //
    }

   
    public function update(Request $request, Proveedores $proveedores)
    {
        //
    }

    /*
    public function destroy(Proveedores $proveedores)
    {
        //
    }*/
}
