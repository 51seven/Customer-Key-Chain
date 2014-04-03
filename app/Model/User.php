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

    public $validate = array( 
        'username' => array(
            'notEmpty' => array(
                'rule' => array(
                    'notEmpty'
                ),
                'message' => 'Hast du etwa keinen Namen?',
            ),
            'lengthValidation' => array(
                'rule' => array(
                    'between', 3, 20
                ),
                'message' => 'Dein Benutername sollte zwischen 3 und 20 Zeichen lang sein.'
            ),
            'isUnique' => array(
                'rule' => array(
                    'isUniqueUsername'
                ),
                'message' => 'Dein Benutzername ist dem System bereits bekannt. Hast du bereits einen Account?'
            ),
        ),
        'password' => array(
            'required' => array(
                'rule' => array(
                    'notEmpty'
                ),
                'message' => 'Du musst ein Passwort eingeben.',
                'required' => true
            ),
            'lengthValidation' => array(
                'rule' => array(
                    'between', 6, 40
                ),
                'message' => 'Dein Passwort muss mindestens 6 Zeichen lang sein. (Maximal 40)'
            )
        ),
    );
    

    /** Überprüft ob das Passwort erneut korrekt eingegeben wurde
     *  @params $password_confirm aus den Post-Variablen
     *  @return boolean
    **/
    public function isCorrectConfirmed($password_confirm) {
        if($this->data['User']['password'] == $this->data['User']['password_confirm']) {
            return true;
        }
        else {
            return false;
        }
    }

    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['password'])) {
            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
        }
        return true;
    }
}