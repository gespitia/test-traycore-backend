<?php

namespace App\Http\Controllers;


use App\Http\Requests\Persona\ActualizarRequest as ActualizarPersonaRequest;
use App\Http\Requests\Persona\CrearRequest as CrearPersonaRequest;
use App\Http\Requests\Search\TerminoRequest;
use App\Persona;
use App\Planeta;
use Illuminate\Http\Request;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $personas = Persona::orderBy('contador','desc')->orderBy('updated_at','desc')->get();

            return response()->json([
                'success' => true,
                'data' => $personas
            ], 200);

        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'data' => $exception], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CrearPersonaRequest $request)
    {
        try {

            $persona = Persona::create([
                "nombres" => $request->nombres,
                "apellidos" => $request->apellidos,
                "n_idententidad" => $request->n_idententidad,
                "edad" => $request->edad,
                "peso" => $request->peso,
                "altura" => $request->altura,
                "genero" => $request->genero,
                "fecha_nacimiento" => $request->fecha_nacimiento,
                "planeta_id" => $request->planeta_id
            ]);

            return response()->json([
                'success' => true,
                'data' => "La persona fue creada correctamente."
            ], 201);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'data' => $exception], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Persona $persona
     * @return \Illuminate\Http\Response
     */
    public function show($persona)
    {
        try {
            $persona = Persona::with('planeta')->findOrFail($persona);

            $persona->update(["contador" => $persona->contador + 1]);

            $planeta = Planeta::find($persona->planeta_id);

            $planeta->update(["contador" => $planeta->contador + 1]);
            return response()->json([
                'success' => true,
                'data' => $persona
            ], 200);

        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'data' => $exception], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Persona $persona
     * @return \Illuminate\Http\Response
     */
    public function update(ActualizarPersonaRequest $request, Persona $persona)
    {
        try {
            $persona->update(
                $request->all()
            );

            return response()->json([
                'success' => true,
                'data' => $persona
            ], 200);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'data' => $exception], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Persona $persona
     * @return \Illuminate\Http\Response
     */
    public function destroy(Persona $persona)
    {
        try {
            $persona->delete();
            return response()->json([
                'success' => true,
                'data' => "La persona fue eliminada correctamente."
            ], 200);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'data' => $exception], 500);
        }

    }

    public function search(TerminoRequest $request)
    {
        try {

            $personas = Persona::orWhere('nombres','like' ,'%'.$request->termino.'%')->orWhere('apellidos','like' ,'%'.$request->termino.'%')->orWhere('n_idententidad','like','%'.$request->termino.'%')->get();

            return response()->json([
                'success' => true,
                'data' => $personas
            ], 200);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'data' => $exception], 500);
        }
    }

    public function checkId(Request $request)
    {
        try {
            $personas = Persona::where('id','<>' ,$request->id)->where('n_idententidad', $request->n_idententidad)->get();
            return response()->json([
                'success' => true,
                'data' => ["disponible"=> count($personas) == 0]
            ], 200);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'data' => $exception], 500);
        }
    }

}
