<?php

namespace Debuconnor\Honeypot\Helper;

use Exception;
use Magento\Framework\App\Helper\AbstractHelper;

class Data extends AbstractHelper{
    public function isNameAllowed($firstname, $lastname){
        $isAllowed = true;

        if(strlen($firstname) >= strlen($lastname)){
            if(str_contains($firstname, $lastname)){
                $isAllowed = false;
            }
        } else {
            if(str_contains($lastname, $firstname)){
                $isAllowed = false;
            }
        }
        
        if(!$isAllowed){
            throw new Exception("Honeypot: Username is not allowed. [firstname: " . $firstname . ", lastname: " . $lastname . "]");
        }
    }
}