<?php
class Example extends PHPUnit_Extensions_SeleniumTestCase
{
  protected function setUp()
  {
    $this->setBrowser("*chrome");
    $this->setBrowserUrl("http://localhost/laravel/cdp/public/sprint/list/1");
  }

  public function testMyTestCase()
  {
    $this->open("/laravel/cdp/public/sprint/list/1");
    $this->click("link=Kanban");
    $this->waitForPageToLoad("30000");
    $this->click("link=Take a Task");
    $this->waitForPageToLoad("30000");
    $this->click("link=Take");
    $this->waitForPageToLoad("30000");
    $this->click("link=Current Kanban");
    $this->waitForPageToLoad("30000");
    $this->click("link=Take a Task");
    $this->waitForPageToLoad("30000");
    $this->click("link=Finish your task");
    $this->waitForPageToLoad("30000");
  }
}
?>