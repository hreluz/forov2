<?php

class ExampleTest extends FeatureTestCase
{
    function test_basic_example()
    {
        $user = factory(\App\User::class)->create([
            'name' => 'Hector Lavoe',
            'email' => 'migente@lavoe.com'
        ]);

        $this->actingAs($user,'api')
            ->visit('api/user')
            ->see('Hector Lavoe')
            ->see('migente@lavoe.com');
    }
}
