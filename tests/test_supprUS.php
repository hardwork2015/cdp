<?php
class test_supprUS extends PHPUnit_Extensions_SeleniumTestCase
{
  protected function setUp()
  {
    $this->setBrowser("*".$_SERVER['HTTP_USER_AGENT']."*");
    $this->setBrowserUrl("http://localhost:8000/cdp/public/backlog");
  }

  public function testMyTestCase()
  {
    $this->open("/cdp/public/backlog/userstory/create");
    $this->type("id=priority", "1");
    $this->type("id=difficulty", "1");
    $this->type("id=description", "Voici une userStory de test");
    $this->click("css=button.btn");
    $this->open("/cdp/public/backlog/userstory/create");
    $this->type("id=priority", "2");
    $this->type("id=difficulty", "4");
    $this->type("id=description", "Voici une autre userStory de test");
    $this->click("css=button.btn");
    $this->open("/cdp/public/backlog/userstory/remove/1");
    $this->verifyText("//tr[2]/th", "2");

  }
}
?>