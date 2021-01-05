<a href="/printing/view/<?php echo $this->data['Assessment']['type']; ?>/<?php echo $this->data['Assessment']['id']; ?>" target="new">
  <img alt="view" class="float-right" src="/img/actions/printer.png" />
</a>

<h2>Review &amp; Finalize Assessment</h2>

<div class="header">Validation Report</div>

<table class="results" cellspacing="0">
  <tr>
    <td style="width: 150px; font-size: 10pt;  text-align: left; font-weight: bold;">Assessment Type</td>
    <td style="font-size: 10pt; text-align: left"><?php echo $this->AssessmentType->get($this->data); ?></td>
  </tr>
  <tr>
    <td style="font-size: 10pt;  text-align: left; font-weight: bold;">Resident</td>
    <td style="font-size: 10pt; text-align: left"><?php echo $this->data['Resident']['PATLNAME']; ?>, <?php echo $this->data['Resident']['PATFNAME']; ?></td>
  </tr>
  <tr>
    <td style="font-size: 10pt;  text-align: left; font-weight: bold;">Resident ID #</td>
    <td style="font-size: 10pt; text-align: left"><?php echo $this->data['Resident']['PATNUM']; ?></td>
  </tr>
  <tr>
    <td style="font-size: 10pt;  text-align: left; font-weight: bold;">Assessment ID #</td>
    <td style="font-size: 10pt; text-align: left"><?php echo $this->data['Assessment']['id']; ?></td>
  </tr>
  <tr>
    <td style="font-size: 10pt;  text-align: left; font-weight: bold;">ARD</td>
    <td style="font-size: 10pt; text-align: left">
      <?php
        echo $this->data['SectionA']['A2300']; 
       ?>
    </td>
  </tr>
  <tr>
    <td style="font-size: 10pt;  text-align: left; font-weight: bold;">Lock Date</td>
    <td style="font-size: 10pt; text-align: left"><?php echo $this->data['Assessment']['lock_date']; ?></td>
  </tr>
  <tr>
    <td style="font-size: 10pt;  text-align: left; font-weight: bold;">Record Type</td>
    <td style="font-size: 10pt; text-align: left">
      <?php 
      switch ($this->data['SectionX']['X0100']) {
        case 1: $type = 'NEW'; break;  
        case 2: $type = 'MODIFICATION'; break;  
        case 3: $type = 'INACTIVATION'; break;  
        default: $type = '';
      }
      echo $type;
      ?>
      
    </td>
  </tr>
  <tr>
    <td style="font-size: 10pt;  text-align: left; font-weight: bold;">Facility</td>
    <td style="font-size: 10pt; text-align: left"><?php echo $this->data['Facility']['FNAME']; ?></td>
  </tr>
  <?php if ($this->data['Assessment']['type'] != 'NT') { ?>
  <tr>
    <td style="font-size: 10pt;  text-align: left; font-weight: bold;">Part A Short Stay</td>
    <td style="font-size: 10pt; text-align: left"><?php if ($rug['sot'] == false) echo 'NO'; else echo 'YES'; ?></td>
  </tr>
  <tr>
    <td style="font-size: 10pt;  text-align: left; font-weight: bold;">Therapy Minutes</td>
    <td style="font-size: 10pt; text-align: left"><?php echo $rug['minutes']; ?></td>
  </tr>
  <tr>
    <td style="font-size: 10pt;  text-align: left; font-weight: bold;">ADL</td>
    <td style="font-size: 10pt; text-align: left"><?php echo $rug['adl']; ?></td>
  </tr>
  <tr>
    <td style="font-size: 10pt;  text-align: left; font-weight: bold;">Therapy Score</td>
    <td style="font-size: 10pt; text-align: left"><?php echo $rug['therapy']['score']; ?></td>
  </tr>
  <tr>
    <td style="font-size: 10pt;  text-align: left; font-weight: bold;">Therapy Rate *</td>
    <td style="font-size: 10pt; text-align: left"><?php echo $this->Number->currency($rug['therapy']['rate'], 'USD'); ; ?></td>
  </tr>
  <tr>
    <td style="font-size: 10pt;  text-align: left; font-weight: bold;">Non-Therapy Score</td>
    <td style="font-size: 10pt; text-align: left"><?php echo $rug['nursing']['score']; ?></td>
  </tr>
  <tr>
    <td style="font-size: 10pt;  text-align: left; font-weight: bold;">Non-Therapy Rate *</td>
    <td style="font-size: 10pt; text-align: left"><?php echo $this->Number->currency($rug['nursing']['rate'], 'USD'); ; ?></td>
  </tr>
  <?php } ?>
  <?php if ($this->data['Assessment']['locked'] == 1) { ?>
  <tr>
    <td style="font-size: 10pt;  text-align: left; font-weight: bold;">
      Transmission File
      <?php if ($this->data['Assessment']['transmission_status'] != 2) { ?>
       <br /> <span class="small">( <a href="/assessments/regenerate/<?php echo $this->data['Assessment']['id']; ?>/<?php echo $this->data['Facility']['F_STATE']; ?>">regenerate</a> )</span>
      <?php } ?>
    </td>
    <td style="font-size: 10pt; text-align: left">
      <a href="/transmission_files/pending/<?php echo $this->data['Assessment']['id']; ?>.xml" target="new">click here</a>
    </td>
  </tr>
  <tr>
    <td style="font-size: 10pt;  text-align: left; font-weight: bold;">
      Transmission Status
    </td>
    <td style="font-size: 10pt; text-align: left">
      <?php
      $url = '';
      ?>
      <?php 
      // if ($this->data['Assessment']['transmission_status'] != 2 || $this->Session->read('Auth.User.id') > 3) { 
      ?>
      <select name="data['Assessment][transmission_status]"  onchange="location.href='/assessments/update/<?php echo $this->data['Assessment']['id'] ?>/'+this.options[this.selectedIndex].value">
        <option value=0 <?php if ($this->data['Assessment']['transmission_status'] == 0) echo 'selected="selected"' ?>>Not Transmitted</option>
        <option value=1 <?php if ($this->data['Assessment']['transmission_status'] == 1) echo 'selected="selected"' ?>>Transmitted</option>
        <option value=2 <?php if ($this->data['Assessment']['transmission_status'] == 2) echo 'selected="selected"' ?>>Accepted</option>
        <option value=3 <?php if ($this->data['Assessment']['transmission_status'] == 3) echo 'selected="selected"' ?>>Rejected</option>
      </select>
      <?php 
      // } else { 
      //   echo 'Accepted';
      // }  
      ?>
    </td>
  </tr>
  <?php } ?>
</table>
<div class="small">* This is an estimate and are based upon current information as of 10/22/2010.</div>

<?php if ($this->data['Assessment']['transmission_status'] != 1) { ?>
<div>
  <h3>Finalize Assessment</h3>
  <strong>
    Is this information correct? If this information is correct, please click finalize assessment, otherwise please go back and review the items that were 
    submitted before continuing.
  </strong>
</div>
<?php } ?>
