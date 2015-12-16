<?php
use Illuminate\Foundation\Testing\DatabaseMigrations;
class StaticPagesTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function home_page_have_the_content_Sample_App() {
        $this->visit('/')
            ->see("Sample App")
            ->seeInTitle("Laravel Tutorial Sample App")
            ->dontSeeInTitle("| Home");
    }

    /** @test */
    function help_page_have_the_content_Help() {
        $this->visit('help')
            ->see("Help")
            ->seeInTitle("Laravel Tutorial Sample App | Help");
    }

    /** @test */
    function about_page_have_the_content_About_Us() {
        $this->visit('about')
            ->see("About Us")
            ->seeInTitle("Laravel Tutorial Sample App | About Us");
    }

    public function dontSeeInTitle($text)
    {
        $this->assertNotContains($text, $this->crawler->filter("title")->text());
        return $this;
    }

    public function seeInTitle($text)
    {
        $this->assertContains($text, $this->crawler->filter("title")->text());
        return $this;
    }

    /** @test */
    function home_page_should_render_ther_users_feed()
    {
        $user = factory(App\User::class)->create();
        factory(App\Micropost::class)->create(['user_id' => $user->id]);
        factory(App\Micropost::class)->create(['user_id' => $user->id]);
        $this->actingAs($user)
            ->visit('/');
        $user->feed()->get()->each(function ($item) {
            $this->seeInElement("li#{$item->id}", $item->content);
        });
    }

}
