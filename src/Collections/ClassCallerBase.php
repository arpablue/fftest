<?php


namespace ArpaBlue\FFTest\Collections;
use ArpaBlue\FFTest\Logs\LogManager;
use ArpaBlue\FFTest\Logs\LogNull;


class ClassCallerBase extends LogManager
{
    /**
     * @var string It is the path of the file where the class exists.
     */
    private $_File;
    /**
     * @var string It is the name of the class.
     */
    private $_Name;
    /**
     * @var array It is the list of the list of the method to be executed. If the list is empty then
     * all methods that start with test_ will be executed.
     */
    private $_Methods;
    private $_NameSpace;
    /**
     * Default constructor.
     */
    public function __construct()
    {
        $this->_Methods = array();
    }

    /**
     * Default destructor.
     */
    public function __destruct(){}

    /**
     * It specify the namespace of the current class.
     * @param string $namespace It is the namespace of the class.
     */
    public function setNameSpace( $namespace )
    {
        $this->_NameSpace = $namespace;
    }
    /**
     * @return string|null It is the namespace of the class.
     */
    public function getNameSpace()
    {
        return $this->_NameSpace;
    }
    /**
     * It specify the path of the file.
     * @param $file string It is the path of the file.
     */
    public function setFile( $file ){ $this->_File = $file; }

    /**
     * It return the path of the path of the file.
     * @return string It is the path of the file-.
     */
    public function getFile()
    {
        return $this->_File;
    }

    /**
     * It specify the name of the class.
     * @param $name string It is the name of the class.
     */
    public function setName( $name ){ $this->_Name = $name; }

    /**
     * It return the name of the class.
     * @return string It return the name of the class.
     */
    public function getName(){ return $this->_Name; }

    /**
     * It return the list of the methods to be called from the class.
     * @return array
     */
    public function getMethods(){ return $this->_Methods; }
    /**
     * It add a method to be executed when the class is called.
     * @param $method string It is the method to be added.
     */
    public function addMethod( $method )
    {
        if( $this->_Methods === null )
        {
            $this->_Methods = array();
        }
        $this->_Methods[] = $method;
    }
    /**
     * It return the data of the object in a JSON format.
     * @return string It is the data of the class with the name of the class.
     */
    public function toJSON()
    {
        $res = "{";
        $res .= "\"type\":\"ClassCaller\",";
        $res .= "\"class\": \"'.$this->getName().'\"";
        $res .= "\"namespace\": \"'.$this->getNameSpace().'\"";
        $res .= "\"file\":\"'.$this->getFile().'\",";
        $res .= "\"methods\":[";
        $flag = false;
        foreach( $this->_Methods as $k=>$met)
        {
            if( $flag )
            {
                $res .= ",";
            }
            $res .= "\"" . $met . "\"";
            $flag = true;
        }
        $res .= "]";
        $res .= "}";
        return $res;
    }
    /**
     * It return the data of the current object in the string with JSON format,
     * this format is to be comprensive to read.
     * @return string It is the data in JSON format.
     */
    public function toJSONnice()
    {
        $res = "{\n";
        $res .= "    \"type\":\"ClassCaller\"\n";
        $res .= "    \"class\": \"" . $this->getName() . "\",\n";
        $res .= "    \"namespace\": \"" . $this->getNameSpace() . "\",\n";
        $res .= "    \"file\":\"" . $this->getFile() . "\",\n";
        $res .= "    \"methods\":[";
        $flag = false;
        foreach( $this->_Methods as $k=>$met)
        {
            if( $flag )
            {
                $res .= ",";
            }
            $res .= "\n        \"" . $met . "\"";
            $flag = true;
        }
        $res .= "\n    ]\n";
        $res .= "}";
        return $res;
    }
    public function __toString()
    {
        return $this->toJSONnice();
    }

}