<!DOCTYPE html>
<html>
<head>
  <?php echo $this->Html->charset(); ?>
  <title>CKC – 51seven</title>
  <?php
    //echo $this->Html->meta('icon');
    echo $this->Html->meta('icon', $this->Html->url('/app/webroot/favicon.ico'))."\n";

    echo $this->Html->css(array(
      'bootstrap.min',
      'bootstrap-theme.min',
      'style',
      'jquery.simple-dtpicker',
      '//code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css',
      'jquery.tagit',
      'tagit.ui-zendesk'
    ));

    echo $this->fetch('meta');
    echo $this->fetch('css');

    echo $this->Html->script(array(
      '//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js', 
      '//code.jquery.com/ui/1.11.0/jquery-ui.js',
      'jquery.simple-dtpicker',
      'bootstrap.min',
      'ZeroClipboard',
      'ux',
      'tagger'
    )); 
  ?>
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
  <?php echo $this->element('navigation'); ?>
  <div class="container">
    <div class="row">
      <div class="col-sm-3">
        <?php echo $this->element('left-sidebar'); ?>
      </div>
      <div class="col-sm-9">
        <?php echo $this->Session->flash(); ?>
        <?php echo $this->fetch('content'); ?>
      </div>
    </div>

    <?php if(Configure::read('debug') > 0): ?>
    <div style="margin: 50 10px 0 10px;">
      <?php echo $this->element('sql_dump'); ?>
    </div>
    <?php endif; ?>
    
  </div>
  <?php echo $this->element('footer'); ?>
  <script>
    $(function(){
      $("#datepicker").appendDtpicker({"inline": true});
    });

    $('#sidebarAccordion').affix(30);
  </script>
</body>
</html>
