<?php
namespace Xi\Validate\Validate;

/**
 * Validator for the Finnish Company ID (Y-tunnus).
 * 
 * @category Xi
 * @package  Validate
 * @author   Artur Gajewski <artur.gajewski@soprano.fi>
 */
class FinnishCompanyIdValidate extends AbstractValidate
{
    const MSG_STRING    = "Value is not a string.";
    const MSG_FORMAT    = "Value is not well formatted.";
    const MSG_CHECKSUM  = "Checksum failure.";
    
    /**
     * Validates the given company ID string.
     * 
     * @param  string $value
     * @return bool          
     */
    public function isValid($value) 
    {
        $this->setValue($value);
        
        // is value a string
        if (!is_string($value)) {
            $this->error(self::MSG_STRING);
            return false;
        }

        // length validation
        if (strlen($value) != 9) {
            $this->error(self::MSG_FORMAT);
            return false;
        }
        
        // does value contain - character
        if (substr_count($value, '-') != 1) {
            $this->error(self::MSG_FORMAT);
            return false;
        }

        $parts = explode('-', $value);

        // are the parts numeric?
        if(!is_numeric($parts[0]) || !is_numeric($parts[1])) {
            $this->error(self::MSG_FORMAT);
            return false;
        }

        $number = $parts[0];
        $checksum = $parts[1];

        $length = strlen($number);

        if ($length > 7) {
            $this->error(self::MSG_FORMAT);
            return false;
        } elseif ($length < 7) {      
            for($i=$length; $i < 7; $i++) {
                $number = '0' . $number;
            }
        }

        $mp = array(7,9,10,5,8,4,2);
        $sum = 0;

        for($i=0; $i<7; $i++) {
            $sum = (int)(substr($number, $i, 1) * $mp[$i]) + $sum;
        }

        $check = $sum % 11;

        if (!$check && !$checksum) {
            return true;  
        } elseif ($check > 1 && (11 - $check) == $checksum) {
            return true;  
        } 

        $this->error(self::MSG_CHECKSUM);
        return false;
    }
}