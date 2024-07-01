<?php


namespace ArpaBlue\FFTest\Logs;


use ArpaBlue\FFTest\Tools\ConsoleColors;

class LogConsole extends LogNull
{
    /**
     * It write a message in the console with a specific color.
     * @param string $msg It is the message displayed in the console.
     * @param string|null $color It is the color used to display in the console.
     */
    protected function writeln( $msg, $color = null )
    {
        if( !$this->isOpen() )
        {
            return;
        }
        $this->console( $msg, $color );
    }

    /**
     * @inheritDoc
     */
    public function log($msg = "")
    {
        $this->writeln( "      ".$msg );
    }
    /**
     * @inheritDoc
     */
    public function step($msg = "")
    {
        $this->writeln( 'STEP: '.$msg, ConsoleColors::LIGHT_GRAY );
    }
    /**
     * @inheritDoc
     */
    public function action($msg = "")
    {
        $this->writeln( '    ACTION: '.$msg, ConsoleColors::LIGHT_BLUE );
    }
    /**
     * @inheritDoc
     */
    public function title($msg = "")
    {
        $this->writeln( '===================== TITLE: '.$msg . '=====================', ConsoleColors::YELLOW );
    }
    /**
     * @inheritDoc
     */
    public function info($msg = "")
    {
        $this->writeln( '  INFO: '.$msg, ConsoleColors::LIGHT_YELLOW );
    }
    /**
     * @inheritDoc
     */
    public function message($msg = "")
    {
        $this->writeln( '  MESSAGE: '.$msg, ConsoleColors::RESET );
    }
    /**
     * @inheritDoc
     */
    public function warning($msg = "")
    {
        $this->writeln( '  WARNING: '.$msg, ConsoleColors::ORANGE );
    }
    /**
     * @inheritDoc
     */
    public function success($msg = "")
    {
        $this->writeln( '  SUCCESS: '.$msg, ConsoleColors::LIGHT_GREEN );
    }
    /**
     * @inheritDoc
     */
    public function error($msg = "")
    {
        $this->writeln( '  ERROR: '.$msg, ConsoleColors::PINK );
    }
    /**
     * @inheritDoc
     */
    public function fail($msg = "")
    {
        $this->writeln( '  FAIL: '.$msg , ConsoleColors::RED);
    }
    /**
     * @inheritDoc
     */
    public function pass($msg = "")
    {
        $this->writeln( '  PASS: '.$msg , ConsoleColors::GREEN);
    }

}