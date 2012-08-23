<?php

namespace Xi\Validate\Validate\Symfony;

use Symfony\Component\Validator\Constraint;
use Xi\Validate\Validate\FinnishSocialSecurityNumberValidate as 
        FinnishSocialSecurityNumberValidateGeneric;

/**
 * Symfony constraint class for symfony SSN validator
 * 
 * @Annotation
 * @api
 * @category   Xi
 * @package    Validate
 * @subpackage Symfony
 * @author Jarmo Roivas <jarmo.roivas@brainalliance.com>
 * @author Artur Gajewski <artur.gajewski@soprano.fi>
 */
class FinnishSocialSecurityNumber extends Constraint
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
        FinnishSocialSecurityNumberValidateGeneric::MSG_STRING  => "'{{ value }}' is not a string.",
        FinnishSocialSecurityNumberValidateGeneric::MSG_LENGTH  => "Length of '{{ value }}' is not {{ len }}.",
        FinnishSocialSecurityNumberValidateGeneric::MSG_DATE    => "The date part in '{{ value }}' is not valid.",
        FinnishSocialSecurityNumberValidateGeneric::MSG_CENTURY => "The century in '{{ value }}' is not valid.",
        FinnishSocialSecurityNumberValidateGeneric::MSG_IDENT   => "The identifier part in '{{ value }}' is not in the valid range.",
        FinnishSocialSecurityNumberValidateGeneric::MSG_HASH    => "The hash calculated differs from the one given in '{{ value }}'.",
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
