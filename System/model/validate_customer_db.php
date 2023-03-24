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
    public function text($name, $value, $min = 1, $max = 51) {

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

    // Validate a postal text field and return the Field object
    public function postal($postal, $value, $min = 1, $max = 21) {

        // Get Field object and set its value
        $field = $this->fields->getField($postal);
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
            $message = 'Use (999) 999-9999 format.';
            $this->pattern($name, $value, $pattern, $message);
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
        $field = $this->text($name, $password, 6);   // minimum 6 characters

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
            $valid .= ']{6,}';
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
}
?>