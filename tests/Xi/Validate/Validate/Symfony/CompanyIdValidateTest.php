<?php
namespace Xi\Validate\Validate\Symfony;

class CompanyIdValidateTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->validator = new CompanyIdValidator();
    }
    
    public function testValidationReturnsTrue()
    {
        $constraint = new CompanyId();
        $this->assertTrue($this->validator->isValid('0603539-4', $constraint));
        $this->assertEmpty($this->validator->getMessageTemplate());
    }
    
    public function testValidationReturnsFalse()
    {
        $constraint = new CompanyId();
        $this->assertFalse($this->validator->isValid('1A34567-1', $constraint));
        $this->assertNotEmpty($this->validator->getMessageTemplate());
    }
}