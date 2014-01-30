<?php
// hasOne: the other model contains the foreign key.
// HABTM requires a separate join table that includes both model names.

class Customer extends AppModel {
    public $useTable = 'customers'; 
    public $primaryKey = 'customer_id'; 

    public $order = array(
        'Customer.name ASC'
    );

    // Varlidation Rules for this Model
    public $validate = array(
        'name' => array(
            'notEmpty' => true,
        ),
    );
}
?>