<?php

namespace ArpaBlue\FFTest\FileSystem;


/**
 * Class FileReader
 * @package ArpaBlue\FFTest\FileSystem
 * It open an read a file line by line. For this is necessary pass an object with a public readLine( $line ) process.
 */
class FileReader
{
    /**
     * @var string It is the path of the file that contains the implementation of the path.
     */
    private $_File;
    /**
     * @var bool It verify the file is opne to be read.
     */
    private $_IsOpen;
    /**
     * @var ILineProcesor It is the file that manage the file.
     */
    private $_FileHandle;
    /**
     * @var LineProcessor It is the object to process the line.
     */
    private $_LineProcessor;
    /**
     * FileReader constructor.Default constructor.
     */
    public function __construct()
    {
        $this->_IsOpen = false;
    }
    /**
     * It i sdefault desturctor.
     */
    public function __destruct()
    {
        if( $this->isOpen() )
        {
            $this->close();
        }
    }
    /**
     * It specify the file to be processed.
     * @param $file string It is the file to be processed.
     */
    public function setFile( $file )
    {
        $this->_File = $file;
    }
    /**
     * It return the file to be processed.
     * @return string It is the path of the file to be processed.
     */
    public function getFile()
    {
        return $this->_File;
    }
    /**
     * It specify the object to process the line.
     * @param $lineProcessor ILineProcessor It is the object tp process each line.
     */
    public function setLineProcessor( $lineProcessor )
    {
        $this->_LineProcessor = $lineProcessor;
    }
    /**
     * It return the status of the file to be read.
     * @return bool It is true the file is ready to be read.
     */
    private function isOpen()
    {
        return $this->_IsOpen;
    }

    /**
     * It is open the file to be read.
     * @return bool It is true the file has been opened without problems.
     */
    private function open()
    {
        if( $this->_IsOpen )
        {
            $this->close();
        }
        $this->_IsOpen = false;
        $this->_FileHandle = fopen( $this->getFile(), 'r');

        if( $this->_FileHandle )
        {
            $this->_IsOpen = true;
        }
        return $this->_IsOpen;
    }
    /**
     * It close the file.
     */
    private function close()
    {
        if( $this->isOpen() )
        {
            fclose( $this->_FileHandle );
        }
        $this->_IsOpen = false;
    }
    /**
     * It start the read process of the file where each line the
     * @param null $filePath It is the path of the file where the classes has been implemented.
     * @return bool It is true the file has been read without problems.
     */
    public function read( $filePath = null )
    {
        if( $filePath !== null )
        {
            $this->setFile( $filePath );
        }
        if( !$this->open() )
        {
            return false;
        }
        $this->process();
        $this->close();
        return true;
    }

    /**
     * It is the read process of the file.
     * @return bool It is true the file has been read without problems.
     */
    public function process()
    {
        if ( !$this->isOpen() )
        {
            return false;
        }
        while ( ( $line = fgets( $this->_FileHandle ) ) !== false )
        {
            if( $this->_LineProcessor != null )
            {
                $this->_LineProcessor->processLine( $line );
            }
       }
        return true;
    }
}