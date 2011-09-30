<?php
namespace Xi\Validate\Validate;

/**
 * For testing the AbstractValidate class.
 */
class TestValidate extends AbstractValidate
{ 
    public function isValid($value)
    {
        $this->setValue($value);
        
        if($value !== 'valid') {
            $this->error('Value is not valid');
            return false;
        }
        
        return true;
    }
    
    /**
     * For testing purposes.
     */
    public function __get($key)
    {
        return $this->$key;
    }   
}