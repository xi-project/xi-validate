<?php
namespace Xi\Validate\Validate\Symfony;

class FinnishCompanyIdValidateTest extends \PHPUnit_Framework_TestCase
{
    private $validator;
    private $context;

    public function setUp()
    {
        $this->context = $this->getMockBuilder('Symfony\Component\Validator\ExecutionContextInterface')
            ->disableOriginalConstructor()
            ->getMock();

        $this->validator = new FinnishCompanyIdValidator();
        $this->validator->initialize($this->context);
    }
    
    public function testValidationReturnsTrue()
    {
        $constraint = new FinnishCompanyId();
        $this->context->expects($this->any())
            ->method('addViolation');
        $this->assertTrue($this->validator->validate('0603539-4', $constraint));

    }
    
    public function testValidationReturnsFalse()
    {
        $constraint = new FinnishCompanyId();
        $this->context->expects($this->any())
            ->method('addViolation');
        $this->assertFalse($this->validator->validate('1A34567-1', $constraint));
    }
}