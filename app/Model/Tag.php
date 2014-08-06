<?php
// hasOne: the other model contains the foreign key.
// HABTM requires a separate join table that includes both model names.

class Tag extends AppModel {
    public $name = 'Tag';
    public $useTable = 'tags'; 
    public $primaryKey = 'tag_id'; 
    public $displayField = 'name';
    public $cacheQueries = true;
    public $order = array(
        'Tag.name ASC'
    );

    public $hasAndBelongsToMany = array(
        'Combination' => array(
            'className' => 'Combination',
            'joinTable' => 'combination_tags',
            'foreignKey' => 'tag_id',
            'associationForeignKey' => 'combination_id',
            'unique' => true,
        )
    );

    // Varlidation Rules for this Model
    public $validate = array(
        'name' => array(
            'rule' => 'notEmpty',
            'required' => true,
            'message' => 'Ein Tag muss einen Namen haben.'
        )
    );
}

?>