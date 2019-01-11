<?php

namespace Tests\Browser;

use Illuminate\Support\Facades\Notification;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class WriteCommentTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function test_a_user_can_write_a_comment()
    {
        Notification::fake();

        $post = $this->createPost([
            'title' => 'Como Programar en Java',
        ]);

        $user = $this->defaultUser();

        $this->browse(function (Browser $browser) use ($post, $user) {
            $browser->loginAs($user)
                ->visit($post->url)
                ->type('comment','Un comentario')
                ->press('Publicar comentario');

            $browser->assertPathIs('/posts/1-como-programar-en-java');
        });

        $this->assertDatabaseHas('comments', [
            'comment' => 'Un comentario',
            'user_id' => $user->id,
            'post_id' => $post->id
        ]);
    }

    function test_create_comment_form_validation()
    {
        $post = $this->createPost([
            'title' => 'Como Programar en Java',
        ]);

        $user = $this->defaultUser();

        $this->browse(function (Browser $browser) use ($post, $user) {
            $browser->loginAs($user)
                ->visit($post->url)
                ->press('Publicar comentario')
                ->assertPathIs('/posts/1-como-programar-en-java')
                ->assertSeeErrors([
                    'comment' => 'El campo comentario es obligatorio',
                ]);
        });
    }
}
