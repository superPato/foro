<?php

use App\User;


class ExampleTest extends FeatureTestCase
{

    function test_basic_example()
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
