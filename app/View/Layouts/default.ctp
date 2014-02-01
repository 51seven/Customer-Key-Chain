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
    //echo $this->Html->css('bootstrap-theme.min');

    echo $this->Html->css('style');

    echo $this->Html->script(array('//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js', 'bootstrap.min', 'ux'));

    echo $this->fetch('meta');
    echo $this->fetch('css');
    echo $this->fetch('script');
  ?>
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
  <?php echo $this->element('navigation'); ?>
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-3">
        <?php echo $this->element('left-sidebar'); ?>
      </div>
      <div class="col-sm-9">
        <?php echo $this->Session->flash(); ?>
        <?php echo $this->fetch('content'); ?>
      </div>
    </div>
    <?php echo $this->element('sql_dump'); ?>
  </div>
</body>
</html>
