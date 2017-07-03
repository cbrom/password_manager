<?php
use PHPUnit\Extensions\Selenium2TestCase;

class SampleIntegration extends PHPUnit_Extensions_Selenium2TestCase
{
	public function setUp()
	{
		$this->setBrowser("*chrome");
		$this->setBrowserUrl("http://localhost/cbs_projects/password_manager_clean/");
		$x = 20;
		var_dump($x)
	}

	public function testTitle()
	{
		var_dump($this->title());
	}
}