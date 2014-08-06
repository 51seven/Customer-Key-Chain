<?php
class CustomerController extends AppController {

    public $uses = array(
        'Customer',
        'Combination',
        'Contactperson',
        'History',
        'Funfact',
        'User',
        'Tag',
    );
    public $helpers = array(
        'Markdown.Markdown',
    );

    /*  
     * Default Route: '/'
     */
    public function index() {

        $this->set('user', $this->Auth->user());
        
        // Anzahl an gespeicherten Kombinationen:
        $combination_count = $this->Combination->find('count');

        // Anzahl der Kunden
        $customer_count = $this->Customer->find('count');

        // Anzahl aller History Einträge
        $history_count = $this->History->find('count');

        // Anzahl aller Tags
        $tags_used_count = $this->Tag->CombinationTag->find('count');
        $tags_unused_count = $this->Tag->find('count');

        // Most Popular Tag
        $most_popular_tag = $this->Tag->CombinationTag->find('first', array(
            'conditions' => array(

            ),
            'recursive' => 10,
            'fields' => array('COUNT(CombinationTag.tag_id) as count, CombinationTag.tag_id'),
            'group' => 'CombinationTag.tag_id',
            'order' => 'CombinationTag.tag_id ASC',
        ));
        
        $this->Tag->recursive = -1;
        $most_popular_tag = $this->Tag->findByTag_id($most_popular_tag['CombinationTag']['tag_id']);

        // Kunden bei denen der letzte Eintrag länger als 30 Tage her ist
        $onemonth = date('Y-m-d', strtotime('-1 month'));

        $frozen_customers = $this->History->find('all', array(
            //'conditions' => array('History.time <=' => $onemonth),
            'group' => 'History.customer_id HAVING MAX(History.time) <= \''.$onemonth.'\'',
            'fields' => array('History.history_id', 'History.customer_id', 'MAX(History.time) as time', 'Customer.name'),
        ));

        $news = $this->History->find('all', array(
            'fields' => array('Customer.name','Customer.customer_id', 'User.username', 'History.text', 'History.time'),
            'limit' => 10,
            'order' => 'History.time DESC'
        ));

        $this->set('combination_count', $combination_count);
        $this->set('customer_count', $customer_count);
        $this->set('history_count', $history_count);
        $this->set('frozen_customers', $frozen_customers);
        $this->set('tags_used_count', $tags_used_count);
        $this->set('tags_unused_count', $tags_unused_count);
        $this->set('most_popular_tag', $most_popular_tag['Tag']['name']);
        $this->set('news', $news);
    }

    public function view($cid = null) {
    	$customer = $this->Customer->findByCustomer_id($cid);

    	if(!$customer) {
    		$this->Session->setFlash('Kunde wurde nicht gefunden.', 'flash_bt_warning');
    		$this->redirect('index');
    	}
    	else {
            $favorites = $this->Favorite->find('list', array(
                'conditions' => array(
                    'user_id' => $this->Auth->user('user_id')
                ),
                'fields' => 'customer_id'
            ));
            $isfav = false;
            foreach($favorites as $favorite) {
                if($favorite == $cid) $isfav = true;
            }
    		$combinations = $this->Combination->findAllByCustomer_id($cid);
            $combos = array();

            foreach($combinations as $combination) {
                $type = $combination['Type']['name'];
                if(!array_key_exists($type, $combos)) {
                    $combos[$type] = array();
                }
                $combos[$type][] = $combination['Combination'];
            }

            /* Sorting combos for better appereance in frontend.
             * Basically we take this:
             * +---+---+---+
             * | 1 | 2 | 3 |
             * +---+---+---+
             * | 4 | 5 | 6 |
             * +---+---+---+
             *
             * And make this:
             * +---+---+---+
             * | 1 | 3 | 5 |
             * +---+---+---+
             * | 2 | 4 | 6 |
             * +---+---+---+
             *
             * ... but this will just change the array order (1-3-5-2-4-6). The visual order will look
             * like the first figure.
             * Just trust me.
             */
            
            $sortedCombos = array();
            
            foreach($combos as $type => $onetypecombos) {
                foreach($onetypecombos as $key => $combo) {
                    $chunkkey = $key%3;
                    if($chunkkey == 3) $chunkkey = 0;
                    $sortedCombos[$type][$chunkkey][] = $combo;
                }
            }

            $this->Contactperson->recursive = -1;
            $contactpersons = $this->Contactperson->findAllByCustomer_id($cid);

            $this->History->recursive = -1;
            $histories = $this->History->findAllByCustomer_id($cid);

            $funfact = $this->Funfact->find('first', array(
                'conditions' => array('Funfact.customer_id LIKE' => $cid),
                'fields' => array('Funfact.customer_id', 'Funfact.text'),
                'order' => 'RAND()',
            ));

            $this->set('funfact', $funfact);
            $this->set('histories', $histories);
            $this->set('contactpersons', $contactpersons);
            $this->set('isfav', $isfav);
    		$this->set('combinations', $sortedCombos);
    		$this->set('customer', $customer);
    	}
    }

