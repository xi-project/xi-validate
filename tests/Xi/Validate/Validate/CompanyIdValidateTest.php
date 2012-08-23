<?php
namespace Xi\Validate\Validate;

class CompanyIdValidateTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->validator = new CompanyIdValidate();
    }
    
    public function testValidationFailsIfValueIsNotString()
    {
        $this->assertFalse($this->validator->isValid(array('not a string')));                    
        $this->assertEquals(array(CompanyIdValidate::MSG_STRING), $this->validator->getErrors());
    }
    
    public function testValidationFailsIfLengthIsNotValid()
    {
        $this->assertFalse($this->validator->isValid('071162-1'));                    
        $this->assertEquals(array(CompanyIdValidate::MSG_FORMAT), $this->validator->getErrors());
    }
    
    public function testValidationFailsIfDashIsNotPresent()
    {
        $this->assertFalse($this->validator->isValid('071162111'));                    
        $this->assertEquals(array(CompanyIdValidate::MSG_FORMAT), $this->validator->getErrors());
    }
    
    public function testValidationFailsIfPartsAreNotNumeroc()
    {
        $this->assertFalse($this->validator->isValid('123S567-B'));                    
        $this->assertEquals(array(CompanyIdValidate::MSG_FORMAT), $this->validator->getErrors());
    }
    
    /**
     * @test
     * @dataProvider validDataProvider
     */
    public function testValidationReturnsTrue($companyId)
    {
        $this->assertTrue($this->validator->isValid($companyId));
        $this->assertEmpty($this->validator->getErrors());
    }

    /**
     * @test
     * @dataProvider invalidDataProvider
     */
    public function testValidationReturnsFalse($companyId)
    {
        $this->assertFalse($this->validator->isValid($companyId));
        $this->assertNotEmpty($this->validator->getErrors());
    }

    /**
     * @return array
     */
    public function validDataProvider()
    {
        return array(
            array('0603539-4'),
            array('1721415-2'),
            array('0905477-7'),
            array('2205075-4'),
            array('2064267-6') 
        );
    }

    /**
     * @return array
     */
    public function invalidDataProvider()
    {
        return array(
            array('1234567-A'),
            array('123456789'),
            array('1A34567-1'),
            array(array('Not a string')),
        );
    }
}