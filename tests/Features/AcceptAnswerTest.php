<?php

use App\Comment;

class AcceptAnswerTest extends FeatureTestCase
{
    public function test_the_posts_author_can_accept_a_comment_as_the_posts_answer()
    {
        $comment = factory(Comment::class)->create([
            'comment' => 'Esta es la respuesta del post'
        ]);

        $this->actingAs($comment->post->user);

        $this->visit($comment->post->url)
            ->press('Aceptar Respuesta');

        $this->seeInDatabase('posts',[
            'id' => $comment->post_id,
            'pending' => false,
            'answer_id' => $comment->id
        ]);

        $this->seePageIs($comment->post->url)
            ->seeInElement('.answer', $comment->comment);

    }
}
