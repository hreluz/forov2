<?php

use App\Post;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ShowPostTest extends TestCase
{
    public function test_a_user_can_see_the_post_details()
    {
        //Having
        $user = $this->defaultUser([
            'name' => 'Hector Lavoe'
        ]);

        $post = factory(Post::class)->make([
            'title' => 'Como instalar Laravel',
            'content' => 'Este es el contenido del post'
        ]);

        $user->posts()->save($post);

        //When
        $this->visit($post->url)
            ->seeInElement('h1', $post->title)
            ->see($post->conntent)
            ->see($user->name);
    }

    public function test_old_urls_are_redirected()
    {
        //Having
        $user = $this->defaultUser();

        $post = factory(Post::class)->make([
            'title' => 'Old Title',
        ]);

        $user->posts()->save($post);

        $url = $post->url;

        $post->update(['title' => 'New Title']);

        $this->visit($url)
            ->seePageIs($post->url);
    }
}
