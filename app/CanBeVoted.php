<?php
namespace App;


trait CanBeVoted
{
    public function getCurrentVoteAttribute()
    {
        if (auth()->check()) {
            return $this->getVoteFrom(auth()->user());
        }
    }

    // check code
    public function getVoteFrom(User $user) {
        return Vote::where('user_id', $user->id)->value('vote');
    }

    public function upvote()
    {
        $this->addVote(1);
    }

    public function downvote()
    {
        $this->addVote(-1);
    }

    protected function addVote($amount)
    {
        Vote::updateOrCreate(
            ['post_id' => $this->id, 'user_id' => auth()->id()],
            ['vote' => $amount]
        );

        $this->refreshPostScore();
    }

    public function undoVote()
    {
        Vote::where([
            'post_id' => $this->id,
            'user_id' => auth()->id(),
        ])->delete();

        $this->refreshPostScore();
    }

    protected function refreshPostScore()
    {
        $this->score = Vote::query()
            ->where(['post_id' => $this->id])
            ->sum('vote');

        $this->save();
    }
}