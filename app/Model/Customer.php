<?php
// hasOne: the other model contains the foreign key.
// HABTM requires a separate join table that includes both model names.

class Customer extends AppModel {
    public $useTable = 'customers'; 
    public $primaryKey = 'customer_id'; 

    // Varlidation Rules for this Model
    public $validate = array(
        /*'prename' => array(
            'alphaNumeric' => array(
                'rule' => array(
                    'alphaNumeric'
                ),
                'message' => 'Dein Vorname darf nur aus Buchstaben bestehen.'
            ),
            'lengthValidation' => array(
                'rule' => array(
                    'between', 2, 30
                ),
                'message' => 'Dein Vorname sollte zwischen 2 und 30 Zeichen lang sein.'
            )
        ),*/
    );
}
?>