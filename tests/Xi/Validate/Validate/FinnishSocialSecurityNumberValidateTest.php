<?php
namespace Xi\Validate\Validate;

class FinnishSocialSecurityNumberValidateTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->validator = new FinnishSocialSecurityNumberValidate();
    }
    
    public function testValidationFailsIfValueIsNotString()
    {
        $this->assertFalse($this->validator->isValid(array('not a string')));                    
        $this->assertEquals(array(FinnishSocialSecurityNumberValidate::MSG_STRING), $this->validator->getErrors());
    }
    
    public function testValidationFailsIfLengthIsNotValid()
    {
        $this->assertFalse($this->validator->isValid('071162-417'));                    
        $this->assertEquals(array(FinnishSocialSecurityNumberValidate::MSG_LENGTH), $this->validator->getErrors());
    }
    
    public function testValidationFailsIfCenturyIsNotValid()
    {
        $this->assertFalse($this->validator->isValid('071162?417U'));                    
        $this->assertEquals(array(FinnishSocialSecurityNumberValidate::MSG_CENTURY), $this->validator->getErrors());
    }
    
    public function testValidationFailsIfDateIsNotValid()
    {
        $this->assertFalse($this->validator->isValid('311249+417U'));
        $this->assertEquals(array(FinnishSocialSecurityNumberValidate::MSG_DATE), $this->validator->getErrors());
        
        $this->assertFalse($this->validator->isValid('071362-417U'));                    
        $this->assertEquals(array(FinnishSocialSecurityNumberValidate::MSG_DATE), $this->validator->getErrors());
    }
    
    public function testValidationFailsIfIdentIsNotValid()
    {   
        $this->assertFalse($this->validator->isValid('071162-000U'));        
        $this->assertEquals(array(FinnishSocialSecurityNumberValidate::MSG_IDENT), $this->validator->getErrors());
        
        $this->assertFalse($this->validator->isValid('071162-001U'));
        $this->assertEquals(array(FinnishSocialSecurityNumberValidate::MSG_IDENT), $this->validator->getErrors());
    }
    
    public function testValidationFailsIfHashIsNotValid()
    {
        $this->assertFalse($this->validator->isValid('071162-466U'));                    
        $this->assertEquals(array(FinnishSocialSecurityNumberValidate::MSG_HASH), $this->validator->getErrors());
    }
    
    /**
     * @test
     * @dataProvider validDataProvider
     */
    public function testValidationReturnsTrue($socialSecurityNumber)
    {
        $this->assertTrue($this->validator->isValid($socialSecurityNumber));
        $this->assertEmpty($this->validator->getErrors());
    }

    /**
     * @test
     * @dataProvider invalidDataProvider
     */
    public function testValidationReturnsFalse($socialSecurityNumber)
    {
        $this->assertFalse($this->validator->isValid($socialSecurityNumber));
        $this->assertNotEmpty($this->validator->getErrors());
    }

    /**
     * @return array
     */
    public function validDataProvider()
    {
        return array(
            array('071162-999L'),
            array('071162-417U'),
            array('071162-417u'),
            array('010204A082X'),
            array('010204a082x'),

            array('010594Y9032'),
            array('010594y9021'),
            array('020594X903P'),
            array('020594x902n'),
            array('030694W9024'),
            array('030594w903b'),
            array('040594V9030'),
            array('040594v902y'),
            array('050594U902L'),
            array('050594u903m'),

            array('010516B903X'),
            array('010516b902w'),
            array('020516C903K'),
            array('020516c902j'),
            array('030516D9037'),
            array('030516d9026'),
            array('010501E9032'),
            array('020502e902x'),
            array('020503F9037'),
            array('090909f0909'),
        );
    }

    /**
     * @return array
     */
    public function invalidDataProvider()
    {
        return array(
            array('100385-169D'),
            array('100385+169D'),
            array('100385A169D'),
            array('100385a169d'),
        );
    }
}