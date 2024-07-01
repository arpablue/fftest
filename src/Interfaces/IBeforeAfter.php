<?php

namespace ArpaBlue\FFTest\Interfaces;

interface IBeforeAfter
{
    /**
     *
     * This method is called before execute a main action in the class.
     */
    function before();

    /**
     * This method is called after execute the main method of the class.
     */
    function after();
}