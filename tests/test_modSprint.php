<?php
class test_modSprint extends PHPUnit_Extensions_SeleniumTestCase
{
    protected function setUp()
    {
        $this->setBrowser("*".$_SERVER['HTTP_USER_AGENT']."*");
        $this->setBrowserUrl("http://localhost:8000/cdp/public/tachesv/taches");
    }

    public function testMyTestCase()
    {
        $this->open("/cdp/public/sprint/1/edit/1");
        $this->type("name=EndDate", "25/12/2055");
        $this->click("css=button.btn");
        $this->waitForPageToLoad("30000");
        try {
            $this->assertEquals("25/12/2055", $this->getValue("name=EndDate"));
        } catch (PHPUnit_Framework_AssertionFailedError $e) {
            array_push($this->verificationErrors, $e->toString());
        }
    }
}
?>