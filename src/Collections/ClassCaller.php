<?php


namespace ArpaBlue\FFTest\Collections;

use ArpaBlue\FFTest\Tools\ConsoleColors;
use ArpaBlue\FFTest\Tools\ClassTools;

/**
 * Class ClassCaller
 * @package ArpaBlue\FFTest\Collections
 * It have the reference to a class and load the methods related to this class.
 */
class ClassCaller extends ClassCallerBase
{
    /**
     * Default constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Default destructor.
     */
    public function __destruct()
    {
        parent::__destruct();
    }

    /**
     * @return string|null It return the instance for the class.
     */
    public function getConstructor()
    {
        if( $this->getNameSpace() === null )
        {
            return $this->getName();
        }
        return $this->getNamespace()."\\".$this->getName();
    }
    /**
     * It create a instance of the object and calla the methods specified in the
     */
    public function call()
    {

        $className = $this->getConstructor();
        $this->console( "- Test Plan: " . $className, ConsoleColors::GREEN  );
        $obj = new $className();
        if( !ClassTools::callMethod( $obj, "beforeAll" ) )
        {
            $this->console("ERROR: The [".$className."] class is not a valid Test Plan. It should be inherited from ArpaBlue/FFtest/TestSuite class.", ConsoleColors::RED );
            return;
        }
        $obj->setTestPlanFile( $this->getFile() );
        $obj->run( $this->getMethods() );
        ClassTools::callMethod( $obj, "afterAll" );
    }


}