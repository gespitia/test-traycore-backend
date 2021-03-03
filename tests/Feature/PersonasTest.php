<?php

namespace Tests\Feature;

use App\Persona;
use App\Planeta;
use Tests\TestCase;

class PersonasTest extends TestCase
{

    /** @test */
    function test_personas_index()
    {
        $this->json('get', 'api/personas')
            ->assertStatus(200)
            ->assertJsonFragment(
                ['success' => true]
            );
    }

    /** @test */
    function test_personas_show()
    {
        $planeta = factory(Planeta::class)->create(
            [
                "nombre" => "Tierra",
                "periodo_rotacion" => 3233,
                "diametro" => 232323,
                "clima" => 3,
                "terreno" => "ewwee",
                "masa" => 232,
                "radio_orbital" => 23232
            ]
        );
        $persona = factory(Persona::class)->create(
            [
                "nombres" => "yaneth",
                "apellidos" => "florez",
                "n_idententidad" => random_int(224343, 33435654),
                "edad" => 30,
                "peso" => 50,
                "altura" => 203,
                "genero" => 3222,
                "fecha_nacimiento" => "2019-19-10",
                "planeta_id" => $planeta->id
            ]
        );

        $this->getJson('api/personas/' . $persona->id)
            ->assertStatus(200)
            ->assertJsonFragment(
                ['success' => true]
            );

    }

    /** @test */
    function test_personas_store()
    {
        $planeta = factory(Planeta::class)->create(
            [
                "nombre" => "Tierra",
                "periodo_rotacion" => 3233,
                "diametro" => 232323,
                "clima" => "Frio",
                "terreno" => "ewwee",
                "masa" => 232,
                "radio_orbital" => 23232
            ]
        );
        $this->postJson('api/personas', [
            "nombres" => "victor barrera",
            "apellidos" => "barrera florez",
            "n_idententidad" => random_int(224343, 33435654),
            "edad" => 20,
            "peso" => 50,
            "altura" => 203,
            "genero" => "M",
            "fecha_nacimiento" => "2019-10-19",
            "planeta_id" => $planeta->id
        ])
            ->assertStatus(201)
            ->assertJsonFragment(
                ['success' => true]
            );
    }

    /** @test */
    function test_personas_update()
    {
        $planeta = factory(Planeta::class)->create(
            [
                "nombre" => "Tierra",
                "periodo_rotacion" => 3233,
                "diametro" => 232323,
                "clima" => "frio",
                "terreno" => "ewwee",
                "masa" => 232,
                "radio_orbital" => 23232
            ]
        );
        $persona = factory(Persona::class)->create(
            [
                "nombres" => "yaneth",
                "apellidos" => "florez",
                "n_idententidad" => random_int(224343, 33435654),
                "edad" => 30,
                "peso" => 50,
                "altura" => 203,
                "genero" => "M",
                "fecha_nacimiento" => "2019-19-10",
                "planeta_id" => $planeta->id
            ]
        );
        $this->putJson('api/personas/' . $persona->id, [
            "nombres" => "victor barrera",
            "apellidos" => "barrera florez",
            "n_idententidad" => random_int(224343, 33435654),
            "edad" => 20,
            "peso" => 50,
            "altura" => 203,
            "genero" => "M",
            "fecha_nacimiento" => "2019-10-19",
            "planeta_id" => $planeta->id
        ])
            ->assertStatus(200)
            ->assertJsonFragment(
                ['success' => true]
            );

    }

    /** @test */
    function test_personas_delete()
    {
        $planeta = factory(Planeta::class)->create(
            [
                "nombre" => "Tierra",
                "periodo_rotacion" => 3233,
                "diametro" => 232323,
                "clima" => 3,
                "terreno" => "ewwee",
                "masa" => 232,
                "radio_orbital" => 23232
            ]
        );
        $persona = factory(Persona::class)->create(
            [
                "nombres" => "yaneth",
                "apellidos" => "florez",
                "n_idententidad" => random_int(224343, 33435654),
                "edad" => 30,
                "peso" => 50,
                "altura" => 203,
                "genero" => 3222,
                "fecha_nacimiento" => "2019-19-10",
                "planeta_id" => $planeta->id
            ]
        );
        $this->deleteJson('api/personas/' . $persona->id)
            ->assertStatus(200)
            ->assertJsonFragment(
                ['success' => true]
            );
    }

    /** @test */
    public function test_personas_search()
    {
        $planeta = factory(Planeta::class)->create(
            [
                "nombre" => "Tierra",
                "periodo_rotacion" => 3233,
                "diametro" => 232323,
                "clima" => 3,
                "terreno" => "ewwee",
                "masa" => 232,
                "radio_orbital" => 23232
            ]
        );
         factory(Persona::class)->create(
            [
                "nombres" => "yaneth",
                "apellidos" => "florez",
                "n_idententidad" => random_int(224343, 33435654),
                "edad" => 30,
                "peso" => 50,
                "altura" => 203,
                "genero" => 3222,
                "fecha_nacimiento" => "2019-19-10",
                "planeta_id" => $planeta->id
            ]
        );

        $this->postJson('api/personasSearch',[
            "termino"=> "yaneth"
        ])

            ->assertStatus(200)
            ->assertJsonFragment([
                'success' => true,
                "nombres" => "yaneth",
            ]);

    }
}
