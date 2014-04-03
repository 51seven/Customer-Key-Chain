<?php
// hasOne:      the other model contains the foreign key.
// belongsTo:   the current model contains the foreign key.
// HABTM requires a separate join table that includes both model names.

class Contactperson extends AppModel {
    public $useTable = 'contactpersons'; 
    public $primaryKey = 'contactperson_id'; 

    public $virtualFields = array(
        'fullname' => 'CONCAT(Contactperson.prename, " ", Contactperson.name)',
    );

    public $belongsTo = array(
        'Customer' => array(
            'className' => 'Customer',
            'foreignKey' => 'customer_id'
        ),
    );

    // Varlidation Rules for this Model
    public $validate = array(
        'title' => array(
             'rule'    => array('inList', array('Herr', 'Frau'), true),
             'message' => 'Hier sind nur Herr oder Frau zugelassen.'
        ),
        'prename' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'required' => true,
                'message' => 'Die Kontaktperson muss einen Vornamen haben.'
            ),
            'alpha' => array(
                'rule' => '/^[a-zA-Z]+$/i',
                'message' => 'Der Vorname darf nur aus Buchstaben bestehen.',
            ),
            'length' => array(
                'rule'    => array('between', 3, 30),
                'message' => 'Vorname muss zwischen 3 und 30 Zeichen lang sein.'
            ),
        ),
        'name' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'required' => true,
                'message' => 'Die Kontaktperson muss einen Nachnamen haben.'
            ),
            'alpha' => array(
                'rule' => '/^[a-zA-Z]+$/i',
                'message' => 'Der Nachname darf nur aus Buchstaben bestehen.',
            ),
            'length' => array(
                'rule'    => array('between', 3, 30),
                'message' => 'Nachname muss zwischen 3 und 30 Zeichen lang sein.'
            ),
        ),
        'mail' => array(
           'rule' => array('email', true),
            'message' => 'Dies ist keine gültige Email-Adresse.'
        ),
    );
}
?>