<?php 
echo $this->Form->create('Survey', array('url' => '/forms/census_and_conditions/export/'. $facility, 'id' => 'survey_form')); 
?>
<table cellspacing="0" cellpadding="4" width="100%">

<tr><td colspan="9" class="header"><?php echo $this->data['details']['name']; ?></td></tr>

<tr>
    <td class="top"colspan="2">Provider No.</td>
    <td class="top">Medicare (F76)</td>
    <td class="top" colspan="3">Medicaid (F76)</td>
    <td class="top" colspan="2">Other (F77)</td>
    <td class="top">Total Residents (F78)</td>
</tr>
<tr>
    <td class="align-center data" style="border-top: 0; border-bottom: 0;" colspan="2"></td>
    <td class="align-center data" style="border-top: 0; border-bottom: 0;"><?php echo $this->Form->input('F75', array('div' => false, 'label' => false, 'size' => 2)); ?></td>
    <td class="align-center data" style="border-top: 0; border-bottom: 0;" colspan="3"><?php echo $this->Form->input('F76', array('div' => false, 'label' => false, 'size' => 2)); ?></td>
    <td class="align-center data" style="border-top: 0; border-bottom: 0;" colspan="2"><?php echo $this->Form->input('F77', array('div' => false, 'label' => false, 'size' => 2)); ?></td>
    <td class="align-center data" style="border-top: 0; border-bottom: 0;"><?php echo $this->Form->input('F78', array('div' => false, 'label' => false, 'size' => 2)); ?></td>
</tr>
<tr>
    <td class="bold">ADL</td>
    <td class="bold align-center" colspan="3">Independent</td>
    <td class="bold align-center" colspan="3">Assist of One or Two Staff</td>
    <td class="bold align-center" colspan="2">Dependent</td>
</tr>
<tr>
    <td>Bathing</td>
    <td class="column" width="50px">F79</td>
    <td class="align-center" style="border-left: 0;" colspan="2"><?php echo $this->Form->input('F79', array('div' => false, 'label' => false, 'size' => 2)); ?></td>
    <td class="column" width="50px">F80</td>
    <td class="align-center" style="border-left: 0;" colspan="2"><?php echo $this->Form->input('F80', array('div' => false, 'label' => false, 'size' => 2)); ?></td>
    <td class="column" width="50px">F81</td>
    <td class="align-center" style="border-left: 0;" ><?php echo $this->Form->input('F81', array('div' => false, 'label' => false, 'size' => 2)); ?></td>
</tr>
<tr>
    <td>Dressing</td>
    <td class="column" width="50px">F82</td>
    <td class="align-center" style="border-left: 0;" colspan="2"><?php echo $this->Form->input('F82', array('div' => false, 'label' => false, 'size' => 2)); ?></td>
    <td class="column" width="50px">F83</td>
    <td class="align-center" style="border-left: 0;" colspan="2"><?php echo $this->Form->input('F83', array('div' => false, 'label' => false, 'size' => 2)); ?></td>
    <td class="column" width="50px">F84</td>
    <td class="align-center" style="border-left: 0;" ><?php echo $this->Form->input('F84', array('div' => false, 'label' => false, 'size' => 2)); ?></td>
</tr>
<tr>
    <td>Transferring</td>
    <td class="column" width="50px">F85</td>
    <td class="align-center" style="border-left: 0;" colspan="2"><?php echo $this->Form->input('F85', array('div' => false, 'label' => false, 'size' => 2)); ?></td>
    <td class="column" width="50px">F86</td>
    <td class="align-center" style="border-left: 0;" colspan="2"><?php echo $this->Form->input('F86', array('div' => false, 'label' => false, 'size' => 2)); ?></td>
    <td class="column" width="50px">F87</td>
    <td class="align-center" style="border-left: 0;" ><?php echo $this->Form->input('F87', array('div' => false, 'label' => false, 'size' => 2)); ?></td>
</tr>
<tr>
    <td>Toilet Use</td>
    <td class="column" width="50px">F88</td>
    <td class="align-center" style="border-left: 0;" colspan="2"><?php echo $this->Form->input('F88', array('div' => false, 'label' => false, 'size' => 2)); ?></td>
    <td class="column" width="50px">F89</td>
    <td class="align-center" style="border-left: 0;" colspan="2"><?php echo $this->Form->input('F89', array('div' => false, 'label' => false, 'size' => 2)); ?></td>
    <td class="column" width="50px">F90</td>
    <td class="align-center" style="border-left: 0;" ><?php echo $this->Form->input('F90', array('div' => false, 'label' => false, 'size' => 2)); ?></td>
