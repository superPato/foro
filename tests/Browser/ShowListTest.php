<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ShowListTest extends DuskTestCase
{
    use DatabaseMigrations;

    function test_a_user_can_see_the_post_details()
    {
        // Having
        $user = $this->defaultUser([
            'first_name' => 'Cesar',
            'last_name' => 'Acual'
        ]);

        $post = $this->createPost([
            'title' => 'Este es el título del post',
            'content' => 'Este es el contenido del post',
            'user_id' => $user->id
        ]);

        $this->browse(function (Browser $browser) use ($post) {
            //When
            $browser->visit($post->url)
                ->assertSeeIn('h1', $post->title)
                ->assertSee($post->content)
                ->assertSee('Cesar Acual');
        });
    }

    function test_old_urls_are_redirected()
    {
        // Having
        $post = $this->createPost([
            'title' => 'Old title'
        ]);

        $url = $post->url;


        $post->update(['title' => 'New title']);

        $this->browse(function (Browser $browser) use ($url) {
            $browser->visit($url)
                ->assertPathIs('/posts/1-new-title');
        });
    }
}
