<?php
namespace Xi\Validate\Validate\Symfony;

class FinnishSocialSecurityNumberValidateTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->validator = new FinnishSocialSecurityNumberValidator();
    }
    
    public function testValidationReturnsTrue()
    {
        $constraint = new FinnishSocialSecurityNumber();
        $this->assertTrue($this->validator->isValid('071162-417U', $constraint));
        $this->assertEmpty($this->validator->getMessageTemplate());
    }
    
    public function testValidationReturnsFalse()
    {
        $constraint = new FinnishSocialSecurityNumber();
        $this->assertFalse($this->validator->isValid('100385-169D', $constraint));
        $this->assertNotEmpty($this->validator->getMessageTemplate());
    }
    
    public function testValidationReturnsFalseAndCustomMessage()
    {
        $constraint = new FinnishSocialSecurityNumber(array('message' => 'custom message'));
        $this->assertFalse($this->validator->isValid('100385-169D', $constraint));
        $this->assertEquals($this->validator->getMessageTemplate(), 'custom message');
    }
}