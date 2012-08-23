<?php
namespace Xi\Validate\Validate\Zend;

use Xi\Validate\Validate\FinnishCompanyIdValidate as FinnishCompanyIdValidateGeneric;

/**
 * Validates Finnish Company ID (Y-tunnus).
 * 
 * @category   Xi
 * @package    Validate
 * @subpackage Zend
 * @author     Artur Gajewski <artur.gajewski@soprano.fi>
 */
class FinnishCompanyIdValidate extends \Zend_Validate_Abstract
{
    
    protected $_messageTemplates = array(
        FinnishCompanyIdValidateGeneric::MSG_STRING    => "Value is not a string.",
        FinnishCompanyIdValidateGeneric::MSG_FORMAT    => "Value is not well formatted.",
        FinnishCompanyIdValidateGeneric::MSG_CHECKSUM  => "Checksum failure.",
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

        $validator = new FinnishCompanyIdValidateGeneric();
        
        if($validator->isValid($value)) {
            return true;
        }
        
        foreach($validator->getErrors() as $error) {
            $this->_error($error);
        }
        
        return false;
    }
    
}