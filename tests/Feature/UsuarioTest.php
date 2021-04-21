<?php

namespace Tests\Feature;

use equipac\Models\Usuario;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsuarioTest extends TestCase
{
    public function testRegister()
    {
        $response = $this->get('/usuario/register');
        $response->assertStatus(200);
    }

    public function testLogin()
    {

        $Usuario = factory(Usuario::class)->create();

        $response = $this->post('/usuario/login', [
            'email' => $Usuario->email,
            'password' => 'root1234'
        ]);

        $response->assertStatus(302);
        $this->assertAuthenticatedAs($Usuario, 'usuario');
    }

    /**
     * An invalid Usuario cannot be logged in.
     *
     * @return void
     */
    public function testPasswordInvalido()
    {
        $Usuario = factory(Usuario::class)->create();
        $response = $this->post('/usuario/login', [
            'email' => $Usuario->email,
            'password' => 'xxx'
        ]);
        $response->assertSessionHasErrors('password');
        $this->assertGuest();
    }

    public function testLoginInvalido()
    {
        $Usuario = factory(Usuario::class)->create();
        $response = $this->post('/usuario/login', [
            'email' => $Usuario->email,
            'password' => 'invalid'
        ]);
        $this->assertGuest();
    }
    
    /**
     * A logged in Usuario can be logged out.
     *
     * @return void
     */
    public function testLogout()
    {
        $Usuario = factory(Usuario::class)->create();
        $response = $this->actingAs($Usuario)->post('/logout');
        $response->assertStatus(302);
        $this->assertGuest();
    }
}
