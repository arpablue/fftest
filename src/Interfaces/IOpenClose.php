<?php


namespace ArpaBlue\FFTest\Interfaces;

/**
 * Interface IOpenClose
 * @package ArpaBlue\FFTest\Interfaces
 * It cover the open() and close() methods.
 */
interface IOpenClose
{
    /**
     * It Open action for an action of execution.
     * @return mixed It return an value to evaluate if has been open without problems.
     */
    function open();

    /**
     * It apply a close action.
     * @return mixed The return the action to knows the action has been success.
     */
    function close();
}