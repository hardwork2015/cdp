<?php
class test_ajoutUSsprint extends PHPUnit_Extensions_SeleniumTestCase
{
  protected function setUp()
  {
    $this->setBrowser("*".$_SERVER['HTTP_USER_AGENT']."*");
    $this->setBrowserUrl("http://localhost:8000/cdp/public/tachesv/taches");
  }

  public function testMyTestCase()
  {
    $this->open("/cdp/public/backlog/userstory/create");
    $this->type("id=priority", "1");
    $this->type("id=priority", "2");
    $this->type("id=priority", "3");
    $this->type("id=priority", "4");
    $this->type("id=priority", "5");
    $this->type("id=difficulty", "1");
    $this->type("id=difficulty", "2");
    $this->type("id=difficulty", "3");
    $this->type("id=description", "another test");
    $this->click("css=button.btn");
    $this->waitForPageToLoad("30000");
    $this->verifyText("css=td", "another test");
  }
}
?>