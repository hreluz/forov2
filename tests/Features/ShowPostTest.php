<?php

class ShowPostTest extends FeatureTestCase
{
    public function test_a_user_can_see_the_post_details()
    {
        //Having
        $user = $this->defaultUser([
            'name' => 'Hector Lavoe'
        ]);

        $post = $this->createPost([
            'title' => 'Como instalar Laravel',
            'content' => 'Este es el contenido del post',
            'user_id' => $user->id
        ]);

        //When
        $this->visit($post->url)
            ->seeInElement('h1', $post->title)
            ->see($post->content)
            ->see('Hector Lavoe');
    }

    public function test_old_urls_are_redirected()
    {
        //Having
        $post = $this->createPost([
            'title' => 'Old Title',
        ]);

        $url = $post->url;

        $post->update(['title' => 'New Title']);

        $this->visit($url)
            ->seePageIs($post->url);
    }
}
