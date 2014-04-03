<?php
App::uses('AppHelper', 'View/Helper');

class OutputHelper extends AppHelper {
    
    public function echoif($text = null, $fallback = "Empty") {
        if(isset($text)) {
        	echo $text;
        }
        else {
        	echo $fallback;
        }
    }

    
}




?>