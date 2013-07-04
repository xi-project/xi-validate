<?php
namespace Xi\Validate\Validate\Symfony;

class FinnishSocialSecurityNumberValidateTest extends \PHPUnit_Framework_TestCase
{
    private $validator;
    private $context;

    public function setUp()
    {
        $this->context = $this->getMockBuilder('Symfony\Component\Validator\ExecutionContextInterface')
            ->disableOriginalConstructor()
            ->getMock();

        $this->validator = new FinnishSocialSecurityNumberValidator();
        $this->validator->initialize($this->context);
    }
    
    public function testValidationReturnsTrue()
    {
        $constraint = new FinnishSocialSecurityNumber();
        $this->context->expects($this->any())
            ->method('addViolation');
        $this->assertTrue($this->validator->validate('071162-417U', $constraint));
    }
    
    public function testValidationReturnsFalse()
    {
        $constraint = new FinnishSocialSecurityNumber();
        $this->context->expects($this->any())
            ->method('addViolation');
        $this->assertFalse($this->validator->validate('100385-169D', $constraint));
    }
    
    public function testValidationReturnsFalseAndCustomMessage()
    {
        $constraint = new FinnishSocialSecurityNumber(array('message' => 'custom message'));
        $this->context->expects($this->any())
            ->method('addViolation')
            ->with('custom message');
        $this->assertFalse($this->validator->validate('100385-169D', $constraint));
    }
}