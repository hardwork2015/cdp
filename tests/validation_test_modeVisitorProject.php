<?php

class ModeVisitor extends PHPUnit_Extensions_SeleniumTestCase
{
    protected function setUp()
    {
        $this->setBrowser("*".$_SERVER['HTTP_USER_AGENT']."*");
        $this->setBrowserUrl("http://localhost/");
    }

    public function testModeVisitorDisplayProject()
    {
        $this->open("/cdp/public/project/1/visitor");
        $this->assertEquals("Accès pour les visiteurs", $this->getText("css=b"));
        $this->assertEquals("Autoriser les visiteurs", $this->getText("link=Autoriser les visiteurs"));
        $this->click("link=Autoriser les visiteurs");
        $this->waitForPageToLoad("30000");
        $this->assertEquals("Voici le lien à partager avec vos visiteurs : Lien", $this->getText("css=p"));
        $this->assertEquals("Lien", $this->getText("link=Lien"));
        $this->assertEquals("Vous pouvez interdire les visiteurs en cliquant ici (attention la clée actuelle ne sera plus valable) :Interdire les visiteurs", $this->getText("//p[2]"));
        $this->assertEquals("Interdire les visiteurs", $this->getText("link=Interdire les visiteurs"));
        $this->click("link=Lien");
        $this->waitForPageToLoad("30000");
        $this->click("link=Interdire les visiteurs");
        $this->waitForPageToLoad("30000");
        $this->click("link=Autoriser les visiteurs");
        $this->waitForPageToLoad("30000");
        $this->assertEquals("Your Environment GL", $this->getText("link=Your Environment GL"));
        $this->click("link=Visiteur");
        $this->waitForPageToLoad("30000");
        $this->assertEquals("La liste des Projets", $this->getText("css=h2"));
        $this->assertEquals("List of tasks", $this->getText("css=h2"));
        $this->assertEquals("Login", $this->getText("link=Login"));
        $this->assertEquals("Sign Up", $this->getText("link=Sign Up"));
        $this->click("link=Your Environment GL");
        $this->waitForPageToLoad("30000");
    }



}
