<?php
namespace Xi\Validate\Validate;

class ValidateTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        parent::setUp();
        
        $this->validator = new TestValidate();        
    }
    
    public function testHasValueAfterValidating()
    {
        $value = 'value';
     
        $this->validator->isValid($value);
        
        $this->assertEquals($value, $this->validator->value);
    }
    
    public function testHasMessagesIfValidationFails()
    {
        $this->validator->isValid('invalid');
        
        $this->assertEquals(array('Value is not valid'), $this->validator->getErrors());
    }
    
    public function testMessagesAreResetWithEachValidation()
    {
        $this->validator->isValid('invalid');
        $this->validator->isValid('valid');
        
        $this->assertEquals(array(), $this->validator->getErrors());
    }
}