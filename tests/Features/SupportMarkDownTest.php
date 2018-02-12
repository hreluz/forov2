<?php

class SupportMarkDownTest extends FeatureTestCase
{
    public function test_the_post_content_support_markdown()
    {
        $importantText = 'Un texto muy importante';
        $post = $this->createPost([
            'content' => "La primera parte del texto. **$importantText**. La última parte del texto"
        ]);

        $this->visit($post->url)
            ->seeInElement('strong', $importantText);
    }

    public function test_the_code_in_the_post_is_escaped()
    {
        $xssAttack = "<script>alert('Malicious JS')</script>";
        $post = $this->createPost([
            'content' => "`$xssAttack`. Text normal."
        ]);

        $this->visit($post->url)
            ->dontSee($xssAttack)
            ->seeText('Text normal')
            ->seeText($xssAttack);
    }

    public function test_xss_attack()
    {
        $xssAttack = "<script>alert('Malicious JS')</script>";
        $post = $this->createPost([
            'content' => "$xssAttack. Text normal."
        ]);

        $this->visit($post->url)
            ->dontSee($xssAttack)
            ->seeText($xssAttack);
    }

    public function test_xss_attack_with_html()
    {
        $xssAttack = "<img src='imagen.jpg'>";
        $post = $this->createPost([
            'content' => "$xssAttack. Text normal."
        ]);

        $this->visit($post->url)
            ->dontSee($xssAttack);
    }
}
