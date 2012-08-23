<?php
namespace Xi\Validate\Validate\Zend;

class FinnishSocialSecurityNumberValidateTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->validator = new FinnishSocialSecurityNumberValidate();
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