<?php
class test_kanban extends PHPUnit_Extensions_SeleniumTestCase
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
    $this->click("link=Project List");
    $this->waitForPageToLoad("30000");
    $this->click("link=Disply");
    $this->waitForPageToLoad("30000");
    $this->click("link=Update");
    $this->waitForPageToLoad("30000");
    $this->click("//button[@type='submit']");
    $this->waitForPageToLoad("30000");
    $this->click("link=show Sprint List");
    $this->waitForPageToLoad("30000");
    $this->click("link=Task List");
    $this->waitForPageToLoad("30000");
    $this->click("link=Add Task");
    $this->waitForPageToLoad("30000");
    $this->type("id=code", "drqsqsd");
    $this->type("id=description", "qsdqsdqsd");
    $this->type("id=start_date", "2015-5-3");
    $this->type("id=end_date", "2015-5-9");
    $this->click("css=button.btn.btn-primary");
    $this->waitForPageToLoad("30000");
    $this->click("link=show Kanban");
    $this->waitForPageToLoad("30000");
    $this->verifyText("css=td", "qsdqsdqsd");
    $this->click("link=Take a Task");
    $this->waitForPageToLoad("30000");
    $this->click("link=Take");
    $this->waitForPageToLoad("30000");
    $this->verifyText("css=div.alert.alert-success", "It's yours now");
    $this->click("link=Current Kanban");
    $this->waitForPageToLoad("30000");
    $this->verifyText("//td[2]", "qsdqsdqsd [yedir]");
    $this->click("link=Take a Task");
    $this->waitForPageToLoad("30000");
    $this->click("link=Finish your task");
    $this->waitForPageToLoad("30000");
    $this->click("link=Current Kanban");
    $this->waitForPageToLoad("30000");
    $this->verifyText("//td[3]", "qsdqsdqsd [yedir]");
  }
}
?>