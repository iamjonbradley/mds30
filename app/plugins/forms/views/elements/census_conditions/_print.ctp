<table cellspacing="0" cellpadding="4" width="100%">

<tr><td colspan="9" class="header">Resident Census and Conditions of Residents</td></tr>

<tr>
    <td class="top"colspan="2">Provider No.</td>
    <td class="top">Medicare (F76)</td>
    <td class="top" colspan="3">Medicaid (F76)</td>
    <td class="top" colspan="2">Other (F77)</td>
    <td class="top">Total Residents (F78)</td>
</tr>
<tr>
    <td class="align-center data" style="border-top: 0; border-bottom: 0;" colspan="2"></td>
    <td class="align-center data" style="border-top: 0; border-bottom: 0;"><?php echo $this->data['Survey']['F75']; ?></td>
    <td class="align-center data" style="border-top: 0; border-bottom: 0;" colspan="3"><?php echo $this->data['Survey']['F76']; ?></td>
    <td class="align-center data" style="border-top: 0; border-bottom: 0;" colspan="2"><?php echo $this->data['Survey']['F77']; ?></td>
    <td class="align-center data" style="border-top: 0; border-bottom: 0;"><?php echo $this->data['Survey']['F78']; ?></td>
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
    <td class="align-center" style="border-left: 0;" colspan="2"><?php echo $this->data['Survey']['F79']; ?></td>
    <td class="column" width="50px">F80</td>
    <td class="align-center" style="border-left: 0;" colspan="2"><?php echo $this->data['Survey']['F80']; ?></td>
    <td class="column" width="50px">F81</td>
    <td class="align-center" style="border-left: 0;" ><?php echo $this->data['Survey']['F81']; ?></td>
</tr>
<tr>
    <td>Dressing</td>
    <td class="column" width="50px">F82</td>
    <td class="align-center" style="border-left: 0;" colspan="2"><?php echo $this->data['Survey']['F82']; ?></td>
    <td class="column" width="50px">F83</td>
    <td class="align-center" style="border-left: 0;" colspan="2"><?php echo $this->data['Survey']['F83']; ?></td>
    <td class="column" width="50px">F84</td>
    <td class="align-center" style="border-left: 0;" ><?php echo $this->data['Survey']['F84']; ?></td>
</tr>
<tr>
    <td>Transferring</td>
    <td class="column" width="50px">F85</td>
    <td class="align-center" style="border-left: 0;" colspan="2"><?php echo $this->data['Survey']['F85']; ?></td>
    <td class="column" width="50px">F86</td>
    <td class="align-center" style="border-left: 0;" colspan="2"><?php echo $this->data['Survey']['F86']; ?></td>
    <td class="column" width="50px">F87</td>
    <td class="align-center" style="border-left: 0;" ><?php echo $this->data['Survey']['F87']; ?></td>
</tr>
<tr>
    <td>Toilet Use</td>
    <td class="column" width="50px">F88</td>
    <td class="align-center" style="border-left: 0;" colspan="2"><?php echo $this->data['Survey']['F88']; ?></td>
    <td class="column" width="50px">F89</td>
    <td class="align-center" style="border-left: 0;" colspan="2"><?php echo $this->data['Survey']['F89']; ?></td>
    <td class="column" width="50px">F90</td>
    <td class="align-center" style="border-left: 0;" ><?php echo $this->data['Survey']['F90']; ?></td>
</tr>
<tr>
    <td>Eating</td>
    <td class="column" width="50px">F91</td>
    <td class="align-center" style="border-left: 0;" colspan="2"><?php echo $this->data['Survey']['F91']; ?></td>
    <td class="column" width="50px">F92</td>
    <td class="align-center" style="border-left: 0;" colspan="2"><?php echo $this->data['Survey']['F92']; ?></td>
    <td class="column" width="50px">F93</td>
    <td class="align-center" style="border-left: 0;" ><?php echo $this->data['Survey']['F93']; ?></td>
</tr>

