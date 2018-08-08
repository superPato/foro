<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class PostIntegrationTest extends TestCase
{
    use DatabaseTransactions;

    public function test_a_slug_is_generated_and_saved_to_the_database()
    {
        $post = $this->createPost([
            'title' => 'Como instalar laravel'
        ]);

        $this->assertSame(
            'como-instalar-laravel',
            $post->fresh()->slug
        );
    }
}
