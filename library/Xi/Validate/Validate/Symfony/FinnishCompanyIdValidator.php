<?php

namespace Xi\Validate\Validate\Symfony;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Xi\Validate\Validate\FinnishCompanyIdValidate as FinnishCompanyIdValidateGeneric;
use Xi\Validate\Validate;

/**
 * Validates Finnish company ID (Y-tunnus).
 * 
 * @api
 * @category   Xi
 * @package    Validate
 * @subpackage Symfony
 * @author     Artur Gajewski <artur.gajewski@soprano.fi>
 */
class FinnishCompanyIdValidator extends ConstraintValidator
{
    
    /**
     * Validator instance
     * 
     * @var FinnishCompanyIdValidateGeneric
     */
    protected $validator = null;
    
    /**
     * Get generic validator instance
     * 
     * @return FinnishCompanyIdValidateGeneric
     */
    protected function getValidator()
    {
        if ($this->validator === null) {
            $this->validator = new FinnishCompanyIdValidateGeneric();
        }
        
        return $this->validator;
    }
    
    /**
     * Validate given value
     * 
     * @param string $value
     * @param Constraint $constraint
     * @return bool
     */
    public function isValid($value, Constraint $constraint)
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
            $this->setMessage($message, array(
                '{{ value }}' => $value,
            ));
        }
        return false;
    }
    
}
