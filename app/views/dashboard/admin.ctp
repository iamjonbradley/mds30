<table width="100%">
  <tr>
    <td valign="top" style="width: 48%">
      <?php echo $this->element('../dashboard/admin/quick-jump'); ?>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <?php echo $this->element('../dashboard/admin/assessment-counts', array('data' => $results['assessments'])); ?>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <?php echo $this->Html->link('View User Dashboard', '/dashboard'); ?>
    </td>
    <td>&nbsp;</td>
    <td valign="top" style="width: 48%">
      <?php echo $this->element('../dashboard/admin/online-users', array('data' => $results['online'])); ?>
    </td>
  </tr>  
</table>