</tr>
<tr>
    <td>Eating</td>
    <td class="column" width="50px">F91</td>
    <td class="align-center" style="border-left: 0;" colspan="2"><?php echo $this->Form->input('F91', array('div' => false, 'label' => false, 'size' => 2)); ?></td>
    <td class="column" width="50px">F92</td>
    <td class="align-center" style="border-left: 0;" colspan="2"><?php echo $this->Form->input('F92', array('div' => false, 'label' => false, 'size' => 2)); ?></td>
    <td class="column" width="50px">F93</td>
    <td class="align-center" style="border-left: 0;" ><?php echo $this->Form->input('F93', array('div' => false, 'label' => false, 'size' => 2)); ?></td>
</tr>

<tr>
    <td style="border-top: 2px solid black;" colspan="5" class="fullsize" valign="top" width="50%">
        <strong>A. Bowel/Bladder Status</strong>

        <table cellspacing="0" border="0" class="noborder">
        <tr>
            <td width="40px">F94</td>
            <td> <?php echo $this->Form->input('F94', array('div' => false, 'label' => false, 'size' => 2)); ?> With indwelling or external catheter </td>
        </tr>
        <tr>
            <td>F95</td>
            <td> Of total number of residents with catheters, <?php echo $this->Form->input('F95', array('div' => false, 'label' => false, 'size' => 2)); ?> were present on admission. </td>
        </tr>
        <tr>
            <td>F96</td>
            <td> <?php echo $this->Form->input('F96', array('div' => false, 'label' => false, 'size' => 2)); ?> Occasionally or frequently incontinent of bladder </td>
        </tr>
        <tr>
            <td>F97</td>
            <td> <?php echo $this->Form->input('F97', array('div' => false, 'label' => false, 'size' => 2)); ?> Occasionally or frequently incontinent of bowel </td>
        </tr>
        <tr>
            <td>F98</td>
            <td> <?php echo $this->Form->input('F98', array('div' => false, 'label' => false, 'size' => 2)); ?> On individually written bladder training program </td>
        </tr>
        <tr>
            <td>F99</td>
            <td> <?php echo $this->Form->input('F99', array('div' => false, 'label' => false, 'size' => 2)); ?> On individually written bowel training program</td>
        </tr>
        </table>

    </td>
    <td style="border-top: 2px solid black; border-left: 2px solid black;" colspan="4" valign="top" width="50%">
        <strong>B. Mobility</strong>

        <table cellspacing="0" border="0" class="noborder">
        <tr>
            <td width="40px">F100</td>
            <td> <?php echo $this->Form->input('F100', array('div' => false, 'label' => false, 'size' => 2)); ?> Bedfast all or most of time </td>
        </tr>
        <tr>
            <td>F101</td>
            <td> <?php echo $this->Form->input('F101', array('div' => false, 'label' => false, 'size' => 2)); ?> In chair all or most of time </td>
        </tr>
        <tr>
            <td>F102</td>
            <td> <?php echo $this->Form->input('F102', array('div' => false, 'label' => false, 'size' => 2)); ?> Independently ambulatory </td>
        </tr>
        <tr>
            <td>F103</td>
            <td> <?php echo $this->Form->input('F103', array('div' => false, 'label' => false, 'size' => 2)); ?> Ambulation with assistance or assistive device </td>
        </tr>
        <tr>
            <td>F104</td>
            <td> <?php echo $this->Form->input('F104', array('div' => false, 'label' => false, 'size' => 2)); ?> Physically restrained </td>
        </tr>
        <tr>
            <td>F105</td>
            <td> Of total number of residents restrained, <?php echo $this->Form->input('F105', array('div' => false, 'label' => false, 'size' => 2)); ?> were admitted with orders for restraints.</td>
        </tr>
        <tr>
            <td>F106</td>
            <td> <?php echo $this->Form->input('F106', array('div' => false, 'label' => false, 'size' => 2)); ?> With contractures</td>
        </tr>
        <tr>
            <td>F107</td>
            <td> Of total number of residents with contractures, <?php echo $this->Form->input('F107', array('div' => false, 'label' => false, 'size' => 2)); ?> had contractures on admission.</td>
        </tr>
        </table>
    </td>
</tr>

