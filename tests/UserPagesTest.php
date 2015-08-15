<?php
class UserPagesTest extends TestCase
{
    /** @test */
    function sign_up_page_have_contents_Sign_Up() {
        $this->visit('auth/register')
            ->see("Sign Up");
    }
}
