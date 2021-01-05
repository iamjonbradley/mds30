
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
    html { background-color: #FFF; }
	  #content { background: #FFF; font-size: 9pt; }
	  * { font-size: 9pt; }
	  .float-left { float: none; }
    .header { 
      font-weight: bold; 
      border:0; 
      border-bottom: 2px solid #000; 
      background-color: #FFF; 
      padding: 5px; 
      margin: 4px 0; 
      font-size: 10pt;
    }
    .header-signature { { float: none; }
    .header { 
      font-weight: bold; 
      border:0; 
      border-bottom: 2px solid #000; 
      background-color: #FFF; 
      padding: 5px; 
      margin: 4px 0; 
      font-size: 10pt;
    }
    input, select {
      border: 1px #FFF solid;
      border-bottom: 1px solid #CCC; 
      font-size: 9pt;
    }
    div.radio label { font-weight: normal;}
    fieldset legend  {font-size: 9pt;}
	  p { margin: 5px 0;}
    .input {
      display: block;
      clear: both;
      padding-bottom: 5px;
    }
    .float-left {
      display: block;
      float: left;
      clear: none;
      padding-right: 20px;
    }
    .float-left label {
      clear: right;
    }
  .float-single label {
    display: block;
    float: left;
    width: 200px;
  }
	</style>
  <?php
  echo $this->Html->script(array('jquery-1.4.2.min.js','jquery.rotate.1-1')); 

    echo $this->Html->script('jquery-1.7.2.min.js');
    echo $this->Html->script('jquery.calculation.js');
    echo $this->Html->script('tooltip.js');
    echo $this->Html->script('menu.js');
    echo $this->Html->script('skip.js');
    echo $this->Html->script('application.js');

  
  ?>
	<script type="text/javascript">
    window.print();
	</script>
</head>
<body>
	<div id="container">
		<div id="content">
			<?php 
			echo $this->Session->flash();

      $find = array(
          '<td valign="top" class="spacer">&nbsp;</td>',
          '<td valign="top" width="48%" valign="top">',
          'type="radio"',
          'Format as MMDDYYYY',
          '<br>',
          '<br />',
          'Format as YYYY-MM-DD'
        );

      $replace = array(
          '</tr><tr>',
          '<td valign="top" valign="top">',
          'type="checkbox"',
          '',
          '',
          '',
          ''
        );
      $content_for_layout = str_replace($find, $replace, $content_for_layout); 
      echo $content_for_layout;
      ?>
		</div>
	</div>
</body>
</html>