<?php


namespace ArpaBlue\FFTest\TestObjs;


use ArpaBlue\FFTest\Logs\LogFile;

class TestSuiteDTO extends LogFile
{
    /**
     * @var string It is the path of the test plan suite.
     */
    private $_TpFile;
    /**
     * It specify is the test suite file of the current test suite.
     * @param string $pathFile It is the file of the test suite.
     */
    public function setTestPlanFile( $pathFile )
    {
        $this->_TpFile = $pathFile;
    }

    /**
     * It return the path of the file where the test plan exists.
     * @return string It is the path of the test plan file.
     */
    public function getTestPlanFile()
    {
        return $this->_TpFile;
    }
}