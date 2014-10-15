<?php

/**
 * Description of WebDriverTest
 *
 * @author Romualdo Dasig <dasig.rg@a5project.com>
 */
class WebDriverTest extends TestCase
{

    public function testCreateDriver()
    {
        // This would be the url of the host running the server-standalone.jar
        $wd_host = 'http://localhost:4444/wd/hub';
        $web_driver = new PHPWebDriver_WebDriver($wd_host);
        
        // POST /session
        $session = $web_driver->session('firefox');
        var_dump($session);
    }
}