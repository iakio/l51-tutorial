<?php
class StaticPagesTest extends TestCase
{
    /** @test */
    function home_page_have_the_content_Sample_App() {
        $this->visit('static_pages/home')
            ->see("Sample App")
            ->seeInTitle("Laravel Tutorial Sample App")
            ->dontSeeInTitle("| Home");
    }

    /** @test */
    function help_page_have_the_content_Help() {
        $this->visit('static_pages/help')
            ->see("Help")
            ->seeInTitle("Laravel Tutorial Sample App | Help");
    }

    /** @test */
    function about_page_have_the_content_About_Us() {
        $this->visit('static_pages/about')
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
}