<tr>
    <td style="border-top: 2px solid black;" colspan="5" class="fullsize" valign="top" width="50%">
        <strong>C. Mental Status</strong>

        <table cellspacing="0" border="0" class="noborder">
        <tr>
            <td width="40px">F108</td>
            <td> <?php echo $this->Form->input('F108', array('div' => false, 'label' => false, 'size' => 2)); ?> With mental retardation </td>
        </tr>
        <tr>
            <td>F109</td>
            <td> <?php echo $this->Form->input('F109', array('div' => false, 'label' => false, 'size' => 2)); ?> With documented signs and symptoms of depression </td>
        </tr>
        <tr>
            <td>F110</td>
            <td> <?php echo $this->Form->input('F110', array('div' => false, 'label' => false, 'size' => 2)); ?> With documented psychiatric diagnosis (exclude dementias and depression)  </td>
        </tr>
        <tr>
            <td>F111</td>
            <td> <?php echo $this->Form->input('F111', array('div' => false, 'label' => false, 'size' => 2)); ?> Dementia: multi-infarct, senile, Alzheimer’s type, or other than Alzheimer’s type  </td>
        </tr>
        <tr>
            <td>F112</td>
            <td> <?php echo $this->Form->input('F112', array('div' => false, 'label' => false, 'size' => 2)); ?> With behavioral symptoms  </td>
        </tr>
        <tr>
            <td>F113</td>
            <td> Of the total number of residents with behavioral symptoms, the total number receiving a behavior management program <?php echo $this->Form->input('F113', array('div' => false, 'label' => false, 'size' => 2)); ?>  </td>
        </tr>
        <tr>
            <td>F114</td>
            <td> <?php echo $this->Form->input('F114', array('div' => false, 'label' => false, 'size' => 2)); ?>   Receiving health rehabilitative services for MI/MR</td>
        </tr>
        </table>

    </td>
    <td style="border-top: 2px solid black; border-left: 2px solid black;" colspan="4" valign="top" width="50%">
        <strong>D. Skin Integrity</strong>

        <table cellspacing="0" border="0" class="noborder">
        <tr>
            <td width="40px">F115</td>
            <td> <?php echo $this->Form->input('F115', array('div' => false, 'label' => false, 'size' => 2)); ?> With pressure sores (exclude Stage I) </td>
        </tr>
        <tr>
            <td>F116</td>
            <td> Of the total number of residents with pressure sores excluding Stage I, how many residents had pressure sores on admission? <?php echo $this->Form->input('F116', array('div' => false, 'label' => false, 'size' => 2)); ?> </td>
        </tr>
        <tr>
            <td>F117</td>
            <td> <?php echo $this->Form->input('F117', array('div' => false, 'label' => false, 'size' => 2)); ?> Receiving preventive skin care </td>
        </tr>
        <tr>
            <td>F118</td>
            <td> <?php echo $this->Form->input('F118', array('div' => false, 'label' => false, 'size' => 2)); ?>  With rashes </td>
        </tr>
        </table>
    </td>
</tr>
</table>
<!-- insert print line -->
<div class="page-break"></div>
<table cellspacing="0" cellpadding="4" width="100%">
<tr>
    <td style="border-top: 2px solid black;" colspan="5" class="fullsize" valign="top" width="50%">
        <strong>E. Special Care</strong>

        <table cellspacing="0" border="0" class="noborder">
        <tr>
            <td width="40px">F119</td><td> <?php echo $this->Form->input('F119', array('div' => false, 'label' => false, 'size' => 2)); ?> Receiving hospice care benefit  </td>
        </tr>
        <tr>
            <td>F120</td><td> <?php echo $this->Form->input('F120', array('div' => false, 'label' => false, 'size' => 2)); ?> Receiving radiation therapy </td>
        </tr>
        <tr>
            <td>F121</td><td> <?php echo $this->Form->input('F121', array('div' => false, 'label' => false, 'size' => 2)); ?> Receiving chemotherapy   </td>
        </tr>
        <tr>
            <td>F122</td><td> <?php echo $this->Form->input('F122', array('div' => false, 'label' => false, 'size' => 2)); ?> Receiving dialysis   </td>
        </tr>
        <tr>
            <td>F123</td><td> <?php echo $this->Form->input('F123', array('div' => false, 'label' => false, 'size' => 2)); ?> Receiving intravenous therapy, parenteral nutrition, and/or blood transfusion </td>
        </tr>
        <tr>
            <td>F124</td><td> <?php echo $this->Form->input('F124', array('div' => false, 'label' => false, 'size' => 2)); ?> Receiving respiratory treatment </td>
        </tr>
        <tr>
            <td>F125</td><td> <?php echo $this->Form->input('F125', array('div' => false, 'label' => false, 'size' => 2)); ?> Receiving tracheostomy care </td>
        </tr>
        <tr>
            <td>F126</td><td> <?php echo $this->Form->input('F126', array('div' => false, 'label' => false, 'size' => 2)); ?>  Receiving ostomy care </td>
        </tr>
        </table>

    </td>
    <td style="border-top: 2px solid black; border-left: 2px solid black;" colspan="4" valign="top" width="50%">

        <table cellspacing="0" border="0" class="noborder">

        <tr>
            <td width="40px">F127</td><td> <?php echo $this->Form->input('F127', array('div' => false, 'label' => false, 'size' => 2)); ?> Receiving suctioning</td>
        </tr>
        <tr>
            <td>F128</td><td> <?php echo $this->Form->input('F128', array('div' => false, 'label' => false, 'size' => 2)); ?> Receiving injections (exclude vitamin B12 injections)</td>
        </tr>
        <tr>
            <td>F129</td><td> <?php echo $this->Form->input('F129', array('div' => false, 'label' => false, 'size' => 2)); ?> Receiving tube feedings</td>
        </tr>
        <tr>
            <td>F130</td><td> <?php echo $this->Form->input('F130', array('div' => false, 'label' => false, 'size' => 2)); ?> Receiving mechanically altered diets including pureed and all chopped food (not only meat)</td>
        </tr>
        <tr>
            <td>F131</td><td> <?php echo $this->Form->input('F131', array('div' => false, 'label' => false, 'size' => 2)); ?> Receiving specialized rehabilitative services (Physical therapy, speech-language therapy, occupational therapy)</td>
        </tr>
        <tr>
            <td>F132</td><td> <?php echo $this->Form->input('F132', array('div' => false, 'label' => false, 'size' => 2)); ?>  Assistive devices while eating</td>
        </tr>
        </table>
    </td>
