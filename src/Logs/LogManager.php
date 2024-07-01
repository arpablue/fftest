<?php


namespace ArpaBlue\FFTest\Logs;



/**
 * Class LogObj
 * @package ArpaBlue\FFTest\Logs
 * It is a class used to manage a a Logger of a log object ot send message.
 */
abstract class LogManager
{
    /**
     * @var LogObj It is the log used to raise messages.
     */
    private static $LOG = null;
    /**
     * It return the log object used to raise messages.
     * @return LogObj It is the log object to be used.
     */
    public static function getLog()
    {
        if( LogManager::$LOG === null )
        {
            LogManager::$LOG = new LogFile();
        }
        return LogManager::$LOG;
    }

    /**
     * It open the log object to raise messages.
     */
    protected function open()
    {
        return LogManager::getLog()->open();
    }

    /**
     * It close the log object, it is not possible raise messages in the log file.
     */
    protected function close()
    {
        return LogManager::getLog()->close();
    }
    /**
     * It specify the log object to be used to raise the message.
     * @param $log LogObj It is the Log object to be used.
     */
    public static function setLog( $log )
    {
        if( LogManager::$LOG !== null)
        {
            LogManager::getLog()->close();
        }
        LogManager::$LOG = $log;
    }
    /**
     * It write a message int he console
     * @param string $msg It is the message to display in the console.
     * @param string $color It is the color of the text.
     * @return bool It is true the message has been displayed.
     */
    protected function console($msg, $color = null )
    {
        LogManager::getLog()->console( $msg, $color );
        return true;
    }
    /**
     * It raise the text message in the log file.
     * @param string $msg It is the message to be raise in the log object.
     */
    protected function log( $msg = "" )
    {
        LogManager::getLog()->log( $msg );
        return true;
    }
    /**
     * It raise the text message in the log file.
     * @param string $msg It is the message to be raise in the log object.
     */
    protected function action( $msg = "" )
    {
        LogManager::getLog()->action( $msg );
        return true;
    }
    /**
     * It show a message as TITLE.
     * @param string $msg It is the message to be raise in the log object.
     */
    protected function title( $msg = "" )
    {
        LogManager::getLog()->title( $msg );
        return true;
    }
    /**
     * It show a message as a INFO message.
     * @param string $msg It is the message to be raise in the log object.
     */
    protected function info( $msg = "" )
    {
        LogManager::getLog()->info( $msg );
        return true;
    }
    /**
     * It show a message as a MESSAGE message.
     * @param string $msg It is the message to be raise in the log object.
     */
    protected function message( $msg = "" )
    {
        LogManager::getLog()->message( $msg );
        return true;
    }
    /**
     * It show a message as a WARNING message.
     * @param string $msg It is the message to be raise in the log object.
     */
    protected function warning( $msg = "" )
    {
        LogManager::getLog()->warning( $msg );
        return true;
    }
    /**
     * It show a message as a SUCCESS message.
     * @param string $msg It is the message to be raise in the log object.
     */
    protected function success( $msg = "" )
    {
        LogManager::getLog()->success( $msg );
        return true;
    }
    /**
     * It show a message as a ERROR message.
     * @param string $msg It is the message to be raise in the log object.
     */
    protected function error( $msg = "" )
    {
        LogManager::getLog()->error( $msg );
        return true;
    }
    /**
     * It show a message as a FAIL message.
     * @param string $msg It is the message to be raise in the log object.
     */
    protected function fail( $msg = "" )
    {
        LogManager::getLog()->fail( $msg );
        return true;
    }
    /**
     * It show a message as a PASS message.
     * @param string $msg It is the message to be raise in the log object.
     */
    protected function pass( $msg = "" )
    {
        LogManager::getLog()->pass( $msg );
        return true;
    }

}