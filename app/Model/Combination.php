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

    public $hasAndBelongsToMany = array(
        'Tag' => array(
            'className' => 'Tag',
            'joinTable' => 'combination_tags',
            'foreignKey' => 'combination_id',
            'associationForeignKey' => 'tag_id',
            //'unique' => true,
        )
    );

    // Varlidation Rules for this Model
    public $validate = array(
        
    );

    public function beforeSave($options = null) {
        
        parent::beforeSave(); 

        if(!empty($this->data['Combination']['loginurl'])
            &&
        !preg_match('/(http|https):\/\//', $this->data['Combination']['loginurl'])
            &&
        !preg_match('/(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)/', $this->data['Combination']['loginurl'])) {
            $this->data['Combination']['loginurl'] = 'http://' . $this->data['Combination']['loginurl'];
        }

        return true;
    }

}