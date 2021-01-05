<script type="text/javascript">
  $(document).ready(function() {
    $('.ticket-body').hide();
    $('#0-body').show();
    
    <?php 
    foreach ($data as $key => $value): 
      echo "$('#".$key."-header td').click(function () { $('.ticket-body').hide(); $('#".$key."-body').show(); })" ."\n";
    endforeach; 
    ?>
  }); 
</script>
<h2>News &amp; Updates</h2>
<table class="results" cellspacing="0" cellpadding="0">
  <?php
  foreach ($data as $key => $value) {
    echo '<tr id="'. $key .'-header" class="ticket-header">';
    echo '  <td>'. $value['Ticket']['subject'] .' <span class="date">'. $this->Time->timeAgoInWords($value['Ticket']['created']) .'</span></td>';
    echo '</tr>';
    echo '<tr id="'. $key .'-body" class="ticket-body">';
    echo '  <td class="body">'. nl2br($value['Ticket']['body']). '</td>';
    echo '</tr>';
  }
  
  ?>  
</table>
<?php 
  if ($this->params['action'] == 'index') 
    echo $this->Html->link('View All News & Updates', array('action' => 'news')); 
?>
