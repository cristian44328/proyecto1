<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class catController extends Controller
{
    //
    public function principal()
    {
        $cat = Categoria::withTrashed()->paginate(5);
        return view('categorias.principalcat', ['prod' => $cat]);
    }

    public function crear()
    {
        return view('categorias.crearcat');
    }

    public function mostrar($variable)
    {
        $producto = Categoria::find($variable);

        // return view('productos.mostrar', ['prod'=>$variable]);
        return view("categorias.mostrarcat", compact('producto'));
    }

    public function store(Request $request)
    {
        $pro=new Categoria();
        $pro->nombre=$request->nombre;

        // return $request->all();
        $pro->save();

        // return redirect()->route('producto.principal');
        return redirect()->route('cat.mostrar', $pro->id);

    }

    public function editar(Categoria $producto){
    
        return view("categorias.editarcat", compact('producto'));
    }

    public function update(Request $request, Categoria $producto){
        $producto=new Categoria();
        $producto->nombre=$request->nombre;

        $producto->save();
        return redirect()->route('cat.mostrar', $producto->id);
    }

    public function borrar($id){
        $producto=Categoria::withTrashed()->find($id);
        $producto->forceDelete();

        return redirect()->route('cat.principal');
    }

    public function desactivaproducto($id){
        $producto=Categoria::find($id);
        $producto->delete();

        return redirect()->route('cat.principal');
    }

    public function activaproducto($id){
        $producto=Categoria::withTrashed()->find($id);
        $producto->restore();

        return redirect()->route('cat.principal');
    }
}
