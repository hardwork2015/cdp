<?php
class test_supprMember extends PHPUnit_Extensions_SeleniumTestCase
{
  protected function setUp()
  {
    $this->setBrowserUrl("http://localhost:8000/cdp/public/tachesv/taches");
  }

  public function testMyTestCase()
  {
    $this->open("/cdp/public/");
    $this->click("link=Login");
    $this->waitForPageToLoad("30000");
    $this->type("name=email", "yedir.ouarmassi@laposte.net");
    $this->type("name=password", "alakazam");
    $this->click("css=button.btn.btn-primary");
    $this->waitForPageToLoad("30000");
    $this->click("link=Create a Project");
    $this->waitForPageToLoad("30000");
    $this->type("name=title", "test");
    $this->type("name=description", "azeaeaez");
    $this->type("name=startDate", "2015-11-06");
    $this->click("css=button.btn.btn-primary");
    $this->waitForPageToLoad("30000");
    $this->click("link=Project List");
    $this->waitForPageToLoad("30000");
    $this->click("link=Disply");
    $this->waitForPageToLoad("30000");
    $this->verifyText("//tbody/tr/th[2]", "yedir.ouarmassi@laposte.net");
    // $this->();
    $this->type("name=email", "test@test.");
    $this->type("name=email", "test@test.com");
    $this->click("css=button.btn");
    $this->waitForPageToLoad("30000");
    $this->verifyText("//tbody/tr/th[2]", "test@test.com");
    $this->click("link=Delete");
    $this->waitForPageToLoad("30000");
    $this->verifyText("//tbody/tr/th[2]", "yedir.ouarmassi@laposte.net");
    $this->click("link=Delete");
    $this->waitForPageToLoad("30000");
    $this->verifyText("css=p", "Aucun membre n'a été ajouté.");
  }
}
?>