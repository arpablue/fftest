<?php


namespace ArpaBlue\FFTest\Tools;


class ClassTools
{
    /**
     * @param $className string It is the name of the instance of the class.
     * @param $target any It is the method to verify that is a instance of FieldElement.
     * @return bool It is true the the target object is an instance of FieldElement
     */
    public static function isThisClass( $className, $target ){
        if( $target == null){ return false; }
        if( $className == null ) { return false; }
        if( gettype( $target ) !== 'object' ){ return false; }
        return ( get_class( $target ) !== $className );

    }
    /**
     * It execute a method that exist in a object, if the method not exist or the object is null then
     * the method return false.
     * @param Object $target It is the object to be used to call the methods.
     * @param string $method It is the name of the method to be calls.
     * @return bool It is true the methods has been called without problems.
     */
    public static function callMethod( $target , $method)
    {
        if( $target === null )
        {
            return false;
        }
        if( $method === null )
        {
            return false;
        }
        if( !method_exists($target , $method))
        {
            return false;
        }
        $target->$method();
        return true;
    }

}