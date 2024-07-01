<?php


namespace ArpaBlue\FFTest\Logs;


use ArpaBlue\FFTest\Interfaces\ILog;

abstract class LogObj implements ILog
{
    /**
     * @var string It is the path of the log file.
     */
    private $_LogFilePath;
    /**
     * It specify the path of the log file where the messages will be created.
     * @param string $pathFile It is the path file of yhr log file.
     */
    public function setLogFile( $pathFile )
    {
        $this->_PathFile = $pathFile;
    }
    /**
     * It return the path of the log file.
     * @return string It is the path log file.
     */
    public function getLogFile()
    {
        return $this->_LogFilePath;
    }
    /**
     * @var bool It specify the status of the log.
     */
    protected $_IsOpen = false;
    /////////////////////////////// ABSTRACT MESSAGE ///////////////////////////

    /**
     * It prepare the log object to raise messages.
     * @return bool It is true the log is ready to raise messages.
     */
    public abstract function open();

    /**
     * It close and release all resources used to send messages in the log.
     * @return bool It is true the log not raise messages.
     */
    public abstract function close();
    ////////////////////////////////////////////////////////////////////////////

    /**
     * It return the current status of the log to raise messages.
     * @return bool It is true the log object is ready to raise a messages.
     */
    public function isOpen()
    {
        if( $this->_IsOpen === null ){
            $this->_IsOpen = false;
        }
        return $this->_IsOpen;
    }

}