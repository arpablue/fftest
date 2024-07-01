<?php


namespace ArpaBlue\FFTest\TestObjs;

/**
 * Class TestSuiteBA
 * @package ArpaBlue\FFTest\TestObjs
 * It contains the method related to the execution of the
 */
class TestSuiteBA extends TestSuiteDTO
{
    /**
     * This method is called before execute all test cases of the current class.
     * This method has the objective to prepare all the resources necessary for the execution of the test cases.
     * It this is used to verify requirements it is possible stop the execution of all test plan calling to fail()
     * method.
     */
    public function beforeAll(){}
    /**
     * This method is called after execute all test cases of the test plan. It is used to release the resources
     * associated to the execution of the test plan.
     */
    public function afterAll(){}
    /**
     * This method is called before execute each test cases, it is used to prepare the environment for the execution
     * or it do the verifications of the requirements of the execution. It is possible avoid the execution of the
     * current test case using the fail() or block() methods, this set the state of the test case as FAIL or BLOCK.
     */
    public function before(){}
    /**
     * This method is called after the execution of each test case ois used to release resources after the
     * execution of the test case.
     */
    public function after(){}
}