<?php


namespace ArpaBlue\FFTest\Interfaces;

/**
 * Interface LineProcessor
 * @package ArpaBlue\FFTest\Interfaces
 * This interface has the method to process line.
 */
interface LineProcessor
{
    /**
     * @param $line string It is hte line to be process.
     * @return null It no return values.
     */
    function processLine( $line );
}