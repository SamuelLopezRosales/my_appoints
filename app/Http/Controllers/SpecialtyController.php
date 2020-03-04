<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Specialty;

class SpecialtyController extends Controller
{

	// middleware para inciiar sesion
	public function __construct(){
		$this->middleware('auth');
	}

    public function index(){
        $specialties = Specialty::all(); // este metodo obtiene todos los datos
    	return view('specialties.index', compact('specialties'));
    }

    public function create(){
    	return view('specialties.create');
    }

    public function performValidation(Request $request){
          $rules = [
            'name'=> 'required|min:3'
        ];
        $messages = [
            'name.required'=>'Es necesario ingresar un nombre',
            'name.min'=>'Como minimo el nombre debe tener 3 caracteres'
        ];

        $this->validate($request, $rules, $messages);
    }

    public function store(Request $request){

        $this->performValidation($request);// si es verdadero retorna a la vista anterior
        // y muestra unos mensajes de error
        $specialty = new Specialty();
        $specialty->name = $request->input('name');
        $specialty->description = $request->input('description');
        $specialty->save(); // INSERT

        $notificacion = 'La especialidad se ha creado correctamente';

        return redirect('specialties')->with(compact('notificacion'));
    }

    public function edit(Specialty $specialty){
        return view('specialties.edit', compact('specialty'));
    }

    public function update(Request $request, Specialty $specialty){

        $this->performValidation($request); // si es verdadero retorna a la vista anterior
        // y muestra unos mensajes de error
        $specialty->name = $request->input('name');
        $specialty->description = $request->input('description');
        $specialty->save(); // UPDATE
        $notificacion = 'La especialidad se ha modificado correctamente.';
        return redirect('specialties')->with(compact('notificacion'));
    }

    public function destroy(Specialty $specialty){
        $deleteSpecialty = $specialty->name;
        $specialty->delete(); // se elimina la especialidad
        $notificacion = 'La especialidad '. $deleteSpecialty .' se ha eliminado correctamnete';
         return redirect('specialties')->with(compact('notificacion'));
    }
}