</tr>
<tr>
    <td style="border-top: 2px solid black;" colspan="5" class="fullsize" valign="top" width="50%">
        <strong>F. Medications</strong>

        <table cellspacing="0" border="0" class="noborder">
        <tr>
            <td>F133</td><td> <?php echo $this->Form->input('F133', array('div' => false, 'label' => false, 'size' => 2)); ?> Receiving any psychoactive medication </td>
        </tr>
        <tr>
            <td>F134</td><td> <?php echo $this->Form->input('F134', array('div' => false, 'label' => false, 'size' => 2)); ?> Receiving antipsychotic medications </td>
        </tr>
        <tr>
            <td>F135</td><td> <?php echo $this->Form->input('F135', array('div' => false, 'label' => false, 'size' => 2)); ?> Receiving antianxiety medications </td>
        </tr>
        <tr>
            <td>F136</td><td> <?php echo $this->Form->input('F136', array('div' => false, 'label' => false, 'size' => 2)); ?> Receiving antidepressant medications </td>
        </tr>
        <tr>
            <td>F137</td><td> <?php echo $this->Form->input('F137', array('div' => false, 'label' => false, 'size' => 2)); ?>  Receiving hypnotic medications</td>
        </tr>
        <tr>
            <td width="40px">F138</td><td> <?php echo $this->Form->input('F138', array('div' => false, 'label' => false, 'size' => 2)); ?> Receiving antibiotics </td>
        </tr>
        <tr>
            <td>F139</td><td> <?php echo $this->Form->input('F139', array('div' => false, 'label' => false, 'size' => 2)); ?> On pain management program</td>
        </tr>
        </table>

    </td>
    <td style="border-top: 2px solid black; border-left: 2px solid black;" colspan="4" valign="top" width="50%">


        <table cellspacing="0" border="0" class="noborder">
        <tr>
            <td width="40px">F140</td><td> <?php echo $this->Form->input('F140', array('div' => false, 'label' => false, 'size' => 2)); ?> With unplanned significant weight loss/gain </td>
        </tr>
        <tr>
            <td>F141</td><td> <?php echo $this->Form->input('F141', array('div' => false, 'label' => false, 'size' => 2)); ?>   Who do not communicate in the dominant language of the facility (include those who use sign language) </td>
        </tr>
        <tr>
            <td>F142</td><td> <?php echo $this->Form->input('F142', array('div' => false, 'label' => false, 'size' => 2)); ?>  Who use non-oral communication devices </td>
        </tr>
        <tr>
            <td>F143</td><td> <?php echo $this->Form->input('F143', array('div' => false, 'label' => false, 'size' => 2)); ?>  With advance directives </td>
        </tr>
        <tr>
            <td>F144</td><td> <?php echo $this->Form->input('F144', array('div' => false, 'label' => false, 'size' => 2)); ?>  Received influenza immunization</td>
        </tr>
        <tr>
            <td>F145</td><td> <?php echo $this->Form->input('F145', array('div' => false, 'label' => false, 'size' => 2)); ?>  Received pneumococcal vaccine</td>
        </tr>
        </table>
    </td>
</tr>

<?php echo $this->element('census_conditions/_bottom'); ?>

</table>
<?php
echo $this->Form->submit('Print Form'); 
echo $this->Form->end();
?>