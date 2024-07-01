<?php
namespace ArpaBlue\FFTest;

use ArpaBlue\FFTest\Collections\ClassCaller;
use ArpaBlue\FFTest\FileSystem\FileReader;
use ArpaBlue\FFTest\Interfaces\LineProcessor;

use ArpaBlue\FFTest\Executors\FileExecutorFile;
use ArpaBlue\FFTest\Tools\SystemTools;

/**
 * Class FileExecutor It execute a file
 */
class FileExecutor extends FileExecutorFile
{
    ///////////////////////////// STATIC METHODS ////////////////////////////////////
    /**
     * It return the name of a class from the string.
     * @param $line string It is the line that contains the name of the class.
     * @return mixed|null it is the name of the class.
     */
    public static function getClassName($line)
    {
        if (preg_match('/class\s+([a-zA-Z_\x80-\xff][a-zA-Z0-9_\x80-\xff]*)/', $line, $matches)) {
            return $matches[1];
        }
        return null;
    }
    /**
     * It return the name of the function.
     * @param $line string It is the line contains the name of the function.
     * @return mixed|null It is the name of the function.
     */
    public function getFunctionName($line)
    {
        if (preg_match('/public\s+function\s+([a-zA-Z_\x80-\xff][a-zA-Z0-9_\x80-\xff]*)\s*\(/', $line, $matches)) {
            return $matches[1];
        }
        return null;
    }
    /**
     * It print the content of an array.
     * @param $target array It is the array to be print in the console.
     */
    public static function writeArray( $target )
    {
        if( $target == null)
        {
            echo "\nArray is null";
        }
        echo "\n---------------------- Array ---------------";
        foreach($target as $k => $v)
        {
            echo "\n   - ".$k." -> ".$v;
        }
        echo "\n--------------------------------------------";
    }
    /////////////////////////////////////////////////////////////////////////////////
    /**
     * It is the reference to the file to be executed, if the file is null then the
     * file executed is the specified for the setFile() method.
     * @param string $file It is the file that contains the test cases.
     */
    public function run( $file = null)
    {
        if( $file != null ){
            $this->setFile( $file );
        }
        if( !$this->before()){
            return false;
        }
        $this->call();
        $this->after();
        return true;
    }
    /**
     * It execute the object specified in the files.
     */
    protected function call()
    {
        foreach( $this->_TargetFiles as $lib ) {
            $lib = SystemTools::getAbsolutePath($lib);
            if ($lib !== null)
            {
                $this->action("Loading Lib: " . $lib);
                include_once($lib);
            }
            //************ add the name spaces of the classes. *****************
        }
        $obj = null;
        foreach( $this->_TestCases as $testObj )
        {
            $testObj->call();
        }
    }

}