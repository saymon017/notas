<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nota;

class NotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notas = Nota::paginate(8);
        return view('notas.index', compact('notas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('notas.crear');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required', 'descripcion' => 'required', 'imagen' => 'required|image|mimes:jpeg,png,svg|max:1024'
        ]);

         $nota = $request->all();

         if($imagen = $request->file('imagen')) {
            $rutaGuardarImg = 'storage/imagen/';
             $imagenNota = date('YmdHis'). "." . $imagen->getClientOriginalExtension();
             $imagen->move($rutaGuardarImg, $imagenNota);
             $nota['imagen'] = "$imagenNota";             
         }
         
         Nota::create($nota);
         return redirect()->route('notas.index');
    }
    


    /**
     * Display the specified resource.
     */
    public function show(Nota $nota)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Nota $nota)
    {
        return view('notas.editar', compact('nota'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Nota $nota)
    {
        $request->validate([
            'titulo' => 'required', 'descripcion' => 'required'
        ]);
         $not = $request->all();
         if($imagen = $request->file('imagen')){
            $rutaGuardarImg = 'storage/imagen/';
            $imagenNota = date('YmdHis') . "." . $imagen->getClientOriginalExtension(); 
            $imagen->move($rutaGuardarImg, $imagenNota);
            $not['imagen'] = "$imagenNota";
         }else{
            unset($not['imagen']);
         }
         $nota->update($not);
         return redirect()->route('notas.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Nota $nota)
    {
        $nota->delete();
        return redirect()->route('notas.index');
    }
}
