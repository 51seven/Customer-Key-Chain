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
</head>
<body class="login">
  <div class="wrapper">
    <?php echo $this->fetch('content'); ?>
  </div>
</body>
</html>
