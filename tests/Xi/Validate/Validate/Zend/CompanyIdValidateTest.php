<?php
namespace Xi\Validate\Validate\Zend;

class CompanyIdValidateTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->validator = new CompanyIdValidate();
    }
    
    public function testValidationReturnsTrue()
    {
        $this->assertTrue($this->validator->isValid('0603539-4'));
        $this->assertEmpty($this->validator->getErrors());
    }
    
    public function testValidationReturnsFalse()
    {
        $this->assertFalse($this->validator->isValid('1A34567-1'));
        $this->assertNotEmpty($this->validator->getErrors());
    }
}