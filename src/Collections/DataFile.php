<?php


namespace ArpaBlue\FFTest\Collections;

/**
 * Class DataFile
 * @package ArpaBlue\FFTest\Collections
 * It contains the data of the file to be instantiated and the method to be called.
 */
class DataFile
{
    /**
     * @var string|null It is the filed of the classes to be called.
     */
    private $_File;
    /**
     * @var array It is the list of methods to be called.
     */
    private $_Methods;
    /**
     * DataFile constructor.
     */
    public function __construct( $file = null ){
        $this->setFile( $file );
        $this->_Methods = array();
    }
    /**
     * It specify the target file.
     * @param $file string It is the path of the file to be instantiated.
     */
    public function setFile( $file ){
        if( $this->isValid( $file ) ) {
            $this->_File = trim( $file );
            return;
        }
        $this->_File = null;

    }
    /**
     * It verify if the variable is a no empty string.
     * @param $str string It is the string to be evaluate.
     * @return bool It is true then the string is valid.
     */
    protected function isValid( $str ){
        if( $str == null ){ return false; }
        if( !is_string( $str ) ){ return false; }
        $str = trim( $str );
        return !empty( $str );
    }
    /**
     * It add the method to be called of the call.
     * @param $method string It is the name of he method to be called.
     */
    public function add( $method ){
        if( !$this->isValid( $method ) ){ return false; }
        $this->_Methods[] = trim( $method );
        return true;
    }
    /**
     * It return the list of the methods.
     * @return array It is the list of methods.
     */
    public function getMethodList(){
         return $this->_Methods;
    }
    /**
     * It verify if the list of method is not emty or null.
     * @return bool It is true if the list of methods is not empty.
     */
    public function isMethodListIsEmpty(){
        if( $this->_Methods == null ){ return false; }
        return (count( $this->_Methods ) > 0);
    }
    /**
     * It return the current data of the object in a string with json format.
     * If the method list is empty or null then it is specified as [] in the format.
     * If the file is not specified then the this method return a empty string.
     * @return string It is the string with the dat of the object in json format.
     */
    public function toJSON()
    {
        if( $this->_File == null ){ return "";}
        $res = [
          "file" => $this->_File,
          "methods" => $this->_Methods
        ];
        return json_encode( $res );
    }
    public function __toString(){ return $this->toJSON();}
}
