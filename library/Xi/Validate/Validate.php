<?php
namespace Xi\Validate;

/**
 * Interface for generic validators. 
 * 
 * @category Xi
 * @package  Validate
 * @author   Panu Leppäniemi <me@panuleppaniemi.com>
 */
interface Validate
{
    /**
     * Validates given value. If value is invalid then this should return false.
     * Call setValue() in the beginning in order to reset error messages.
     * Before returning false, error() should be called.
     * 
     * @param  mixed   $value
     * @return boolean
     */
    public function isValid($value);
    
    /**
     * Returns array of error messages.
     * If validation failed, errors should explain why.
     * 
     * @var array
     */
    public function getErrors();
}