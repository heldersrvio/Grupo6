<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use equipac\Models\Bolsista;
use equipac\Models\Usuario;
use equipac\Models\Equipamento;
use equipac\Models\Manutencao;
use Faker\Factory as Faker;

class MailChamadoTest extends TestCase
{
    use WithoutMiddleware;

    public function testSendMailChamado()
    {
        $faker = Faker::create();
        $usuario = factory(Usuario::class)->create();

        $response = $this->actingAs($usuario, 'usuario')->post('/usuario/problemas', [
            'descricao' => $faker->text(150)
        ]);

        $response->assertStatus(302);
        $pro = $usuario->problema;

        $bolsista = factory(Bolsista::class)->create();
        $cha = $pro->last()->chamado;
        
        $response2 = $this->actingAs($bolsista, 'bolsista')->post('/bolsista/chamados', [
            'id' => $cha->id,
            'status' => 2,
            'idb' => $bolsista->id
        ]);

        $response2->assertStatus(302);
    }
}
