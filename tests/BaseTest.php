<?php
use PHPUnit\Framework\TestCase;

use Clickpdx\Core\Application;
use Clickpdx\Core\System\Settings;


require 'bootstrap.php';
require 'vendor/clickpdx/core/lib/Clickpdx/Core/Email.php';



final class BaseTest extends TestCase
{
    public function testCanBeCreatedFromValidEmailAddress()
    {
        $this->assertInstanceOf(
            Email::class,
            Email::fromString('user@example.com')
        );
    }

    public function testCannotBeCreatedFromInvalidEmailAddress()
    {
        $this->setExpectedException(InvalidArgumentException::class);

        Email::fromString('invalid');
    }

    public function testCanBeUsedAsString()
    {
        $this->assertEquals(
            'user@example.com',
            Email::fromString('user@example.com')
        );
    }
    
    
    /**
     * @testMethod testLoadingSettings
     *
     * @description Bootstrap files and autoloader and test database connections.
     */
    public function testLoadingSettings(){
    	global $resources, $db_connection;

			Settings::loadDefaults();

			$resources = Settings::get('resources');
			
			
			// Perform a database connection
			$db_connection = get_resource('default'); // @jbernal
			
			// $results = db_query('SELECT data FROM cms_config WHERE variable="modules"')->fetch_row();
			
			_drupal_load_modules(true);
    }
    
    
    /**
     * @testMethod Instance an Application instance.
     *
     * @description We should be able to invoke a path/resource
     *  from the CLI.
     */
    public function testInitializingApplication(){
    	global $resources;

			Settings::loadDefaults();

			$resources = Settings::get('resources');
			
			$context = Application::returnBestGuessContext();

			$app = Application::newFromContext($context);
		}
    
}
