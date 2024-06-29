<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class rolController extends Controller
{
    //
    public function principal()
    {
        $rol = Role::withTrashed()->paginate(5);
        return view('roles.principal', ['prod' => $rol]);
    }

    public function crear()
    {
        return view('roles.crearrol');
    }

    public function mostrar($variable)
    {
        $producto = Role::find($variable);

        // return view('productos.mostrar', ['prod'=>$variable]);
        return view("roles.mostrarrol", compact('producto'));
    }

    public function store(Request $request)
    {
        $pro=new Role();
        $pro->nombre=$request->nombre;

        // return $request->all();
        $pro->save();

        // return redirect()->route('producto.principal');
        return redirect()->route('rol.mostrar', $pro->id);

    }

    public function editar(Role $producto){
    
        return view("roles.editarrol", compact('producto'));
    }

    public function update(Request $request, Role $producto){
        $producto=new Role();
        $producto->nombre=$request->nombre;

        $producto->save();
        return redirect()->route('rol.mostrar', $producto->id);
    }

    public function borrar($id){
        $producto=Role::withTrashed()->find($id);
        $producto->forceDelete();

        return redirect()->route('rol.principal');
    }

    public function desactivaproducto($id){
        $producto=Role::find($id);
        $producto->delete();

        return redirect()->route('rol.principal');
    }

    public function activaproducto($id){
        $producto=Role::withTrashed()->find($id);
        $producto->restore();

        return redirect()->route('rol.principal');
    }

}
