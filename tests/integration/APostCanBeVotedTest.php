<?php
namespace Tests\integration;

use App\Vote;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class APostCanBeVotedTest extends \TestCase
{
    use DatabaseTransactions;

    function test_a_post_can_be_upvoted()
    {
        $user = $this->defaultUser();

        $this->actingAs($user);

        $post = $this->createPost();

        Vote::upvote($post);

        $this->assertDatabaseHas('votes', [
            'post_id' => $post->id,
            'user_id' => $user->id,
            'vote' => 1,
        ]);

        $this->assertSame(1, $post->score);
    }
}