<tr>
    <td style="border-top: 2px solid black;" colspan="5" class="fullsize" valign="top" width="50%">
        <strong>A. Bowel/Bladder Status</strong>

        <table cellspacing="0" border="0" class="noborder">
        <tr>
            <td width="40px">F94</td>
            <td> __<?php echo $this->data['Survey']['F94']; ?>__ With indwelling or external catheter </td>
        </tr>
        <tr>
            <td>F95</td>
            <td> Of total number of residents with catheters, __<?php echo $this->data['Survey']['F95']; ?>__ were present on admission. </td>
        </tr>
        <tr>
            <td>F96</td>
            <td> __<?php echo $this->data['Survey']['F96']; ?>__ Occasionally or frequently incontinent of bladder </td>
        </tr>
        <tr>
            <td>F97</td>
            <td> __<?php echo $this->data['Survey']['F97']; ?>__ Occasionally or frequently incontinent of bowel </td>
        </tr>
        <tr>
            <td>F98</td>
            <td> __<?php echo $this->data['Survey']['F98']; ?>__ On individually written bladder training program </td>
        </tr>
        <tr>
            <td>F99</td>
            <td> __<?php echo $this->data['Survey']['F99']; ?>__ On individually written bowel training program</td>
        </tr>
        </table>

    </td>
    <td style="border-top: 2px solid black; border-left: 2px solid black;" colspan="4" valign="top" width="50%">
        <strong>B. Mobility</strong>

        <table cellspacing="0" border="0" class="noborder">
        <tr>
            <td width="40px">F100</td>
            <td> __<?php echo $this->data['Survey']['F100']; ?>__ Bedfast all or most of time </td>
        </tr>
        <tr>
            <td>F101</td>
            <td> __<?php echo $this->data['Survey']['F101']; ?>__ In chair all or most of time </td>
        </tr>
        <tr>
            <td>F102</td>
            <td> __<?php echo $this->data['Survey']['F102']; ?>__ Independently ambulatory </td>
        </tr>
        <tr>
            <td>F103</td>
            <td> __<?php echo $this->data['Survey']['F103']; ?>__ Ambulation with assistance or assistive device </td>
        </tr>
        <tr>
            <td>F104</td>
            <td> __<?php echo $this->data['Survey']['F104']; ?>__ Physically restrained </td>
        </tr>
        <tr>
            <td>F105</td>
            <td> Of total number of residents restrained, __<?php echo $this->data['Survey']['F105']; ?>__ were admitted with orders for restraints.</td>
        </tr>
        <tr>
            <td>F106</td>
            <td> __<?php echo $this->data['Survey']['F106']; ?>__ With contractures</td>
        </tr>
        <tr>
            <td>F107</td>
            <td> Of total number of residents with contractures, __<?php echo $this->data['Survey']['F107']; ?>__ had contractures on admission.</td>
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
            <td> __<?php echo $this->data['Survey']['F108']; ?>__ With mental retardation </td>
        </tr>
        <tr>
            <td>F109</td>
            <td> __<?php echo $this->data['Survey']['F109']; ?>__ With documented signs and symptoms of depression </td>
        </tr>
        <tr>
            <td>F110</td>
            <td> __<?php echo $this->data['Survey']['F110']; ?>__ With documented psychiatric diagnosis (exclude dementias and depression)  </td>
        </tr>
        <tr>
            <td>F111</td>
            <td> __<?php echo $this->data['Survey']['F111']; ?>__ Dementia: multi-infarct, senile, Alzheimer’s type, or other than Alzheimer’s type  </td>
        </tr>
        <tr>
            <td>F112</td>
            <td> __<?php echo $this->data['Survey']['F112']; ?>__ With behavioral symptoms  </td>
        </tr>
        <tr>
            <td>F113</td>
            <td> Of the total number of residents with behavioral symptoms, the total number receiving a behavior management program __<?php echo $this->data['Survey']['F113']; ?>__ </td>
        </tr>
        <tr>
            <td>F114</td>
            <td> __<?php echo $this->data['Survey']['F114']; ?>__  Receiving health rehabilitative services for MI/MR</td>
        </tr>
        </table>

    </td>
    <td style="border-top: 2px solid black; border-left: 2px solid black;" colspan="4" valign="top" width="50%">
        <strong>D. Skin Integrity</strong>

        <table cellspacing="0" border="0" class="noborder">
        <tr>
            <td width="40px">F115</td>
            <td> __<?php echo $this->data['Survey']['F115']; ?>__ With pressure sores (exclude Stage I) </td>
        </tr>
        <tr>
            <td>F116</td>
            <td> Of the total number of residents with pressure sores excluding Stage I, how many residents had pressure sores on admission? __<?php echo $this->data['Survey']['F116']; ?>__ </td>
        </tr>
        <tr>
            <td>F117</td>
            <td> __<?php echo $this->data['Survey']['F117']; ?>__ Receiving preventive skin care </td>
        </tr>
        <tr>
            <td>F118</td>
            <td> __<?php echo $this->data['Survey']['F118']; ?>__ With rashes </td>
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
            <td width="40px">F119</td><td> __<?php echo $this->data['Survey']['F119']; ?>__ Receiving hospice care benefit  </td>
        </tr>
        <tr>
            <td>F120</td><td> __<?php echo $this->data['Survey']['F120']; ?>__ Receiving radiation therapy </td>
        </tr>
        <tr>
            <td>F121</td><td> __<?php echo $this->data['Survey']['F121']; ?>__ Receiving chemotherapy   </td>
        </tr>
        <tr>
            <td>F122</td><td> __<?php echo $this->data['Survey']['F122']; ?>__ Receiving dialysis   </td>
        </tr>
        <tr>
            <td>F123</td><td> __<?php echo $this->data['Survey']['F123']; ?>__ Receiving intravenous therapy, parenteral nutrition, and/or blood transfusion </td>
        </tr>
        <tr>
            <td>F124</td><td> __<?php echo $this->data['Survey']['F124']; ?>__ Receiving respiratory treatment </td>
        </tr>
        <tr>
            <td>F125</td><td> __<?php echo $this->data['Survey']['F125']; ?>__ Receiving tracheostomy care </td>
        </tr>
        <tr>
            <td>F126</td><td> __<?php echo $this->data['Survey']['F126']; ?>__ Receiving ostomy care </td>
        </tr>
        </table>

    </td>
    <td style="border-top: 2px solid black; border-left: 2px solid black;" colspan="4" valign="top" width="50%">

        <table cellspacing="0" border="0" class="noborder">

        <tr>
            <td width="40px">F127</td><td> __<?php echo $this->data['Survey']['F127']; ?>__ Receiving suctioning</td>
        </tr>
        <tr>
            <td>F128</td><td> __<?php echo $this->data['Survey']['F128']; ?>__ Receiving injections (exclude vitamin B12 injections)</td>
        </tr>
        <tr>
            <td>F129</td><td> __<?php echo $this->data['Survey']['F129']; ?>__ Receiving tube feedings</td>
        </tr>
        <tr>
            <td>F130</td><td> __<?php echo $this->data['Survey']['F130']; ?>__ Receiving mechanically altered diets including pureed and all chopped food (not only meat)</td>
        </tr>
        <tr>
            <td>F131</td><td> __<?php echo $this->data['Survey']['F131']; ?>__ Receiving specialized rehabilitative services (Physical therapy, speech-language therapy, occupational therapy)</td>
        </tr>
        <tr>
            <td>F132</td><td> __<?php echo $this->data['Survey']['F132']; ?>__ Assistive devices while eating</td>
        </tr>
        </table>
    </td>
