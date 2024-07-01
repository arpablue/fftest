<?php

namespace ArpaBlue\FFTest\Executors;



use ArpaBlue\FFTest\Collections\ClassCaller;
use ArpaBlue\FFTest\FileSystem\FileReader;
use ArpaBlue\FFTest\Logs\LogManager;
use ArpaBlue\FFTest\Tools\FFParameterList;
use ArpaBlue\FFTest\Tools\SystemTools;


class FileExecutorBase extends LogManager
{
    /**
     * @var array It is an array of the files that will be executed.
     */
    protected $_TargetFiles;
    /**
     * @var array It is the list of test cases or methods to be executed.
     */
    protected $_TestCases;
    /**
     * @var FFParameterList It is the list of parameters used to execute the files.
     */
    protected $_Parameters;
    /**
     * @var ClassCaller It is the object to call the methods of a class, it is used to
     * load the class of file and the test method that exists in the class.
     */
    protected $_ClassCaller;
    /**
     * @var bool It is used to detect the methods of the class used to execute test cases.
     */
    protected $_ReadFlag = false;
    /**
     * @var FileReader It is the process to read a file.
     */
    protected $_FileReader;
    /**
     * FileExecutor constructor.
     */
    public function __construct()
    {
        $this->_TestCases = array();
        $this->_Parameters = new FFParameterList();
        $this->init();
    }
    /**
     * It initialize the variable
     */
    private function init()
    {
        // It is the folder or file where the test cases will be executed
        $this->_Parameters->put("target","tests");
        // It is the type of output of the test execution, we have file, console or html.
        $this->_Parameters->put("ouput","file");
        // It is the folder where the test result are created, it is for file output.
        $this->_Parameters->put("result","test_res");
        // It is the reference to the test plan to be executed, this replace the target parameter
        $this->_Parameters->put("tp",null);
    }
    /**
     * @return string It is the path of the file of directory where the test cases will be executed.
     */
    public function getTargetFile()
    {
        return $this->_Parameters->get("target");
    }

    /**
     * It return the list of the php file to be call to execute the test cases.
     * @return array It is the list of file to be executed.
     */
    public function getTargetFiles()
    {
        return $this->_TargetFiles;
    }
    /**
     * @param $argv array It is the list of arguments used to execute the test cases.
     */
    public function setArguments( $argv )
    {
        $this->_Parameters->addParameters( $argv );
    }
    /**
     * It specify the file to be open.
     * @param $file
     */
    public function setFile($file)
    {
        $file = SystemTools::formatPath( $file );
        $this->_Parameters.put( "target", $file);
    }

    /**
     * It return the current file where the classes will be opened.
     * @return string It is the file to be opened.
     */
    public function getFile()
    {
        return $this->getTargetFile();
    }

}