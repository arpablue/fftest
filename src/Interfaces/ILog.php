<?php


namespace ArpaBlue\FFTest\Interfaces;


interface ILog
{
    /**
     * It open the log object or raise messages, initialise the necessary resources to manage the log.
     * @return bool It is true the log is ready to raise messages.
     */
    function open();

    /**
     * It close the log object to not raise more messages and release any resource associate to the lof object.
     * @return bool It is true the log has been close without problems.
     */
    function close();
    /**
     * It raise the text message in the log file.
     * @param string $msg It is the message to be raise in the log object.
     */
    function log( $msg = "" );
    /**
     * It raise the text message in the log file with the action tag.
     * @param string $msg It is the message to be raise in the log object.
     */
    function action( $msg = "" );
    /**
     * It raise the text message in the log file with th step tag.
     * @param string $msg It is the message to be raise in the log object.
     */
    function step( $msg = "" );
    /**
     * It show a message in the terminal, it avoid the normal output of the log object.
     * @param string $msg It is the message to be raise in the log object.
     */
    function console($msg = "" , $color = null);
    /**
     * It show a message as TITLE.
     * @param string $msg It is the message to be raise in the log object.
     */
    function title( $msg = "" );
    /**
     * It show a message as a INFO message.
     * @param string $msg It is the message to be raise in the log object.
     */
    function info( $msg = "" );
    /**
     * It show a message as a MESSAGE message.
     * @param string $msg It is the message to be raise in the log object.
     */
    function message( $msg = "" );
    /**
     * It show a message as a WARNING message.
     * @param string $msg It is the message to be raise in the log object.
     */
    function warning( $msg = "" );
    /**
     * It show a message as a SUCCESS message.
     * @param string $msg It is the message to be raise in the log object.
     */
    function success( $msg = "" );
    /**
     * It show a message as a ERROR message.
     * @param string $msg It is the message to be raise in the log object.
     */
    function error( $msg = "" );
    /**
     * It show a message as a FAIL message.
     * @param string $msg It is the message to be raise in the log object.
     */
    function fail( $msg = "" );

    /**
     * It show a message as a PASS message.
     * @param string $msg It is the message to be raise in the log object.
     */
    function pass( $msg = "" );
}