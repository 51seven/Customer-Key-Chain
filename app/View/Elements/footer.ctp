<footer>
  <div class="container">
    <div class="row">
    <div class="col-xs-4">
        <ul class="no-list-style">
          <li><?= $this->Html->link('Alle Typen anzeigen', array('controller' => 'type', 'action' => 'index')); ?></li>
          <li><?= $this->Html->link('Dein Passwort ändern', array('controller' => 'user', 'action' => 'changepw')); ?></li>
          <li><?= $this->Html->link('Einen Fehler melden', 'https://github.com/51seven/Customer-Key-Chain/issues/new', array('target' => '_blank')); ?></li>
        </ul>
      </div>
      <div class="col-xs-4">
        <div class="logo">Customer Key Chain</div>
      </div>
      <div class="col-xs-4">
        <ul class="no-list-style align-right">
          <li>Customer Key Chain &copy 2014</li>
          <?php //<li> &#160;</li>?>
          <li>51seven</li>
          <li>Gesellschaft für Markenkommunikation mbH</li>
        </ul>
      </div>
    </div>
  </div>
</footer>
