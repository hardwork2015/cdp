<?php
class AddMemberV extends PHPUnit_Extensions_SeleniumTestCase
{
  protected function setUp()
  {
    $this->setBrowser("*".$_SERVER['HTTP_USER_AGENT']."*");
    $this->setBrowserUrl("http://localhost/laravel/cdp/public/project/1/add");
  }

  public function testMyTestCase()
  {
    $this->open("/laravel/cdp/public/project/1/add");
    $this->type("name=email", "malia@lili.fr");
    $this->click("css=button.btn");
    $this->waitForPageToLoad("30000");
  }
}
?>