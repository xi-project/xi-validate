<?php
namespace Xi\Validate\Validate;

use Xi\Validate\Validate;

/**
 * An abstract validator class that all generic Xi validators should extend.
 * 
 * @category Xi
 * @package  Validate
 * @author   Panu Leppäniemi <me@panuleppaniemi.com>
 */
abstract class AbstractValidate implements Validate
{
    /**
     * Validated value.
     * 
     * @var mixed
     */
    protected $value;
    
    /**
     * Validation failure messages.
     * 
     * @var array
     */
    private $errors = array();

    /**
     * Returns array of error messages.
     * If validation failed, errors should explain why.
     * 
     * @var array
     */
    public function getErrors()
    {
        return $this->errors;
    }
    
    /**
     * Sets value that is validated and clears existing messages.
     *
     * @param  mixed    $value
     * @return Validate
     */
    protected function setValue($value)
    {
        $this->value  = $value;
        $this->errors = array();
        
        return $this;
    }
    
    /**
     * Adds a new error message. Call this before returning false on isValid().
     * 
     * @param  string   $message
     * @return Validate
     */
    protected function error($message)
    {
        $this->errors[] = $message;
        
        return $this;
    }
}