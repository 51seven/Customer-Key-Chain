<?php
// hasOne: the other model contains the foreign key.
// HABTM requires a separate join table that includes both model names.

class FunFact extends AppModel {
    public $useTable = 'funfacts'; 
    public $primaryKey = 'funfact_id'; 

    public $belongsTo = array(
        'Customer' => array(
            'className' => 'Customer',
            'foreignKey' => 'customer_id'
        ),
    );

    // Varlidation Rules for this Model
    public $validate = array(
        'text' => array(
            'rule'     => 'notEmpty',
            'required' => true,
            'message' => 'Die Kontaktperson muss einen Namen haben.'
        )
    );
}
?>