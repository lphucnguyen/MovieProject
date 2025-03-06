<?php

namespace App\Traits;

trait Reviewable
{
    public function review($user, $title, $review)
    {
        $result = $this->reviews()->updateOrCreate(
            ['user_id' => $user->id, 'film_id' => $this->id],
            ['title' => $title, 'review' => $review]
        );
        return true;
    }

    public function deleteReview($user)
    {
        $this->reviews()->where('user_id', $user->id)->delete();
    }
}
