<?php

class ValidationTestTache extends PHPUnit_Extensions_SeleniumTestCase
{
    protected function setUp()
    {
        $this->setBrowser("*".$_SERVER['HTTP_USER_AGENT']."*");
        $this->setBrowserUrl("http://localhost/");
    }

    public function testAddUpdateDestroyTask()
    {
        $this->open("/cdp/public/taches/taches");
        $this->assertEquals("Welcome", $this->getText("css=h1"));
        $this->assertEquals("List of tasks", $this->getText("css=h2"));
        $this->click("link=Add Task");
        $this->waitForPageToLoad("30000");
        $this->type("id=code", "XXXXC90");
        $this->type("id=description", "This is a task");
        $this->type("id=start_date", "2015-11-01");
        $this->type("id=end_date", "2015-11-05");
        $this->type("id=us_story_id", "1");
        $this->type("id=predecessors", "2 5");
        $this->click("css=button.btn.btn-primary");
        $this->waitForPageToLoad("30000");
        $this->assertEquals("List of tasks", $this->getText("css=h2"));
        $this->assertEquals("Edit", $this->getText("xpath=(//a[contains(text(),'Edit')])[3]"));
        $this->click("xpath=(//a[contains(text(),'Edit')])[3]");
        $this->waitForPageToLoad("30000");
        $this->type("id=end_date", "2015-10-29");
        $this->click("css=button.btn.btn-primary");
        $this->waitForPageToLoad("30000");
        $this->assertEquals("The end date must be a date after start date.", $this->getText("css=div.alert.alert-danger > ul > li"));
        $this->type("id=code", "");
        $this->click("css=button.btn.btn-primary");
        $this->waitForPageToLoad("30000");
        $this->assertEquals("The code field is required.", $this->getText("css=div.alert.alert-danger > ul > li"));
        $this->type("id=end_date", "2015-11-05");
        $this->type("id=code", "TUAJXX09");
        $this->type("id=description", "This  task is updated");
        $this->assertEquals("Send", $this->getText("css=button.btn.btn-primary"));
        $this->click("css=button.btn.btn-primary");
        $this->waitForPageToLoad("30000");
        $this->assertEquals("This task is updated", $this->getText("//tr[3]/td[2]"));
        $this->assertEquals("Destroy", $this->getText("//tr[3]/td[6]/form/button"));
        $this->click("//tr[3]/td[6]/form/button");
        $this->waitForPageToLoad("30000");
        $this->assertEquals("List of tasks", $this->getText("css=h2"));
        $this->assertEquals("Code", $this->getText("css=th"));
        $this->assertEquals("Description", $this->getText("//th[2]"));
        $this->assertEquals("Start Date", $this->getText("//th[3]"));
        $this->assertEquals("End Date", $this->getText("//th[4]"));
        $this->assertEquals("Predecessors", $this->getText("//th[5]"));
        $this->assertEquals("Actions", $this->getText("//th[6]"));
    }
}
?>