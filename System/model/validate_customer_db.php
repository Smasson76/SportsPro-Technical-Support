<?php
class Validate {
    private $fields;

    public function __construct() {
        $this->fields = new Fields();
    }

    public function getFields() {
        return $this->fields;
    }

    // Validate a generic text field and return the Field object
    public function text($name, $value, $min = 1, $max = 255) {

        // Get Field object and set its value
        $field = $this->fields->getField($name);
        $field->setValue($value);
        
        // Check field and set or clear error message
        if ($field->isRequired() && $field->isEmpty()) {
            $field->setErrorMessage('Required.');
        } else if (strlen($value) < $min && !$field->isEmpty()) {
            $field->setErrorMessage('Too short.');
        } else if (strlen($value) > $max) {
            $field->setErrorMessage('Too long.');
        } else {
            $field->clearErrorMessage();
        }
        
        return $field;
    }

    // Validate a field with a generic pattern
    public function pattern($name, $value, $pattern, $message) {
        // Get Field object and do text field check
        $field = $this->text($name, $value);

        // if OK after text field check, move on to pattern check
        if (!$field->hasError() && !$field->isEmpty()) {
            $match = preg_match($pattern, $value);
            if ($match === FALSE) {
                $field->setErrorMessage('Error testing field.');
            } else if ( $match != 1 ) {
                $field->setErrorMessage($message);
            } else {
                $field->clearErrorMessage();
            }
        }
    }

    public function phone($name, $value) {
        // Get Field object and do text field check
        $field = $this->text($name, $value);

        // if OK after text field check, move on to phone check
        if (!$field->hasError() && !$field->isEmpty()) {
            // Call the pattern method to validate a phone number
            $pattern = '/^\(\d{3}\) ?\d{3}-\d{4}$/';
            $message = 'Invalid phone number.';
            $this->pattern($name, $value, $pattern, $message);
        }
    }

    public function birthdate($name, $value) {
        // Get Field object and do text field check
        $field = $this->text($name, $value);

        // if OK after text field check, move on to birthdate check
        if (!$field->hasError() && !$field->isEmpty()) {
            // Call the pattern method to validate a phone number
            $pattern = '/^(0?[1-9]|1[0-2])\/(0?[1-9]|[12][[:digit:]]|3[01])\/[[:digit:]]{4}$/';
            $message = 'Invalid date format.';
            $this->pattern($name, $value, $pattern, $message);
            
            // if pattern check OK, move on to future date check
            if (!$field->hasError()) {
                $birthdate = new DateTime($value);
                $now = new DateTime();
                if ($birthdate > $now) {
                    $field->setErrorMessage('Birthdate can\'t be in the future.');
                } else {
                    $field->clearErrorMessage();
                }
            }
        }
    }

