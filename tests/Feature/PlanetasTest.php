<?php

namespace Tests\Feature;

use App\Planeta;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use function Psy\debug;
use Tests\TestCase;

class PlanetasTest extends TestCase
{
    /** @test */
    function test_planetas_index()
    {
        $this->json('get', 'api/planetas')
            ->assertStatus(200)
            ->assertJsonFragment(
                ['success' => true]
            );
    }

    /** @test */
    function test_planetas_show()
    {
        $planeta = factory(Planeta::class)->create(
            [
                "nombre" => "Saturno",
                "periodo_rotacion" => 3233,
                "diametro" => 232323,
                "clima" => 3,
                "terreno" => "ewwee",
                "masa" => 232,
                "radio_orbital" => 23232
            ]
        );
        $this->getJson('api/planetas/' . $planeta->id)
            ->assertStatus(200)
            ->assertJsonFragment(
                ['success' => true]
            );

    }

    /** @test */
    function test_planetas_store()
    {
        $this->postJson('api/planetas', [
            "nombre" => "Tierra",
            "periodo_rotacion" => 3233,
            "diametro" => 232323,
            "clima" => 3,
            "terreno" => "ewwee",
            "masa" => 232,
            "radio_orbital" => 23232
        ])
            ->assertStatus(201)
            ->assertJsonFragment(
                ['success' => true]
            );
    }

    /** @test */
    function test_planetas_update()
    {
        $planeta = factory(Planeta::class)->create(
            [
                "nombre" => "Saturno",
                "periodo_rotacion" => 3233,
                "diametro" => 232323,
                "clima" => 3,
                "terreno" => "ewwee",
                "masa" => 232,
                "radio_orbital" => 23232
            ]
        );
        $this->putJson('api/planetas/' . $planeta->id, [
            "nombre" => "Martes",
            "periodo_rotacion" => 3233,
            "diametro" => 232323,
            "clima" => 3,
            "terreno" => "ewwee",
            "masa" => 232,
            "radio_orbital" => 23232
        ])
            ->assertStatus(200)
            ->assertJsonFragment(
                ['success' => true]
            );

    }

    /** @test */
    function test_planetas_delete()
    {
        $planeta = factory(Planeta::class)->create(
            [
                "nombre" => "Saturno",
                "periodo_rotacion" => 3233,
                "diametro" => 232323,
                "clima" => 3,
                "terreno" => "ewwee",
                "masa" => 232,
                "radio_orbital" => 23232
            ]
        );
        $this->deleteJson('api/planetas/' . $planeta->id)
            ->assertStatus(200)
            ->assertJsonFragment(
                ['success' => true]
            );
    }

    /** @test */
    public function test_planetas_search()
    {
        factory(Planeta::class)->create(
            [
                "nombre" => "Saturno",
                "periodo_rotacion" => 3233,
                "diametro" => 232323,
                "clima" => "6",
                "terreno" => "ewwee",
                "masa" => 232,
                "radio_orbital" => 23232
            ]);

        $this->postJson('api/planetasSearch', [
            "termino" => "Saturno"
        ])
            ->assertStatus(200)
            ->assertJsonFragment([
                "nombre" => "Saturno",
            ]);

    }


}
