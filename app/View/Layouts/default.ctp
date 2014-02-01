<!DOCTYPE html>
<html>
<head>
  <?php echo $this->Html->charset(); ?>
  <title>
    CKC – 51seven
  </title>
  <?php
    echo $this->Html->meta('icon');

    echo $this->Html->css('bootstrap.min');
    echo $this->Html->css('bootstrap-theme.min');

    echo $this->Html->css('style');

    echo $this->Html->script(array('//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js', 'bootstrap.min', 'ux'));

    echo $this->fetch('meta');
    echo $this->fetch('css');
    echo $this->fetch('script');
  ?>
</head>
<body>
  <?php echo $this->element('navigation'); ?>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-3">
        <?php echo $this->element('left-sidebar'); ?>
      </div>
      <div class="col-md-9">
        <?php echo $this->Session->flash(); ?>
        <?php echo $this->fetch('content'); ?>
        <?php echo $this->element('sql_dump'); ?>
      </div>
    </div>
  </div>
</body>
</html>
