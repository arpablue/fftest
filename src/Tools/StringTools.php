<?php


namespace ArpaBlue\FFTest\Tools;


class StringTools
{
    /**
     * It verify if the variable is a no empty string or null.
     * @param $str string It is the string to be evaluate.
     * @return bool It is true then the string is valid.
     */
    public static function isValid( $str ){
        if( $str == null ){ return false; }
        if( !is_string( $str ) ){ return false; }
        $str = trim( $str );
        return !empty( $str );
    }

    /**
     * It set on format a string, this means set the string in lower case, remove the blank spaces
     * from the begining and the end pof the string and replace the whit spaces by '_' character.
     * If the target string is null or it is not a string then the function return null;
     * @param $target string It is the string to set on format.
     * @return string|null It is the new string.
     */
    public static function setOnFormat( $target ){
        if( !StringTools::isValid( $target ) ){
            return null;
        }
        $target = trim( $target );
        $target = strtolower( $target );
        $target = str_replace( " ","_",$target);
        return $target;
    }
}