<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use equipac\Models\Bolsista;
use equipac\Models\Usuario;
use equipac\Models\Equipamento;
use equipac\Models\Supervisor;
use Faker\Factory as Faker;

class RelatorioChamadoTest extends TestCase
{
    public function testRelatorioChamado()
    {
        $faker = Faker::create();
        $supervisor = factory(Supervisor::class)->create();
        $bolsista = factory(Bolsista::class)->create();

        $response = $this->actingAs($supervisor, 'supervisor')->post('/supervisor/relatorio-chamado/{{$bolsista->id}}', [
            'id' => $bolsista->id
        ]);

        $response->assertStatus(200);
    }
}
