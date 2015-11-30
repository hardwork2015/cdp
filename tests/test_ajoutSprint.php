<?php
class test_ajoutSprint extends PHPUnit_Extensions_SeleniumTestCase
{
  protected function setUp()
  {
    $this->setBrowser("*".$_SERVER['HTTP_USER_AGENT']."*");
    $this->setBrowserUrl("http://localhost:8000/cdp/public/sprint/1/add");
  }

  public function testMyTestCase()
  {
    $this->open("/cdp/public/sprint/1/add");
    $this->type("name=StartDate", "sqkjdhqkjdhqkjd");
    $this->type("name=EndDate", "qlkdsldqldqldksd");
    $this->click("css=button.btn");
    $this->waitForPageToLoad("30000");
    $this->type("name=StartDate", "2015-5-3");
    $this->type("name=EndDate", "2015-5-2");
    $this->click("css=button.btn");
    $this->waitForPageToLoad("30000");
    $this->type("name=StartDate", "2015-5-2");
    $this->type("name=EndDate", "2015-5-7");
    $this->click("css=button.btn");
    $this->waitForPageToLoad("30000");
    $this->assertTrue($this->isTextPresent("css=body"));
  }
}
?>