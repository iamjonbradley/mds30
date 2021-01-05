
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <?php echo $this->Html->charset(); ?>
  <title>IDC 9 Loookup</title>
  <?php
    echo $this->Html->meta('icon');
    echo $this->Html->css(array('default', 'boxy', 'styles'));
  ?>
</head>
<body>
  <div id="container">
    <div id="header">
      <h1> IDC 9 Lookup</h1>
    </div>
    <div id="content">

      <?php 
      echo $this->Session->flash();
      echo $content_for_layout; 
      ?>

    </div>
    <div id="footer">
      Copyright &copy; <?php echo date('Y'); ?> <?php echo $this->Session->read('Settings.SFTWR_VNDR_NAME'); ?>. All Rights Reserved.
    </div>
  </div>
</body>
</html>