    public function create() {
		if($this->request->is('post')) {
            if($this->Customer->save($this->request->data)) {
                $this->Session->setFlash('Kunde erfolgreich erstellt.', 'flash_bt_good');
                $this->redirect(array('controller' => 'customer', 'action' => 'view/'.$this->Customer->getLastInsertId()));
            }
            else {
                $this->Session->setFlash('Fehler beim erstellen eines neuen Kunden.', 'flash_bt_bad');
            }
        }
    }

    public function edit($cid = null) {
        // Speichern
        if($this->request->is('post')) { 
            $this->request->data['Customer']['customer_id'] = $cid;

            if($this->Customer->save($this->request->data)) {
                $this->Session->setFlash('Kunde erfolgreich aktualisiert', 'flash_bt_good');
                $this->redirect('view/'.$cid);
            }
            else {
                $this->Session->setFlash('Kunde konnte nicht aktualisiert werden.', 'flash_bt_bad');
            }
        }
        // Felder vorselektieren
        else {
            if($cid) {
                $this->request->data = $this->Customer->findByCustomer_id($cid);
            }
            else {
                $this->Session->setFlash('Ungültiger Kunde', 'flash_bt_warning');
                $this->redirect('/');
            }
        }
    }

    public function owner_redirect() {
        $this->Customer->recursive = -1;
        $owner = $this->Customer->findByName('51seven');

        if($owner) {
            $this->redirect(array('action' => 'view', $owner['Customer']['customer_id']));    
        }
        else {
            $this->Customer->save(array('Customer' => array('name' => '51seven')));
            $this->owner_redirect();
        }
    }

    public function search() {

        if(isset($this->request->query['string'])) {
            $string = $this->request->query['string'];
        }
        else {
            $this->Session->setFlash('Kein Suchstring vorhanden.', 'flash_bt_info');
            $this->redirect('index');
        }

        if(strlen($string) < 3) {
            $this->Session->setFlash('Suche muss mindestens 3 Buchstaben enthalten.', 'flash_bt_info');
            $this->redirect('index');
        }
        else {
            $contact_results = $this->Contactperson->find('all', array(
                'conditions' => array(
                    'OR' => array(
                        array('Contactperson.prename LIKE' => $string),
                        array('Contactperson.name LIKE' => $string),
                        array('Contactperson.fullname LIKE' => $string),
                    ),
                ),
            ));

            $customer_results = $this->Customer->find('list', array(
                'conditions' => array('Customer.name LIKE' => '%'.$string.'%'),
            ));

            $tags_results = $this->Tag->find('first', array(
                'conditions' => array(
                    'Tag.name LIKE' => '%'.$string.'%'
                ),
                'recursive' => 2
            ));

            if($tags_results) $tags_results = $tags_results['Combination']; // consistent data

            // Suchergebnisse filtern
            if(!$this->Auth->user('isadmin')) {
                $permissions = $this->Permission->find('list', array(
                    'conditions' => array('user_id' => $this->Auth->user('user_id')),
                    'fields' => 'customer_id'
                ));   

                // Kunden filtern
                $filtered_results = array();

                foreach ($customer_results as $key => $result) {
                    if(in_array($key, $permissions)) {
                        array_push($filtered_results, $result);
                    }    
                }
                $customer_results = $filtered_results;

                // Kontakte filtern
                $filtered_results = array();

                foreach ($contact_results as $key => $result) {
                    if(in_array($key['Customer']['customer_id'], $permissions)) {
                        array_push($filtered_results, $result);
                    }    
                }
                $contact_results = $filtered_results;

                // Tags filtern
                $filtered_results = array();

                if(isset($tags_results)) {
                    foreach ($tags_results as $key => $result) {
                        if(!in_array($result['customer_id'], $permissions)) {
                            array_push($filtered_results, $result);
                        } 
                    }
                    $tags_results = $filtered_results;
                }
            }

            $this->set('customer_results', $customer_results);
            $this->set('contact_results', $contact_results);
            $this->set('tags_results', $tags_results);
            $this->set('string', $string);
        }
    }

    public function delete($cid) {
        if($this->Customer->findByCustomer_id($cid)) {
            if($this->Customer->delete($cid, true)) {
                $this->Session->setFlash('Kunde erfolgreich gelöscht.', 'flash_bt_good');
                $this->redirect('/');
            }
            else {
                $this->Session->setFlash('Kunde konnte nicht gelöscht werden.', 'flash_bt_bad');
                $this->redirect('/');
            }
        }
        else {
            $this->Session->setFlash('Kunde nicht gefunden', 'flash_bt_warning');
            $this->redirect('/');
        }
    }


}
