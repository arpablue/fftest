<?php


namespace ArpaBlue\FFTest\Tools;

use \ArpaBlue\FieldList\FieldList;

class FFParameterList extends FieldList
{

    /**
     * FFParameterList constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->init();
    }

    /**
     * It initialize the parameters used to execute the test cases.
     */
    private function init()
    {
        $this->put("target","test"); // It is the forlder or file where the test cases will be executed.
        $this->put("tes_res","test_result"); // it is the folder where the test result will be raised.
        $this->put("output","file"); // It is the way to present the execution of the test results.
        $this->put("format","txt"); // It is the format of the test result.
        $this->put("tp",null);// It i sthe test plan of the execution.
    }

    /**
     * It return the data in aJSON format abut with a structure to easy to view.
     * @return string It return tha data of the object in a json format.
     */
    public function toJSONnice()
    {
        $res = "{";
        $size = $this->size();
        $flag = false;
        $fields = $this->getArrayOfFields();
        foreach( $fields as $k=>$field )
        {
            if( $flag )
            {
                $res = $res . ',';
            }
            $flag = true;
            $res = $res . "\n    \"".$field->getName()."\":";
            if( $field->getValue() === null){
                $res = $res . "null";
            }else{
                $res = $res . "\"".$field->getValue()."\"";
            }

        }
        $res = $res."\n}";
        return $res;
    }

    /**
     * It return the parameter list in a string.
     * @return string It is the parameter list.
     */
    public function __toString()
    {
        return $this->toJSONnice;
    }
    /**
     * It add a new parameter to the parameters. The format of the line should be name=value
     * @param $line string It is the new parameter to be added.
     * @return bool It is true  a new parameter has been added.
     */
    public function add( $line )
    {
        if($line == null )
        {
            return false;
        }
        $values = explode(  "=", $line);
        if( count( $values ) < 2  )
        {
            return false;
        }
        $this->put( $values[0],$values[1]);
        return true;
    }

    /**
     * It is the list of parameters to be set in the current list of parameters.
     * @param $argv array It is the array of parameters.
     */
    public function addParameters( $argv )
    {
        foreach( $argv as $k=>$v )
        {
            $this->add($v);
        }

    }
}