<?php


namespace ArpaBlue\FFTest\TestObjs;

use ArpaBlue\FFTest\TestCaseException\PassException;
use ArpaBlue\FFTest\TestCaseException\FailException;
use ArpaBlue\FFTest\TestCaseException\BlockException;
use ArpaBlue\FFTest\TestCaseException\DeprecatedException;


class TestSuiteExceptions extends TestSuiteBA
{
    public function pass( $message = null )
    {
        if( $message == null)
        {
            parent::pass();
            throw new PassException();
            return;
        }
        parent::pass( $message );
        throw new PassException( $message );
    }
    public function fail( $message = null )
    {
        if( $message == null)
        {
            throw new FailException();
            return;
        }
        parent::fail( $message );
        throw new FailException( $message );

    }
    public function block( $message = null )
    {
        if( $message == null)
        {
            parent::block();
            throw new BlockException();
            return;
        }
        parent::block( $message );
        throw new BlockException( $message );

    }
    public function Deprecate( $message = null )
    {
        if( $message == null)
        {
            throw new DeprecatedException();
            return;
        }
        throw new DeprecatedException( $message );

    }
}