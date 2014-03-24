<?php
// hasOne: the other model contains the foreign key.
// HABTM requires a separate join table that includes both model names.

class History extends AppModel {
    public $useTable = 'histories'; 
    public $primaryKey = 'history_id'; 

    public $belongsTo = array(
        'Customer' => array(
            'className' => 'Customer',
            'foreignKey' => 'customer_id'
        ),
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id'
        ),
    );

    // Varlidation Rules for this Model
    public $validate = array(
        
    );
}
?>