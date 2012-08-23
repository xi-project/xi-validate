<?php
namespace Xi\Validate\Validate\Symfony;

class FinnishCompanyIdValidateTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->validator = new FinnishCompanyIdValidator();
    }
    
    public function testValidationReturnsTrue()
    {
        $constraint = new FinnishCompanyId();
        $this->assertTrue($this->validator->isValid('0603539-4', $constraint));
        $this->assertEmpty($this->validator->getMessageTemplate());
    }
    
    public function testValidationReturnsFalse()
    {
        $constraint = new FinnishCompanyId();
        $this->assertFalse($this->validator->isValid('1A34567-1', $constraint));
        $this->assertNotEmpty($this->validator->getMessageTemplate());
    }
}