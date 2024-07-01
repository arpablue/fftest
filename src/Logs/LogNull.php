<?php


namespace ArpaBlue\FFTest\Logs;

use ArpaBlue\FFTest\Tools\ConsoleColors;

/**
 * Class LogNull
 * @package ArpaBlue\FFTest\Logs
 * It is a default log, this not raise messages in any log, only the println() method raise messages in the console.
 */
class LogNull extends LogObj
{
    /**
     * It is the default color according of the console.
     */
    const RESET_COLOR = ConsoleColors::RESET;

    /**
     * LogNull constructor.
     */
    public function __construct()
    {
        $this->_IsOpen = true;
        $this->_CurrentColor = ConsoleColors::RESET;
    }
    /**
     * @inheritDoc
     */
    public function open()
    {
        return true;
    }
    /**
     * @inheritDoc
     */
    public function close()
    {
        return true;
    }
    /**
     * @inheritDoc
     */
    public function console($msg = "", $color = null)
    {
        if( $color !== null )
        {
            echo $color.$msg.LOGNULL::RESET_COLOR."\n";
        }else{
            echo $msg."\n";
        }
    }
    /**
     * @inheritDoc
     */
    public function log($msg = ""){}
    /**
     * @inheritDoc
     */
    public function action($msg = ""){}
    /**
     * @inheritDoc
     */
    public function step($msg = ""){}
    /**
     * @inheritDoc
     */
    public function title($msg = ""){}
    /**
     * @inheritDoc
     */
    public function info($msg = ""){}
    /**
     * @inheritDoc
     */
    public function message($msg = ""){}
    /**
     * @inheritDoc
     */
    public function warning($msg = ""){}
    /**
     * @inheritDoc
     */
    public function success($msg = ""){}
    /**
     * @inheritDoc
     */
    public function error($msg = ""){}
    /**
     * @inheritDoc
     */
    public function fail($msg = ""){}
    /**
     * @inheritDoc
     */
    public function pass($msg = ""){}
}