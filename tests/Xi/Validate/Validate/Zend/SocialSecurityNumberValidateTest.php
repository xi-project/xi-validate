<?php
namespace Xi\Validate\Validate\Zend;

class SocialSecurityNumberValidateTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->validator = new SocialSecurityNumberValidate();
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