<?php

class CreatePostsTest extends FeatureTestCase
{
    public function test_a_user_create_a_post()
    {
        //Having
        $title = 'Esta es una pregunta';
        $content = 'Este es el contenido';

        $this->actingAs($user = $this->defaultUser());

        //When
        $this->visit(route('posts.create'))
            ->type($title, 'title')
            ->type($content, 'content')
            ->press('Publicar');

        //Then
        $this->seeInDatabase('posts',[
           'title' => $title,
           'content' =>  $content,
            'pending' => true,
            'user_id' => $user->id
        ]);

        //Test a user is redirected to the posts details after creating it
        $this->see($title);
    }

    public function test_creating_a_post_requires_authentication()
    {
        //When
        $this->visit(route('posts.create'))
            ->seePageIs(route('login'));
    }

    public function test_create_post_form_validation()
    {
        $this->actingAs($user = $this->defaultUser())
            ->visit(route('posts.create'))
            ->press('Publicar')
            ->seePageIs(route('posts.create'))
            ->seeInElement('#field_title .help-block', 'El campo título es obligatorio')
            ->seeInElement('#field_content .help-block', 'El campo contenido es obligatorio');
    }
}