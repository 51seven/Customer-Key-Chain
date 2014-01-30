<?php
// hasOne: the other model contains the foreign key.
// HABTM requires a separate join table that includes both model names.

class Type extends AppModel {
    public $useTable = 'types'; 
    public $primaryKey = 'type_id'; 

    // hasMany: the other model contains the foreign key.
    public $hasMany = array(
        'Combination' => array(
            'className' => 'Combination',
            'foreignKey' => 'combination_id',
        ),
    );
    
    public $order = array(
        'Type.name ASC'
    );

    // Varlidation Rules for this Model
    public $validate = array(
        
    );
}
?>