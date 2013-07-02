<?php

namespace Xi\Validate\Validate\Symfony;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Xi\Validate\Validate\FinnishSocialSecurityNumberValidate as 
        FinnishSocialSecurityNumberValidateGeneric;
use Xi\Validate\Validate;

/**
 * Validates Finnish SSN or Personal ID (HETU).
 * 
 * @api
 * @category   Xi
 * @package    Validate
 * @subpackage Symfony
 * @author Jarmo Roivas <jarmo.roivas@brainalliance.com>
 * @author Artur Gajewski <artur.gajewski@soprano.fi>
 */
class FinnishSocialSecurityNumberValidator extends ConstraintValidator
{
    /**
     * {@inheritDoc}
     */
    public function validate($value, Constraint $constraint)
    {
        if (null === $value || '' === $value) {
            return true;
        }

        if (!is_scalar($value) && !(is_object($value) && method_exists($value, '__toString'))) {
            throw new UnexpectedTypeException($value, 'string');
        }

        $value = (string) $value;

        $validator = $this->getValidator();

        if ($validator->isValid($value)) {
            return true;
        }

        foreach ($validator->getErrors() as $error) {
            $message = $constraint->getMessage($error);
            $this->context->addViolation($message, array(
                    '{{ value }}' => $value,
                    '{{ len }}' => $constraint->length,
                ));

        }

        return false;
    }

    /**
     * 
     * validator instance
     * 
     * @var FinnishSocialSecurityNumberValidateGeneric
     */
    protected $validator = null;
    
    /**
     * 
     * get generic validator instance
     * 
     * @return FinnishSocialSecurityNumberValidateGeneric
     */
    protected function getValidator()
    {
        if ($this->validator === null) {
            $this->validator = new FinnishSocialSecurityNumberValidateGeneric();
        }
        
        return $this->validator;
    }
}
