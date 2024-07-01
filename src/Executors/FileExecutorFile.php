<?php
namespace ArpaBlue\FFTest\Executors;

use ArpaBlue\FFTest\Collections\ClassCaller;
use ArpaBlue\FFTest\FileExecutor;
use ArpaBlue\FFTest\FileSystem\FileReader;
use ArpaBlue\FFTest\Interfaces\IBeforeAfter;
use ArpaBlue\FFTest\Interfaces\LineProcessor;
use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;
//use RegexIterator;
//use RecursiveRegexIterator;
use \ArpaBlue\FFTest\Tools\FFParameterList;


class FileExecutorFile extends FileExecutorBase implements IBeforeAfter,LineProcessor
{
    /**
     * It get the PHP files from the directory specified, if no files found in the directory then the array
     * returned will be empty.
     * @return array It is the list of the file into the directory specified.
     */
    protected function getFiles()
    {
        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator( $this->getTargetFile() ));

        $files = array();
        foreach ($iterator as $file) {
            if ($file->isFile() && $file->getExtension() === 'php') {
                $files[] = $file->getPathname();
            }
        }
        return $files;
    }
    /**
     * It execute the verifications before the execution of the test cases, if all verification pass then the method
     * return true.
     * @return bool It is true then all teh verification pass and the execution can be do it.
     */
    function before()
    {
        $this->_TargetFiles = array();

        if( $this->getTargetFile() == null )
        {
            echo "ERROR: The target file or folder is not specified.\n";
            return false;
        }
        if( !file_exists( $this->getTargetFile() ) )
        {
            echo "ERROR: The target file or folder is not exists. File: [".$this->getTargetFile()."]\n";
            return false;
        }
        if( is_file( $this->getTargetFile() ) )
        {
            $this->_TargetFiles[] = $this->getTargetFile();
        }elseif( is_dir( $this->getTargetFile() ) )
        {
            $this->_TargetFiles = $this->getFiles();
        }
        $this->loadFiles();
        return true;
    }
    /**
     * It is called after execute the test cases.
     */
    function after(){}
    /**
     * It load the load the classes specified in the files.
     */
    protected function loadFiles()
    {
        foreach( $this->_TargetFiles as $ken => $value )
        {
            $this->loadClasses( $value );
        }
    }

    /**
     * @var string|null It is the path of the current file to be processed.
     */
    private $_CurrentProcessFile = null;
    /**
     * It load the all classes from a file.
     * @param $filePath string It is the name of the file.
     */
    protected function loadClasses( $filePath )
    {
        if( $this->_FileReader == null )
        {
            $this->_FileReader = new FileReader();
        }
        $this->_CurrentProcessFile = $filePath;
        $this->_FileReader->setFile( $filePath );
        $this->_FileReader->setLineProcessor( $this );
        $this->_FileReader->read();
        if( $this->_ClassCaller !== null )
        {
            $this->_TestCases[] = $this->_ClassCaller;
            $this->_ClassCaller = null;
        }

    }
    private $_CurrentNameSpace;
    /**
     * It process each line.
     */
    function processLine( $line )
    {
        $fname = null;
        if( $line === null )
        {
            return;
        }
        $line = trim( $line );
        if( strpos( $line, "class" ) !== false )
        {
            if( $this->_ClassCaller !== null )
            {
                $this->_TestCases[] = $this->_ClassCaller;
                $this->_ClassCaller = null;
            }
            $this->_ReadFlag = false;
        }
        if( strpos( $line, "namespace" ) !== false )
        {
            $this->_CurrentNameSpace =  trim( str_replace("namespace", "", $line ) ) ;
            $this->_CurrentNameSpace =  str_replace(";", "", $this->_CurrentNameSpace ) ;

        }
        if(
            ( strpos( $line, "extends" ) !== false )
            && ( strpos( $line, "TestSuite" ) !== false )
        )
        {
            $this->_ReadFlag = true;
            $this->_ClassCaller = new ClassCaller();
            $this->_ClassCaller->setName( fileExecutor::getClassName( $line ) );
            $this->_ClassCaller->setNameSpace( $this->_CurrentNameSpace );
            $this->_ClassCaller->setFile( $this->_CurrentProcessFile );
        }
        if(
            ( $this->_ReadFlag )
            && ( strpos( $line, "public" ) !== false )
            && ( strpos( $line, "function" ) !== false )
        )
        {
            $fname = fileExecutor::getFunctionName($line);
            if( ($this->_ClassCaller != null )
                && ( $fname !== null )
                && ( strpos( $fname, "test_" ) === 0) )
            {
                $this->_ClassCaller->addMethod( $fname );
            }
        }
    }
}