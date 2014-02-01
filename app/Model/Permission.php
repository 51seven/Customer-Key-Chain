<?php
// hasOne: the other model contains the foreign key.
// HABTM requires a separate join table that includes both model names.

class Permission extends AppModel {
    public $useTable = 'permissions'; 
    public $primaryKey = 'permission_id';

    public $belongsTo = array(
        'Customer' => array(
            'className' => 'Customer',
            'foreignKey' => 'customer_id'
        ),
    );    
}
?>