<?php


namespace ArpaBlue\FFTest\TestObjs;

use ArpaBlue\FFTest\Tools\TestCasesState;

/**
 * Class TestCaseDTO
 * @package ArpaBlue\FFTest\TestObjs
 * This contains the basic methods for the test case.
 */
class TestCaseDTO
{
    /**
     * @var string It is the name of the test case
     */
    private $_Name;
    /**
     * @var int It is the state of the test case.
     */
    private $_State = TestCasesState::PENDING;
    /**
     * @var string It is the final message of the test case.
     */
    private $_Message;
    /**
     * @var string It is the path fo the file related to the test case.
     */
    private $_TestPlanFile;

    /**
     * It verify if the current test case has a PASS state.
     * @return bool It is true if the state of the test case is PASS.
     */
    public function isSuccess()
    {
        return ( $this->getState() === TestCasesState::PASS );
    }
    /**
     * It is the path of file related to the test case to write the activity of the test case.
     * @param string $file It is the path of the file.
     */
    public function setTestPlanFile($file )
    {
        $this->_TestPlanFile = $file;
    }
    /**
     * @return string It is the path related to the test case.
     */
    public function getTestPlanFile()
    {
        return $this->_TestPlanFile;
    }
    /**
     * It specify the name og the test case.
     * @param string $name It is the name of the test case.
     */
    public function setName( $name )
    {
        $this->_Name = $name;
    }
    /**
     * @return string It is the name of the test case.
     */
    public function getName()
    {
        return $this->_Name;
    }
    /**
     * It specify the name og the test case.
     * @param int $state It is the name of the test case.
     */
    public function setState( $state )
    {
        $this->_State = $state;
    }
    /**
     * @return string It is the name of the test case.
     */
    public function getState()
    {
        return $this->_State;
    }
    /**
     * It specify the name og the test case.
     * @param string $name It is the name of the test case.
     */
    public function setMessage( $message )
    {
        $this->_Message = $message;
    }
    /**
     * @return string It is the name of the test case.
     */
    public function getMessage()
    {
        return $this->_Message;
    }
    /**
     * It return the data of the current test case in a JSON format.
     * @return string It is the data of the current test case.
     */
    public function toJSON()
    {
        $res = "{";
        if( $this->getName() === null  )
        {
            $res = $res . "\"testcase\":null,";
        }else{
            $res = $res . "\"testcase\":\"" . $this->getName() . "\",";
        }

        if( $this->getName() === null  )
        {
            $res = $res . "\"state\":null,";
        }else{
            $res = $res . "\"state\":\"" . $this->getState() . "\",";

        }
        if( $this->getName() === null  )
        {
            $res = $res . "\"message\":null,";
        }else{
            $res = $res . "\"message\":\"" . $this->getMessage() . "\",";
        }

        if( $this->getName() === null  )
        {
            $res = $res . "\"tpfile\":null,";
        }else{
            $res = $res . "\"tpfile\":\"" . $this->getTestPlanFile() . "\",";
        }
        $res =  $res . "}";
        return $res;
    }
    /**
     * It return the data of the current test case in a JSON format.
     * @return string It is the data of the current test case.
     */
    public function toJSONnice()
    {
        $res = "{\n";
        if( $this->getName() === null  )
        {
            $res = $res . "    \"testcase\":null,\n";
        }else{
            $res = $res . "    \"testcase\":\"" . $this->getName() . "\",\n";
        }

        if( $this->getState() === null  )
        {
            $res = $res . "    \"state\":null,\n";
        }else{
            $res = $res . "    \"state\":\"" . $this->getState() . "\",\n";

        }
        if( $this->getMessage() === null  )
        {
            $res = $res . "    \"message\":null,\n";
        }else{
            $res = $res . "    \"message\":\"" . $this->getMessage() . "\",\n";
        }

        if( $this->getTestPlanFile() === null  )
        {
            $res = $res . "    \"tpfile\":null\n";
        }else{
            $res = $res . "    \"tpfile\":\"" . $this->getTestPlanFile() . "\"\n";
        }
        $res =  $res . "}";
        return $res;
    }
    public function __toString()
    {
        return $this->toJSONnice();
    }
}