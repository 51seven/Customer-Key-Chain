<?php
// hasOne: the other model contains the foreign key.
// HABTM requires a separate join table that includes both model names.

class Combination extends AppModel {
    public $useTable = 'combinations'; 
    public $primaryKey = 'combination_id'; 

    // belongsTo: the current model contains the foreign key.
    public $belongsTo = array( 
        'Customer' => array(
            'className' => 'Customer',
            'foreignKey' => 'customer_id',
        ),
        'Type' => array(
            'className' => 'Type',
            'foreignKey' => 'type_id',
        ),
    );


    // Varlidation Rules for this Model
    public $validate = array(
        
    );


    public function beforeSave($options) {
        
        // Removes http/https because of link consistency.
        if(isset($this->data['Combination']['loginurl'])) {
            $this->data['Combination']['loginurl'] = str_replace('http://', '', $this->data['Combination']['loginurl']);
            $this->data['Combination']['loginurl'] = str_replace('https://', '', $this->data['Combination']['loginurl']);
        }

        return true;
    }

}
?>