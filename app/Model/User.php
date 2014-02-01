<?php
// hasOne: the other model contains the foreign key.
// HABTM requires a separate join table that includes both model names.

class User extends AppModel {
    public $useTable = 'users'; 
    public $primaryKey = 'user_id'; 

    public $hasMany = array(
        'Combination' => array(
            'className' => 'Combination',
            'foreignKey' => 'combination_id'
        )
    );

    // Varlidation Rules for this Model
    public $validate = array(
        
    );
}
?>