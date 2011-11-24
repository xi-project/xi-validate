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
        $constrait = new SocialSecurityNumber();
        $this->assertTrue($this->validator->isValid('071162-417U', $constrait));
        $this->assertEmpty($this->validator->getMessageTemplate());
    }
    
    public function testValidationReturnsFalse()
    {
        $constrait = new SocialSecurityNumber();
        $this->assertFalse($this->validator->isValid('100385-169D', $constrait));
        $this->assertNotEmpty($this->validator->getMessageTemplate());
    }
    
    public function testValidationReturnsFalseAndCustomMessage()
    {
        $constrait = new SocialSecurityNumber(array('message' => 'custom message'));
        $this->assertFalse($this->validator->isValid('100385-169D', $constrait));
        $this->assertEquals($this->validator->getMessageTemplate(), 'custom message');
    }
}