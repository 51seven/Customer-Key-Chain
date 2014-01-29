<!DOCTYPE html>
<html>
<head>
  <?php echo $this->Html->charset(); ?>
  <title>
    CKC – 51seven
  </title>
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet' type='text/css'>
  <?php
    echo $this->Html->meta('icon');

    echo $this->Html->css('style');

    echo $this->fetch('meta');
    echo $this->fetch('css');
    echo $this->fetch('script');
  ?>
</head>
<body>
  <?php echo $this->element('navigation'); ?>
  <?php echo $this->Session->flash(); ?>
  <?php echo $this->fetch('content'); ?>
  <?php echo $this->element('sql_dump'); ?>
</body>
</html>
