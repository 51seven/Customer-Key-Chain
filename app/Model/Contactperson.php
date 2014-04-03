<?php
// hasOne:      the other model contains the foreign key.
// belongsTo:   the current model contains the foreign key.
// HABTM requires a separate join table that includes both model names.

class Contactperson extends AppModel {
    public $useTable = 'contactpersons'; 
    public $primaryKey = 'contactperson_id'; 

    public $virtualFields = array(
        'fullname' => 'CONCAT(Contactperson.prename, " ", Contactperson.name)',
    );

    public $belongsTo = array(
        'Customer' => array(
            'className' => 'Customer',
            'foreignKey' => 'customer_id'
        ),
    );

    // Varlidation Rules for this Model
    public $validate = array(
        'name' => array(
            'rule'     => 'notEmpty',
            'required' => true,
            'message' => 'Die Kontaktperson muss einen Namen haben.'
        )
    );
}
?>