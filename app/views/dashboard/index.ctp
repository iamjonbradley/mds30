<table width="100%">
  <tr>
    <td valign="top" style="width: 48%">
      <?php 
      if (!in_array($this->Session->read('Auth.User.group_id'), array(4,5,9))) {
        echo $this->element('../dashboard/_midnight_rule'); 
        echo '<p>&nbsp;</p>';
      } 

      echo $this->element('../dashboard/_news-and-updates', array('data' => $results['tickets']));
      ?>
      
    </td>
    <td>&nbsp;</td>
    <td valign="top" style="width: 48%">
      <?php echo $this->element('../dashboard/_assessment-counts', array('data' => $results['assessments'])); ?>
    </td>
  </tr>  
</table>