<?php

namespace Xi\Validate\Validate\Symfony;

use Symfony\Component\Validator\Constraint;
use Xi\Validate\Validate\FinnishCompanyIdValidate as FinnishCompanyIdValidateGeneric;

/**
 * Symfony Finnish company ID validator
 * 
 * @Annotation
 * @api
 * @category   Xi
 * @package    Validate
 * @subpackage Symfony
 * @author     Artur Gajewski <artur.gajewski@soprano.fi>
 */
class FinnishCompanyId extends Constraint
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
     * Message templates
     * 
     * @var array
     */
    protected $messageTemplates = array(
        FinnishCompanyIdValidateGeneric::MSG_STRING    => "Value of '{{ value }}' is not a string.",
        FinnishCompanyIdValidateGeneric::MSG_FORMAT    => "Value of '{{ value }}' is not well formatted.",
        FinnishCompanyIdValidateGeneric::MSG_CHECKSUM  => "Checksum failure for value '{{ value }}'.",
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
