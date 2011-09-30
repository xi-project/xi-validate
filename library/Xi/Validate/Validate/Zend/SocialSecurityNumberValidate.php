<?php
namespace Xi\Validate\Validate\Zend;

use Xi\Validate\Validate\SocialSecurityNumberValidate as SocialSecurityNumberValidateGeneric;

/**
 * Validates Finnish SSN or Personal ID (HETU).
 * 
 * @category   Xi
 * @package    Validate
 * @subpackage Zend
 * @author     Ville Kalliomäki <ville.kalliomaki@soprano.fi>
 * @author     Panu Leppäniemi  <me@panuleppaniemi.com>
 */
class SocialSecurityNumberValidate extends \Zend_Validate_Abstract
{
    protected $length = 11;
    
    protected $_messageVariables = array(
        "len" => "length",
    );
    
    protected $_messageTemplates = array(
        SocialSecurityNumberValidateGeneric::MSG_STRING  => "'%value%' is not a string.",
        SocialSecurityNumberValidateGeneric::MSG_LENGTH  => "Length of '%value%' is not %len%.",
        SocialSecurityNumberValidateGeneric::MSG_DATE    => "The date part in '%value%' is not valid.",
        SocialSecurityNumberValidateGeneric::MSG_CENTURY => "The century in '%value%' is not valid.",
        SocialSecurityNumberValidateGeneric::MSG_IDENT   => "The identifier part in '%value%' is not in the valid range.",
        SocialSecurityNumberValidateGeneric::MSG_HASH    => "The hash calculated differs from the one given in '%value%'.",
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

        $validator = new SocialSecurityNumberValidateGeneric();
        
        if($validator->isValid($value)) {
            return true;
        }
        
        foreach($validator->getErrors() as $error) {
            $this->_error($error);
        }
        
        return false;
    }
    
}