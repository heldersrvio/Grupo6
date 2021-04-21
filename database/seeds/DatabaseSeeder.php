<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use equipac\Models\Usuarios;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        //$this->call('bolsistasTableSeeder');
        factory(Usuarios::class, 10)->create();
    }
}

//alura
class createBolsistaTable extends Seeder
{
    public function run()
    {
        DB::insert(
            'insert into bolsistas (nome, email, password, cpf) values (?,?,?,?)',
            array('joaov', 'joaov@gmail.com', 'root213','123.321.124-32')
        );

        DB::insert(
            'insert into bolsistas
      (nome, email, password, cpf)
        values (?,?,?,?)',
            array('joaoc', 'joaoc@gmail.com', 'root122', '123.321.122-32')
        );

        DB::insert(
            'insert into bolsistas
       (nome, email, password, cpf)
        values (?,?,?,?)',
            array('joaovv', 'joaovv@gmail.com', 'root121', '123.321.323-32')
        );
    }
}
