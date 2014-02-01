<?php
// hasOne: the other model contains the foreign key.
// HABTM requires a separate join table that includes both model names.

class Favorite extends AppModel {
    public $useTable = 'favorites'; 
    public $primaryKey = 'favorite_id';

    public $belongsTo = array(
        'Customer' => array(
            'className' => 'Customer',
            'foreignKey' => 'customer_id'
        ),
    );    
}
?>