</tr>
<tr>
    <td style="border-top: 2px solid black;" colspan="5" class="fullsize" valign="top" width="50%">
        <strong>F. Medications</strong>

        <table cellspacing="0" border="0" class="noborder">
        <tr>
            <td>F133</td><td> __<?php echo $this->data['Survey']['F133']; ?>__ Receiving any psychoactive medication </td>
        </tr>
        <tr>
            <td>F134</td><td> __<?php echo $this->data['Survey']['F134']; ?>__ Receiving antipsychotic medications </td>
        </tr>
        <tr>
            <td>F135</td><td> __<?php echo $this->data['Survey']['F135']; ?>__ Receiving antianxiety medications </td>
        </tr>
        <tr>
            <td>F136</td><td> __<?php echo $this->data['Survey']['F136']; ?>__ Receiving antidepressant medications </td>
        </tr>
        <tr>
            <td>F137</td><td> __<?php echo $this->data['Survey']['F137']; ?>__  Receiving hypnotic medications</td>
        </tr>
        <tr>
            <td width="40px">F138</td><td> __<?php echo $this->data['Survey']['F138']; ?>__ Receiving antibiotics </td>
        </tr>
        <tr>
            <td>F139</td><td> __<?php echo $this->data['Survey']['F139']; ?>__ On pain management program</td>
        </tr>
        </table>

    </td>
    <td style="border-top: 2px solid black; border-left: 2px solid black;" colspan="4" valign="top" width="50%">


        <table cellspacing="0" border="0" class="noborder">
        <tr>
            <td width="40px">F140</td><td> __<?php echo $this->data['Survey']['F140']; ?>__ With unplanned significant weight loss/gain </td>
        </tr>
        <tr>
            <td>F141</td><td> __<?php echo $this->data['Survey']['F141']; ?>__  Who do not communicate in the dominant language of the facility (include those who use sign language) </td>
        </tr>
        <tr>
            <td>F142</td><td> __<?php echo $this->data['Survey']['F142']; ?>__  Who use non-oral communication devices </td>
        </tr>
        <tr>
            <td>F143</td><td> __<?php echo $this->data['Survey']['F143']; ?>__  With advance directives </td>
        </tr>
        <tr>
            <td>F144</td><td> __<?php echo $this->data['Survey']['F144']; ?>__  Received influenza immunization</td>
        </tr>
        <tr>
            <td>F145</td><td> __<?php echo $this->data['Survey']['F145']; ?>__  Received pneumococcal vaccine</td>
        </tr>
        </table>
    </td>
</tr>

<?php echo $this->element('census_conditions/_bottom'); ?>

</table>