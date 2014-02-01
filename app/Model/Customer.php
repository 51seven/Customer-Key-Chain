<?php
// hasOne: the other model contains the foreign key.
// HABTM requires a separate join table that includes both model names.

class Customer extends AppModel {
    public $useTable = 'customers'; 
    public $primaryKey = 'customer_id'; 

    public $order = array(
        'Customer.name ASC'
    );

    /*public $hasOne = array(
        'Combination' => array(
            'className' => 'Combination',
            'foreignKey' => 'combination_id'
        ),
        'Favorites' => array(
            'className' => 'Favorites',
            'foreignKey' => 'favorite_id'
        )
    );*/

    // Varlidation Rules for this Model
    public $validate = array(
        'name' => array(
            'rule'     => 'notEmpty',
            'required' => true,
            'message' => 'Der Kunde muss einen Namen haben.'
        )
    );
}
?>