<?php

namespace Tests\Feature;

use equipac\Models\Bolsista;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class BolsistaTest extends TestCase
{
    use WithoutMiddleware;

    public function testLogin()
    {

        $bolsista = factory(Bolsista::class)->create();

        $response = $this->post('/bolsista/login', [
            'email' => $bolsista->email,
            'password' => 'root1234'
        ]);

        $response->assertStatus(302);
        $this->assertAuthenticatedAs($bolsista, 'bolsista');
    }

    /**
     * An invalid Bolsista cannot be logged in.
     *
     * @return void
     */
    public function testPasswordInvalido()
    {
        $bolsista = factory(Bolsista::class)->create();
        $response = $this->post('/bolsista/login', [
            'email' => $bolsista->email,
            'password' => 'xxx'
        ]);
        $response->assertSessionHasErrors('password');
        $this->assertGuest();
    }

    public function testLoginInvalido()
    {
        $bolsista = factory(Bolsista::class)->create();
        $response = $this->post('/bolsista/login', [
            'email' => $bolsista->email,
            'password' => 'invalid'
        ]);
        $this->assertGuest();
    }

    /**
     * A logged in Bolsista can be logged out.
     *
     * @return void
     */
    public function testLogout()
    {
        $bolsista = factory(Bolsista::class)->create();
        $response = $this->actingAs($bolsista)->post('/logout');
        $response->assertStatus(302);
        $this->assertGuest();
    }
}
