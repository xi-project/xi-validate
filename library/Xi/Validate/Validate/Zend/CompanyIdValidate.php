<?php
namespace Xi\Validate\Validate\Zend;

use Xi\Validate\Validate\CompanyIdValidate as CompanyIdValidateGeneric;

/**
 * Validates Finnish Company ID (Y-tunnus).
 * 
 * @category   Xi
 * @package    Validate
 * @subpackage Zend
 * @author     Artur Gajewski <artur.gajewski@soprano.fi>
 */
class SocialSecurityNumberValidate extends \Zend_Validate_Abstract
{
    
    protected $_messageTemplates = array(
        CompanyIdValidateGeneric::MSG_STRING    => "Value is not a string.",
        CompanyIdValidateGeneric::MSG_FORMAT    => "Value is not well formatted.",
        CompanyIdValidateGeneric::MSG_CHECKSUM  => "Checksum failure.",
    );
    
    /**
     * Validates the given company ID string.
     * 
     * @param  string $value
     * @return bool
     */
    public function isValid($value)
    {
        $this->_setValue($value);

        $validator = new CompanyIdValidateGeneric();
        
        if($validator->isValid($value)) {
            return true;
        }
        
        foreach($validator->getErrors() as $error) {
            $this->_error($error);
        }
        
        return false;
    }
    
}