<?php
namespace Xi\Validate\Validate;

class SocialSecurityNumberValidateTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->validator = new SocialSecurityNumberValidate();
    }
    
    public function testValidationFailsIfValueIsNotString()
    {
        $this->assertFalse($this->validator->isValid(array('not a string')));                    
        $this->assertEquals(array(SocialSecurityNumberValidate::MSG_STRING), $this->validator->getErrors());
    }
    
    public function testValidationFailsIfLengthIsNotValid()
    {
        $this->assertFalse($this->validator->isValid('071162-417'));                    
        $this->assertEquals(array(SocialSecurityNumberValidate::MSG_LENGTH), $this->validator->getErrors());
    }
    
    public function testValidationFailsIfCenturyIsNotValid()
    {
        $this->assertFalse($this->validator->isValid('071162?417U'));                    
        $this->assertEquals(array(SocialSecurityNumberValidate::MSG_CENTURY), $this->validator->getErrors());
    }
    
    public function testValidationFailsIfDateIsNotValid()
    {
        $this->assertFalse($this->validator->isValid('071362-417U'));                    
        $this->assertEquals(array(SocialSecurityNumberValidate::MSG_DATE), $this->validator->getErrors());
    }
    
    public function testValidationFailsIfIdentIsNotValid()
    {
        $this->assertFalse($this->validator->isValid('071162-900U'));                    
        $this->assertEquals(array(SocialSecurityNumberValidate::MSG_IDENT), $this->validator->getErrors());
    }
    
    public function testValidationFailsIfHashIsNotValid()
    {
        $this->assertFalse($this->validator->isValid('071162-466U'));                    
        $this->assertEquals(array(SocialSecurityNumberValidate::MSG_HASH), $this->validator->getErrors());
    }
    
    public function testValidationReturnsTrue()
    {
        $this->assertTrue($this->validator->isValid('071162-417U'));
        $this->assertEmpty($this->validator->getErrors());
    }
    
    public function testValidationReturnsFalse()
    {
        $this->assertFalse($this->validator->isValid('100385-169D'));
        $this->assertNotEmpty($this->validator->getErrors());
    }
}