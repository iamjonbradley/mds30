
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <?php echo $this->Html->charset(); ?>
  <title>
    <?php 
    // firstname
    if (isset($this->data['SectionA']) && isset($this->data['Resident'])) {
      if (isset($this->data['SectionA']['A0500A']) && !empty($this->data['SectionA']['A0500A'])) $firstname = ucwords(strtolower($this->data['SectionA']['A0500A']));
      else $firstname = ucwords(strtolower($this->data['Resident']['PATFNAME']));
      // lastname
      if (isset($this->data['SectionA']['A0500C']) && !empty($this->data['SectionA']['A0500C'])) $lastname = ucwords(strtolower($this->data['SectionA']['A0500C']));
      else $lastname = ucwords(strtolower($this->data['Resident']['PATLNAME']));
      // set title
      echo $lastname .', '. $firstname;
    }
    else echo $title_for_layout .' | MDS 3';
    ?>
  </title>
  <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
  <?php
    echo $this->Html->meta('icon');
    echo $this->Html->css(array('default', 'printing'));
  ?>
  
  <style type="text/css">
    #content { background: #FFF; font-size: 9pt; }
    * { font-size: 9pt; }
    table tr td.header { width: 100%; display: table-cell; border-bottom: 0; }
    .page-break { page-break-after: always; }
  </style>
  <script type="text/javascript">
    window.print();
  </script>
</head>
<body>
  <div id="container">
    <div id="content">
      <?php 
      echo $content_for_layout;
      ?>
    </div>
  </div>
</body>
</html>