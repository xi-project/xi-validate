<?php

namespace Xi\Validate\Validate\Symfony;

use Symfony\Component\Validator\Constraint;
use Xi\Validate\Validate\SocialSecurityNumberValidate as SocialSecurityNumberValidateGeneric;

/**
 * Symfony constraint class for symfony SSN validator
 * 
 * @Annotation
 * @api
 * @category   Xi
 * @package    Validate
 * @subpackage Symfony
 * @author Jarmo Roivas <jarmo.roivas@brainalliance.com>
 */
class SocialSecurityNumber extends Constraint
{
    /**
     * 
     * Default message
     * 
     * @var string
     */
    public $message = null;
    
    /**
     * 
     * Valid length of the value
     * 
     * @var int
     */
    public $length = 11;
    
    /**
     * 
     * Message templates
     * 
     * @var array
     */
    protected $messageTemplates = array(
        SocialSecurityNumberValidateGeneric::MSG_STRING  => "'{{ value }}' is not a string.",
        SocialSecurityNumberValidateGeneric::MSG_LENGTH  => "Length of '{{ value }}' is not {{ len }}.",
        SocialSecurityNumberValidateGeneric::MSG_DATE    => "The date part in '{{ value }}' is not valid.",
        SocialSecurityNumberValidateGeneric::MSG_CENTURY => "The century in '{{ value }}' is not valid.",
        SocialSecurityNumberValidateGeneric::MSG_IDENT   => "The identifier part in '{{ value }}' is not in the valid range.",
        SocialSecurityNumberValidateGeneric::MSG_HASH    => "The hash calculated differs from the one given in '{{ value }}'.",
    ); 
    
    /**
     * 
     * Get error message text. 
     * If default message is set then return it, in other case return message from message templates.
     * 
     * @param string $messageId
     * @return string
     */
    public function getMessage($messageId)
    {
        if ($this->message) {
            return $this->message;
        } else if (isset($this->messageTemplates[$messageId])) {
            return $this->messageTemplates[$messageId];
        } else {
            return $messageId;
        }
    }
}
