<?php


namespace ArpaBlue\FFTest\Tools;


class TestCasesState
{
    /**
     * It are the state of the test cases.
     */
    const PENDING = 0;
    const IN_PROGRESS = 1;
    const PASSED = 3;
    const FAILED = 4;
    const BLOCKED = 5;
    const DEPRECATED = 6;
    const TO_DEV = 7;

}