    public function email($name, $value) {
        // Get Field object and do text field check
        $field = $this->text($name, $value);

        // if OK after text field check, move on to email check
        if (!$field->hasError() && !$field->isEmpty()) {
            if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
                $field->clearErrorMessage();
            } else {
                $field->setErrorMessage("Invalid email address.");
            }
        }
    }

    public function password($name, $password) {
        // Get Field object and do text field check
        $field = $this->text($name, $password, 8);   // minimum 8 characters

        // if OK after text field check, move on to password check
        if (!$field->hasError() && !$field->isEmpty()) {

            // Patterns to validate password
            $charClasses = [];
            $charClasses[] = '[:digit:]';
            $charClasses[] = '[:upper:]';
            $charClasses[] = '[:lower:]';    
            // $charClasses[] = '_-';           // Don't require any special characters
            
            $pattern = '/^';
            $valid = '[';
            foreach($charClasses as $charClass) {
                $pattern .= '(?=.*[' . $charClass . '])';
                $valid .= $charClass;
            }
            $valid .= ']{8,}';
            $pattern .= $valid . '$/';

            $message = 'Must have one each of uppercase, lowercase, and digit.';
            $this->pattern($name, $password, $pattern, $message);
        }
    }

    public function verify($name, $password, $verify) {
        // Get Field object and do text field check
        $field = $this->text($name, $password);

        // if OK after text field check, move on to verify check
        if (!$field->hasError() && !$field->isEmpty()) {
            if (strcmp($password, $verify) != 0) {
                $field->setErrorMessage('Passwords do not match.');
            } else {
                $field->clearErrorMessage();
            }
        }
    }

    public function state($name, $value) {
        // Get Field object and do text field check
        $field = $this->text($name, $value);

        // if OK after text field check, move on to state check
        if (!$field->hasError() && !$field->isEmpty()) {
            $states = [
                'AL', 'AK', 'AZ', 'AR', 'CA', 'CO', 'CT', 'DE', 'DC',
                'FL', 'GA', 'HI', 'ID', 'IL', 'IN', 'IA', 'KS', 'KY',
                'LA', 'ME', 'MA', 'MD', 'MI', 'MN', 'MS', 'MO', 'MT',
                'NE', 'NV', 'NH', 'NJ', 'NM', 'NY', 'NC', 'ND', 'OH',
                'OK', 'OR', 'PA', 'RI', 'SC', 'SD', 'TN', 'TX', 'UT',
                'VT', 'VA', 'WA', 'WV', 'WI', 'WY'
            ];
            $stateString = implode('|', $states);
            $pattern = '/^(' . $stateString . ')$/';
            $this->pattern($name, $value, $pattern, 'Invalid state.');
        }
    }

    public function zip($name, $value) {
        // Get Field object and do text field check
        $field = $this->text($name, $value);

        // if OK after text field check, move on to zip check
        if (!$field->hasError() && !$field->isEmpty()) {
            $pattern = '/^\d{5}(-\d{4})?$/';
            $message = 'Invalid zip code.';
            $this->pattern($name, $value, $pattern, $message);
        }
    }

    public function cardType($name, $value) {
        $field = $this->fields->getField($name);
        if (empty($value)) {
            $field->setErrorMessage('Please select a card type.');
        } else {
            $types = ['m', 'v', 'a', 'd'];
            $typeString = implode('|', $types);
            $pattern = '/^(' . $typeString . ')$/';
            $this->pattern($name, $value, $pattern, 'Invalid card type.');
        }
    }

    public function cardNumber($name, $value, $type) {
        $field = $this->fields->getField($name);
        switch ($type) {
            case 'm':  // MasterCard
                $prefixes = '51-55';
                $lengths  = '16';
                break;
            case 'v':  // Visa
                $prefixes = '4';
                $lengths  = '13,16';
                break;
            case 'a':  // American Express
                $prefixes = '34,37';
                $lengths  = '15';
                break;
            case 'd':  // Discover
                $prefixes = '6011,622126-622925,644-649,65';
                $lengths  = '16';
                break;
            case '':   // No card type selected.
                $field->clearErrorMessage();
                return;
            default:
                $field->setErrorMessage('Invalid card type.');
                return;
        }

        // Check lengths
        $lengths = explode(',', $lengths);
        $validLengths = FALSE;
        foreach($lengths as $length) {
            $pattern = '/^[[:digit:]]{' . $length . '}$/';
            if (preg_match($pattern, $value) === 1) {
                $validLengths = TRUE;
                break;
            }
        }
        if ( ! $validLengths ) {
            $field->setErrorMessage('Invalid card number length.');
            return;
        }

        // Check prefix
        $prefixes = explode(',', $prefixes);
        $rangePattern = '/^[[:digit:]]+-[[:digit:]]+$/';
        $validPrefix = FALSE;
        foreach($prefixes as $prefix) {
            if (preg_match($rangePattern, $prefix) === 1) {
                $range = explode('-', $prefix);
                $start = intval($range[0]);
                $end = intval($range[1]);
                for( $prefix = $start; $prefix <= $end; $prefix++ ) {
                    $pattern = '/^' . $prefix . '/';
                    if (preg_match($pattern, $value) === 1) {
                        $validPrefix = TRUE;
                        break;
                    }
                }
            } else {
                $pattern = '/^' . $prefix . '/';
                if (preg_match($pattern, $value) === 1) {
                    $validPrefix = TRUE;
                    break;
                }
            }
        }
        if ( ! $validPrefix ) {
            $field->setErrorMessage('Invalid card number prefix.');
            return;
        }

        // Validate checksum
        $sum = 0;
        $length = strlen($value);
        for ($i = 0; $i < $length; $i++) {
            $digit = intval($value[$length - $i - 1]);
            $digit = ( $i % 2 == 1 ) ? $digit * 2 : $digit;
            $digit = ($digit > 9) ? $digit - 9 : $digit;
            $sum += $digit;
        }
        if ( $sum % 10 != 0 ) {
            $field->setErrorMessage('Invalid card number checksum.');
            return;
        }
        $field->clearErrorMessage();
    }

    public function expDate($name, $value, $cardtype) {
        $field = $this->fields->getField($name);
        if (empty($cardtype)) {
            $field->clearErrorMessage();
        } else {
            $pattern = '/^(0[1-9]|1[012])\/[1-9][[:digit:]]{3}?$/';
            $message = 'Invalid expiration date format.';
            $this->pattern($name, $value, $pattern, $message);    
            
            // if pattern check OK, move on to expired check
            if (!$field->hasError()) {
                $dateParts = explode('/', $value);
                $month = $dateParts[0];
                $year  = $dateParts[1];
                $dateString = $month . '/01/' . $year . ' last day of 23:59:59';
                $exp = new DateTime($dateString);
                $now = new DateTime();
                if ( $exp < $now ) {
                    $field->setErrorMessage('Card has expired.');
                } else {
                    $field->clearErrorMessage();
                }
            }
        }
    }

}
?>