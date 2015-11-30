<?php
/**
 * User: oumaziz
 * Date: 02/11/15
 * Time: 13:30
 */

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthentificationTest extends TestCase
{

    /**
     * Fonction permettant de tester la création
     * d'un nouveau compte
     *
     * @return void
     */
    public function testCreateNewAccount()
    {

        $this->artisan('migrate');
        $this->flushSession();

        $this->visit('/auth/register')
            ->type('testCase', 'FirstName')
            ->type('testCase', 'FamilyName')
            ->type('test@testCase.com', 'email')
            ->type('password', 'password')
            ->type('password', 'password_confirmation')
            ->press('Register');
    }

    /**
     * Fonction permettant de tester la
     * connexion avec un nouveau compte
     *
     * @return void
     */
    public function testLoginToNewAccount()
    {
        $this->visit('/auth/login')
            ->type('test@test.com', 'email')
            ->type('password', 'password')
            ->press('Login')
            ->seePageIs('/home');

        $this->artisan('migrate:rollback');
        $this->artisan('migrate');
    }
}
