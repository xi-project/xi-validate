<?php

namespace Xi\Validate\Validate\Symfony;

use Symfony\Component\Validator\Constraint;
use Xi\Validate\Validate\SocialSecurityNumberValidate as SocialSecurityNumberValidateGeneric;

/**
 * Symfony constraint class for symfony SSN validator
 * 
 * @category   Xi
 * @package    Validate
 * @subpackage Symfony
 * @author Jarmo Roivas <jarmo.roivas@brainalliance.com>
 */
class SocialSecurityNumber extends Constraint
{
    public $message = null;
    
    public $length = 11;
    
    protected $_messages = array(
        SocialSecurityNumberValidateGeneric::MSG_STRING  => "'{{ value }}' is not a string.",
        SocialSecurityNumberValidateGeneric::MSG_LENGTH  => "Length of '{{ value }}' is not {{ len }}.",
        SocialSecurityNumberValidateGeneric::MSG_DATE    => "The date part in '{{ value }}' is not valid.",
        SocialSecurityNumberValidateGeneric::MSG_CENTURY => "The century in '{{ value }}' is not valid.",
        SocialSecurityNumberValidateGeneric::MSG_IDENT   => "The identifier part in '{{ value }}' is not in the valid range.",
        SocialSecurityNumberValidateGeneric::MSG_HASH    => "The hash calculated differs from the one given in '{{ value }}'.",
    ); 
    
    public function getMessage($messageId)
    {
        if ($this->message) {
            return $this->message;
        }
        else if (isset($this->_messages[$messageId])) {
            return $this->_messages[$messageId];
        } else {
            return $messageId;
        }
    }
}
