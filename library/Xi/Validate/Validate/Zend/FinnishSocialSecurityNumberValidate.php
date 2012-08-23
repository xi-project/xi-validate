<?php
namespace Xi\Validate\Validate\Zend;

use Xi\Validate\Validate\FinnishSocialSecurityNumberValidate as 
        FinnishSocialSecurityNumberValidateGeneric;

/**
 * Validates Finnish SSN or Personal ID (HETU).
 * 
 * @category   Xi
 * @package    Validate
 * @subpackage Zend
 * @author     Ville Kalliomäki <ville.kalliomaki@soprano.fi>
 * @author     Panu Leppäniemi  <me@panuleppaniemi.com>
 * @author     Artur Gajewski   <artur.gajewski@soprano.fi>
 */
class FinnishSocialSecurityNumberValidate extends \Zend_Validate_Abstract
{
    protected $length = 11;
    
    protected $_messageVariables = array(
        "len" => "length",
    );
    
    protected $_messageTemplates = array(
        FinnishSocialSecurityNumberValidateGeneric::MSG_STRING  => "'%value%' is not a string.",
        FinnishSocialSecurityNumberValidateGeneric::MSG_LENGTH  => "Length of '%value%' is not %len%.",
        FinnishSocialSecurityNumberValidateGeneric::MSG_DATE    => "The date part in '%value%' is not valid.",
        FinnishSocialSecurityNumberValidateGeneric::MSG_CENTURY => "The century in '%value%' is not valid.",
        FinnishSocialSecurityNumberValidateGeneric::MSG_IDENT   => "The identifier part in '%value%' is not in the valid range.",
        FinnishSocialSecurityNumberValidateGeneric::MSG_HASH    => "The hash calculated differs from the one given in '%value%'.",
    );
    
    /**
     * Validates the given SSN string.
     * 
     * @param  string $value
     * @return bool
     */
    public function isValid($value)
    {
        $this->_setValue($value);

        $validator = new FinnishSocialSecurityNumberValidateGeneric();
        
        if($validator->isValid($value)) {
            return true;
        }
        
        foreach($validator->getErrors() as $error) {
            $this->_error($error);
        }
        
        return false;
    }
    
}