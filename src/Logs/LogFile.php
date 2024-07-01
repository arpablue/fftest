<?php


namespace ArpaBlue\FFTest\Logs;

use ArpaBlue\FFTest\Tools\DateTimeTools;
use ArpaBlue\FFTest\Tools\SystemTools;

class LogFile extends LogConsole
{
    /**
     * @var string It is the path of the log file.
     */
    private $_File;
    public function __construct()
    {
        $this->_File = "activity.log";
        $this->_IsOpen = false;
    }
    /**
     * It return the current log file.
     * @return string It is the path the current log file.
     */
    public function getFile()
    {
        return $this->_File;
    }

    /**
     * It specify the path of the file where the log file will be created. If the directories don't exists
     * then these directories are created.
     * @param string $file It is the path of the log file.
     */
    public function setFile( $file )
    {
        $this->_File = $file;
    }
    /**
     * It prepare the file to write messages, if the file exists then it is deleted to create a new file.
     * @return bool It is true the file is ready to set messages.
     */
    public function open()
    {
        if( $this->isOpen() )
        {
            $this->close();
        }
        $this->_IsOpen = false;
        if( file_exists( $this->_File ) && is_file( $this->_File ) )
        {
            unlink( $this->_File );
        }
        $this->_IsOpen = true;
        return true;
    }

    /**
     * It disable the possibility of the log to raise messages in the files.
     * @return bool It is true then the Log has been closed without problems.
     */
    public function close()
    {
        if( !$this->isOpen() )
        {
            return true;
        }
        $this->_IsOpen = false;
        return true;
    }

    /**
     * It add a new line in the log file.
     * @param string $text It is the text to add to the log file.
     */
    protected function writeln( $text, $color = null)
    {
        if( !$this->isOpen() )
        {
            return;
        }
        if( $text == null )
        {
            $text = '';
        }
        $handle = fopen($this->getFile(), 'a');
        if ($handle) {
            $text = DateTimeTools::getInstant().': '.$text."\n";
            fwrite($handle, $text);
            fclose($handle);
        }
    }

}