<?php
namespace Xi\Validate\Validate;

/**
 * Validator for the Finnish Social Security Number (SSN).
 * Also known as Personal ID or HETU.
 * 
 * @category Xi
 * @package  Validate
 * @author   Ville Kalliomäki <ville.kalliomaki@soprano.fi>
 * @author   Panu Leppäniemi  <me@panuleppaniemi.com>
 * @author   Artur Gajewski   <artur.gajewski@soprano.fi>
 */
class FinnishSocialSecurityNumberValidate extends AbstractValidate
{
    const MSG_STRING  = "Value is not a string.";
    const MSG_LENGTH  = "Value is not 11 characters.";
    const MSG_DATE    = "Date is not valid.";
    const MSG_CENTURY = "Century is not valid.";
    const MSG_IDENT   = "Identifier is not valid.";
    const MSG_HASH    = "Calculated hash does not match.";
    
    /**
     * @var int
     */
    protected $length = 11;

    /**
     * Values for the characters representing the centuries in the id.
     * @var array
     */
    protected $centuries = array(
        "+" => "18",
        "-" => "19",
        "Y" => "19",
        "X" => "19",
        "W" => "19",
        "V" => "19",
        "U" => "19",
        "A" => "20",
        "B" => "20",
        "C" => "20",
        "D" => "20",
        "E" => "20",
        "F" => "20",
    );
    
    /**
     * Minimum numeric value of the second part of the id.
     * @var int
     */
    protected $identMin = 2;
    
    /**
     * Maximum numeric value of the second part of the id.
     * @var int
     */
    protected $identMax = 999;
    
    /**
     * Possible verification characters in order of value.
     * @var string
     */
    protected $hashChars = "0123456789ABCDEFHJKLMNPRSTUVWXY";
    
    /**
     * Validates the given SSN string.
     * 
     * @param  string $value
     * @return bool          
     */
    public function isValid($value) {
        $this->setValue($value);
        
        if (!is_string($value)) {
            $this->error(self::MSG_STRING);
            return false;
        }

        //no need to be case sensitive
        $value = strtoupper($value);
        
        // length validation
        if (strlen($value) != $this->length) {
            $this->error(self::MSG_LENGTH);
            return false;
        }
        
        // parts of the id string
        $ddmmyy      = substr($value, 0, 6);
        $century     = $value[6];
        $identString = substr($value, 7, 3);
        $hash        = $value[10];
        
        // century validation
        if (!array_key_exists($century, $this->centuries)) {
            $this->error(self::MSG_CENTURY);
            return false;
        }
        
        // date validation
        $day   = (int) substr($ddmmyy, 0, 2);
        $month = (int) substr($ddmmyy, 2, 2);
        $year  = (int) ($this->centuries[$century] . substr($ddmmyy, 4, 2));
        
        if (!checkdate($month, $day, $year) || $year < 1850) {
            $this->error(self::MSG_DATE);
            return false;
        }
        
        // ident validation
        $ident = (int) $identString;
        
        if ($ident < $this->identMin || $ident > $this->identMax) {
            $this->error(self::MSG_IDENT);
            return false;
        }
        
        // hash validation
        if (!$this->validateHash(substr($value, 0, 6), $identString, $hash)) {
            $this->error(self::MSG_HASH);
            return false;
        }
        
        return true;
    }
    
    /**
     * Validate a given hash character.
     *
     * @param  string  $ddmmyy
     * @param  string  $code
     * @param  string  $hash
     * @return boolean
     */
    private function validateHash($ddmmyy, $identString, $hash)
    {
        // safe on 32-bit platforms
        $expectedHash = $this->hashChars[((int) ($ddmmyy . $identString)) % 31];
        
        return $expectedHash == $hash;
    }
    
}