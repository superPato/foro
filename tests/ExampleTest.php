<?php

use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $user = factory(User::class)->create([
            'name' => 'Cesar Acual',
            'email' => 'admin@styde.net',
        ]);

        $this->actingAs($user, 'api')
            ->visit('api/user')
            ->see('Cesar Acual')
            ->see('admin@styde.net');
    }
}
