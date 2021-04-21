<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CalculationsTest extends TestCase
{
    /**
     * Un semplice test di base.
     *
     * @return void
     */
    public function testAdd()
    {
        $this->assertEquals(
            4,
            2 + 2
        );
    }

    /**
     * Un altro semplice test di base.
     *
     * @return void
     */
    public function testMultiply()
    {
        $this->assertEquals(
            9,
            3 * 3
        );
    }
}
