<?php
namespace ArpaBlue\FFTest;

use ArpaBlue\FFTest\Interfaces\IBeforeAfter;
use ArpaBlue\FFTest\TestCaseException\BlockException;
use ArpaBlue\FFTest\TestCaseException\DeprecatedException;
use ArpaBlue\FFTest\TestCaseException\FailException;
use ArpaBlue\FFTest\TestObjs\TestCase;
use ArpaBlue\FFTest\TestObjs\TestSuiteBA;
use ArpaBlue\FFTest\Tools\ConsoleColors;

/**
 * Class TestSuit
 * @package ArpaBlue\FFTest
 * It contain the basic methods to execute the test cases in the class.
 */
class TestSuite extends TestSuiteBA implements IBeforeAfter
{
    /**
     * @var string It is the name of the current test case to be execute.
     */
    private $_CurrentTestCase = null;
    /**
     * It specify the current test case.
     * @param string $testCase It is the name of the current test case.
     */
    private function setCurrentTestCase( $testCase )
    {
        $this->_CurrentTestCase = $testCase;
    }

    /**
     * It specify a state to the current state to set to the current test case.
     * @param int $state It is the test case to be set it.
     */
    private function setCurrentTestCaseState( $state )
    {
        $this->getCurrentTestCase()->_State = $state;
    }
    protected $_TestCases;
    /**
     * It return the name of the current test case, if an test case has been executed
     * then the method return null.
     * @return string It is the name of the current test case.
     */
    public function getCurrentTestCase()
    {
        return $this->_CurrentTestCase;
    }
    /**
     * It return the data of the current test suite in a JSON format.
     * @return string It is the data of the current object.
     */
    public function toJSON()
    {
        $res = "{";
        $res = $res . "}";
        return $res;
    }
    /**
     * It return the data of the current test suite in a JSON format.
     * @return string It is the data of the current object.
     */
    public function toJSONnice()
    {
        $res = "{\n";
        $res = $res . "}";
        return $res;
    }
    /**
     * It return the data of the current Test Suite in string.
     * @return string It return the data of the current data of the Test Suite.
     */
    public function __toString()
    {
        return $this->toJSONnice();
    }
    /**
     * This method is called before the execution of the test case and it is used
     * to configure the logs and the resources for the execution.
     */
    private function beforeExecution()
    {
    }
    /**
     * This method is called before the execution of the test case and it is used
     * to configure the logs and the resources for the execution.
     */
    private function afterExecution()
    {
    }
    /**
     * It execute the methods specified in a list, if one method it is not possible to execute then
     * the method return false.
     * @param array|null $methods It is the list of methods.
     * @return bool It is true if all methods has been execute without problem.
     */
    public function run( $methods = null )
    {
        if( $methods === null )
        {
            return false;
        }
        $res = true;
        $this->_TestCases = $this->getListOfTestCases( $methods );

        foreach( $this->_TestCases as $tc)
        {
            $this->setCurrentTestCase( $tc );
            $tc->setState( $this->callMethod( $tc->getName() ) );
            $res = $res & $tc->isSuccess() ;
            $this->console( $tc ,ConsoleColors::LIGHT_BLUE);

        }
        return $res;
    }

    private function executeTextCaseMethod( $method )
    {
        try {
            if( !method_exists( $this, $method ) )
            {
                return true;
            }
            $this->$method();
        }catch( FailException $ef ){
            $this->setCurrentTestCaseState( TestCaseState::FAILED );
            return false;
        }catch( BlockException $eb ){
            $this->setCurrentTestCaseState( TestCaseState::BLOCKED );
            return false;
        }catch( DeprecatedException $ef ){
            $this->setCurrentTestCaseState( TestCaseState::DEPRECATED );
            return false;
        }catch( \Exception $e ){
            $this->setCurrentTestCaseState( TestCaseState::FAILED );
            return false;
        }
        $this->setCurrentTestCaseState( TestCaseState::PASSED );
        return true;
    }
    /**
     * It execute a method of the current object.
     * @param string $method It is the name of the method.
     * @return bool It is true the method has been executed.
     */
    protected function callMethod( $method ){
        $this->console( "    - TC: " . $method);
        if( !method_exists( $this, $method ) )
        {
            $this->console("        ERROR: The test case [".$method."] not exist.",ConsoleColors::RED);
            return false;
        }
        $this->beforeExecution();
        $this->before();

        $this->$method();


        $this->after();
        $this->afterExecution();
        return true;
    }

    /**
     * It return the list of the test case objects to be executed.
     * @param array $methods It is the list of test cases.
     * @return array It is the list of test case objects.
     */
    protected function getListOfTestCases( $methods )
    {
        $listTC = array();
        if( $methods === null)
        {
            return $listTC;
        }
        $tc = null;
        foreach( $methods as $method )
        {
            $tc = new TestCase();
            $tc->setName( $method );
            $tc->setTestPlanFile( $this->getTestPlanFile() );
            $listTC[] = $tc;

        }
        return $listTC;
    }
}
