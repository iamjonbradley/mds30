
<div id="assessments">
  <ul>
    <li class="active">
      <a href="#">
        <?php 
        echo ucwords(strtolower($data['Resident']['RESNAME'])); 
        ?>        
      </a> 
    </li>
    <li>
      <a href="/assessments/start/<?php echo $data['Resident']['id']; ?>/<?php echo $data['Facility']['id']; ?>">
        New Assessment
      </a>    
    </li>
  </ul>
</div>
  <div id="section">
    
    <table cellspacing="0" cellpadding="0" width="100%">
      <tr>
        <td width="30%">          
          <h2>Resident Information</h2>
          <ul class="table"><li class="field">SSN</li><li>XXX-XX-<?php echo substr(str_replace('-', '', $data['Resident']['SSNUM']), 5, 4); ?></li></ul>
          <ul class="table"><li class="field">Age</li><li><?php echo $data['Resident']['AGE']; ?></li></ul>
          <ul class="table"><li class="field">Birth Date</li><li><?php echo $data['Resident']['BDATE']; ?></li></ul>
          <ul class="table"><li class="field">Birth Place</li><li><?php echo $data['Resident']['BPLACE']; ?></li></ul>
          
          <h2>General Information</h2>
          <ul class="table"><li class="field">Level of Care</li><li><?php echo $data['Resident']['LEVELOCARE']; ?></li></ul>
          <ul class="table"><li class="field">Station</li><li><?php echo $data['Resident']['STATION']; ?></li></ul>
          <ul class="table"><li class="field">Resident #</li><li><?php echo $data['Resident']['RESNO']; ?></li></ul>
          <ul class="table"><li class="field">Room #</li><li><?php echo $data['Resident']['ROOM']; ?></li></ul>
          <ul class="table"><li class="field">Bed #</li><li><?php echo $data['Resident']['BED']; ?></li></ul>
          
          <h2>Previous Address</h2>
          <ul class="table">
            <li class="field align-top">Address</li>
            <li>
              <?php echo $data['Resident']['ADDRESS1']; ?>  <?php echo $data['Resident']['ADDRESS2']; ?> <br />
              <?php echo $data['Resident']['CITY']; ?>, <?php echo $data['Resident']['STATE']; ?> <?php echo $data['Resident']['ZIP']; ?> <br />
              <?php echo $data['Resident']['COUNTRY']; ?>
            </li>
          </ul>
          <ul class="table"><li class="field">Home Phone</li><li><?php echo $data['Resident']['PHONEH']; ?></li></ul>
          <ul class="table"><li class="field">Work Phone</li><li><?php echo $data['Resident']['PHONEW']; ?></li></ul>
        </td>
        
        <td class="spacer">&nbsp;</td>
        
        <td width="30%">
          <h2>Demographics</h2>
          <ul class="table"><li class="field">Race</li><li><?php echo $data['Resident']['RACE']; ?></li></ul>
          <ul class="table"><li class="field">Nationality</li><li><?php echo $data['Resident']['CITIZEN']; ?></li></ul>
          <ul class="table"><li class="field">Citizen</li><li><?php echo $data['Resident']['NATNLTY']; ?></li></ul>
          <ul class="table"><li class="field">Religion</li><li><?php echo $data['Resident']['RELIGION']; ?></li></ul>
          <ul class="table"><li class="field">Gender</li><li><?php echo $data['Resident']['SEX']; ?></li></ul>
          <ul class="table"><li class="field">Marriage Status</li><li><?php echo $data['Resident']['MARSTAT']; ?></li></ul>
          
          <?php if ($data['Resident']['MARSTAT'] == 'M') { ?>
            <h2>Spouse Information</h2>
            <ul class="table"><li class="field">Name</li><li><?php echo $data['Resident']['SPOUSNAM']; ?></li></ul>
            <ul class="table"><li class="field">Address</li><li><?php echo $data['Resident']['SPOUSADR']; ?></li></ul>
            <ul class="table"><li class="field">Phone</li><li><?php echo $data['Resident']['SPOUSPHON']; ?></li></ul>
            <ul class="table"><li class="field">Living</li><li><?php echo $data['Resident']['SPOUSLIV']; ?></li></ul>
          <?php } ?>        
        </td>
        
        <td class="spacer">&nbsp;</td>
        
        <td width="30%">
          <h2>Billing Information</h2>
          <ul class="table"><li class="field">Medicare</li><li><?php echo $data['Resident']['MEDICARE']; ?></li></ul>
          <ul class="table"><li class="field">Medicare Part A</li><li><?php echo $data['Resident']['PARTSA']; ?></li></ul>
          <ul class="table"><li class="field">Medicare Part B</li><li><?php echo $data['Resident']['PARTSB']; ?></li></ul>
          <ul class="table"><li class="field">Medicaid</li><li><?php echo $data['Resident']['MEDICAID']; ?></li></ul>
          
          <?php if ($data['Resident']['FRNAME'] != '                         ') { ?>
            <h2>Financial Resp. Party</h2>
            <ul class="table"><li class="field">1st Name</li><li><?php echo $data['Resident']['FRNAME']; ?></li></ul>
            <ul class="table"><li class="field">1st Relation</li><li><?php echo $data['Resident']['FRELAT']; ?></li></ul>
            <ul class="table"><li class="field">1st Address</li><li><?php echo $data['Resident']['FRADR']; ?></li></ul>
            <ul class="table"><li class="field">1st Phone Home</li><li><?php echo $data['Resident']['FRPHONEH']; ?></li></ul>
            <ul class="table"><li class="field">1st Phone Work</li><li><?php echo $data['Resident']['FRPHONEW']; ?></li></ul>
            <ul class="table"><li class="field">1st City</li><li><?php echo $data['Resident']['FRCITY']; ?></li></ul>
            <?php if ($data['Resident']['FRNAME2'] != '                         ') { ?>
              <ul class="table"><li class="field">2nd Name</li><li><?php echo $data['Resident']['FRNAME2']; ?></li></ul>
              <ul class="table"><li class="field">2nd Relation</li><li><?php echo $data['Resident']['FRELAT2']; ?></li></ul>
              <ul class="table"><li class="field">2nd Address</li><li><?php echo $data['Resident']['FRADR2']; ?></li></ul>
              <ul class="table"><li class="field">2nd City/State/Zip</li><li><?php echo $data['Resident']['FRCSZ2']; ?></li></ul>
              <ul class="table"><li class="field">2nd Phone Home</li><li><?php echo $data['Resident']['FRPHH2']; ?></li></ul>
              <ul class="table"><li class="field">2nd Phone Work</li><li><?php echo $data['Resident']['FRPHW2']; ?></li></ul>
            <?php } ?> 
          <?php } ?>
        </td>
      </tr>
    </table>
  </div>
  <!--
  <div id="patient">
    <ul>
      <li class="active"><a href="/residents/view/<?php echo $data['Resident']['PATNUM']; ?>"><img src="/img/medical/general_info.png" /></a></li>     
      <li><a href="/residents/view/<?php echo $data['Resident']['PATNUM']; ?>/physicians"><img src="/img/medical/physicians.png" /></a></li>
      <li><a href="/residents/view/<?php echo $data['Resident']['PATNUM']; ?>/emergency"><img src="/img/medical/emergency.png" /></a></li>       
      <li><a href="/residents/view/<?php echo $data['Resident']['PATNUM']; ?>/allergy"><img src="/img/medical/allergy.png" /></a></li>      
      <li><a href="/residents/view/<?php echo $data['Resident']['PATNUM']; ?>/diagnosis"><img src="/img/medical/diagnosis.png" /></a></li>
    </ul>
    
  </div>
  -->
</div>