<?php

namespace Xi\Validate\Validate\Symfony;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Xi\Validate\Validate\SocialSecurityNumberValidate as SocialSecurityNumberValidateGeneric;
use Xi\Validate\Validate;

/**
 * @api
 */
class SocialSecurityNumberValidator extends ConstraintValidator
{
    protected $_validator = null;
    
    protected function _getValidator()
    {
        if ($this->_validator === null) {
            $this->_validator = new SocialSecurityNumberValidateGeneric();
        }
        
        return $this->_validator;
    }
    
    public function isValid($value, Constraint $constraint)
    {
        if (null === $value || '' === $value) {
            return true;
        }

        if (!is_scalar($value) && !(is_object($value) && method_exists($value, '__toString'))) {
            throw new UnexpectedTypeException($value, 'string');
        }
        
        $value = (string) $value;
        
        $validator = $this->_getValidator();
        
        if($validator->isValid($value)) {
            return true;
        }
        
        foreach($validator->getErrors() as $error) {
            $message = $constraint->getMessage($error);
            
            $this->setMessage($message, array(
                '{{ value }}' => $value,
                '{{ len }}' => $constraint->length,
            ));
        }
        
        return false;
    }
    
}
