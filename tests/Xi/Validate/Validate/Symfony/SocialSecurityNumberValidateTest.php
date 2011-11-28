<?php
namespace Xi\Validate\Validate\Symfony;

class SocialSecurityNumberValidateTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->validator = new SocialSecurityNumberValidator();
    }
    
    public function testValidationReturnsTrue()
    {
        $constraint = new SocialSecurityNumber();
        $this->assertTrue($this->validator->isValid('071162-417U', $constraint));
        $this->assertEmpty($this->validator->getMessageTemplate());
    }
    
    public function testValidationReturnsFalse()
    {
        $constraint = new SocialSecurityNumber();
        $this->assertFalse($this->validator->isValid('100385-169D', $constraint));
        $this->assertNotEmpty($this->validator->getMessageTemplate());
    }
    
    public function testValidationReturnsFalseAndCustomMessage()
    {
        $constraint = new SocialSecurityNumber(array('message' => 'custom message'));
        $this->assertFalse($this->validator->isValid('100385-169D', $constraint));
        $this->assertEquals($this->validator->getMessageTemplate(), 'custom message');
    }
}