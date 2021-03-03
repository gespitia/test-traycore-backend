<?php

namespace App\Http\Controllers;

use App\Http\Requests\Planeta\ActualizarRequest;
use App\Http\Requests\Planeta\CrearRequest;
use App\Http\Requests\Search\TerminoRequest;
use App\Planeta;
use Illuminate\Http\Request;

class PlanetaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $planetas = Planeta::orderBy('contador', 'desc')->orderBy('updated_at','desc')->get();
            return response()->json([
                'success' => true,
                'data' => $planetas
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
    public function store(CrearRequest $request)
    {
        try {

            Planeta::create([
                "nombre" => $request->nombre,
                "periodo_rotacion" => $request->periodo_rotacion,
                "diametro" => $request->diametro,
                "clima" => $request->clima,
                "terreno" => $request->terreno,
                "masa" => $request->masa,
                "radio_orbital" => $request->radio_orbital
            ]);

            return response()->json([
                'success' => true,
                'data' => "El planeta fue creada correctamente."
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
     * @param  \App\Planeta $planeta
     * @return \Illuminate\Http\Response
     */
    public function show($planeta)
    {
        try {

            $planeta = Planeta::with('personas')->find($planeta);

            $planeta->update(["contador" => $planeta->contador + 1]);

            return response()->json([
                'success' => true,
                'data' => $planeta
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
     * @param  \App\Planeta $planeta
     * @return \Illuminate\Http\Response
     */
    public function update(ActualizarRequest $request, Planeta $planeta)
    {
        try {
            $planeta->update(
               $request->all()
            );
            return response()->json([
                'success' => true,
                'data' => $planeta
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
     * @param  \App\Planeta $planeta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Planeta $planeta)
    {
        try {

            $planeta->delete();

            return response()->json([
                'success' => true,
                'data' => "El planeta fue eliminada correctamente."
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
            $planetas = Planeta::where('nombre','like' ,'%'.$request->termino.'%')->get();
            return response()->json([
                'success' => true,
                'data' => $planetas
            ], 200);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'data' => $exception], 500);
        }
    }

}
