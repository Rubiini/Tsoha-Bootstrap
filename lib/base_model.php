<?php

class BaseModel {

    // "protected"-attribuutti on käytössä vain luokan ja sen perivien luokkien sisällä
    protected $validators;

    public function __construct($attributes = null) {
        // Käydään assosiaatiolistan avaimet läpi
        foreach ($attributes as $attribute => $value) {
            // Jos avaimen niminen attribuutti on olemassa...
            if (property_exists($this, $attribute)) {
                // ... lisätään avaimen nimiseen attribuuttin siihen liittyvä arvo
                $this->{$attribute} = $value;
            }
        }
    }

    public function errors() {
        // Lisätään $errors muuttujaan kaikki virheilmoitukset taulukkona
        $errors = array();
        foreach ($this->validators as $validator) {
            $errors = array_merge($errors, $this->{$validator}());
        }

        return $errors;
    }
    
    public function validate_string_length($string, $attribute, $min, $max) {
        $errors = array();
        if (strlen($string) < $min || $string > $max) {
             $errors[] = $attribute . ' length must be between ' . $min . ' and ' . $max . ' characters!';
        }
        return $errors;
        
    }

    public function valid_date($date) {
        $errors = array();
        $obj = DateTime::createFromFormat('Y-m-d', $date);
        if (!$obj) {
             $errors[] = 'Date input form has to be "Y-m-d"';
        }
        return $errors;
    }

    public function valid_time($time) {
        $errors = array();
        $obj = DateTime::createFromFormat('H:i:s', $time);
        if (!$obj) {
            $errors[] = 'Time input form has to be "H:M:S"';
        }
        return $errors;
    }
}
