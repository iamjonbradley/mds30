$(document).ready(function() {   

  skipPatterns ();

  /****************************** 
             SECTION A
  *******************************/
  // A1100A

  $('#A0050').change(function () { skipPatterns (); });
  $('#A1100A').change(function () { skipPatterns (); });
  $('#A0310A').change(function () { skipPatterns (); });
  $('#A0310F').change(function () { skipPatterns (); });
  $('#A2400A').change(function () { skipPatterns (); });

  /****************************** 
             SECTION B
  *******************************/

  $('#B0100').change(function () { skipPatterns (); });

  /****************************** 
             SECTION C
  *******************************/

  $('#C0100').change(function () { skipPatterns (); });
  $('#C0200').change(function () { skipPatterns (); });
  $('#C0300A').change(function () { skipPatterns (); });
  $('#C0300B').change(function () { skipPatterns (); });
  $('#C0300C').change(function () { skipPatterns (); });
  $('#C0400A').change(function () { skipPatterns (); });
  $('#C0400B').change(function () { skipPatterns (); });
  $('#C0400C').change(function () { skipPatterns (); });
  $('#C0500').change(function () { skipPatterns (); });
  $('#C0500').keyup(function () { skipPatterns (); });

  /****************************** 
             SECTION D
  *******************************/

  $('#D0100').change(function () { skipPatterns (); });
  $('#D0200A1').change(function () { skipPatterns (); });
  $('#D0200B1').change(function () { skipPatterns (); });
  $('#D0200C1').change(function () { skipPatterns (); });
  $('#D0200D1').change(function () { skipPatterns (); });
  $('#D0200E1').change(function () { skipPatterns (); });
  $('#D0200F1').change(function () { skipPatterns (); });
  $('#D0200G1').change(function () { skipPatterns (); });
  $('#D0200H1').change(function () { skipPatterns (); });
  $('#D0200I1').change(function () { skipPatterns (); });

  $('#D0200A2').change(function () { skipPatterns (); });
  $('#D0200B2').change(function () { skipPatterns (); });
  $('#D0200C2').change(function () { skipPatterns (); });
  $('#D0200D2').change(function () { skipPatterns (); });
  $('#D0200E2').change(function () { skipPatterns (); });
  $('#D0200F2').change(function () { skipPatterns (); });
  $('#D0200G2').change(function () { skipPatterns (); });
  $('#D0200H2').change(function () { skipPatterns (); });
  $('#D0200I2').change(function () { skipPatterns (); });

  $('#D0300').change(function () { skipPatterns (); });
  $('#D0300').keyup(function () { skipPatterns (); });
  $('#D0500I1').change(function () { skipPatterns (); });
  $('#D0500A2').change(function () { skipPatterns (); });
  $('#D0500B2').change(function () { skipPatterns (); });
  $('#D0500C2').change(function () { skipPatterns (); });
  $('#D0500D2').change(function () { skipPatterns (); });
  $('#D0500E2').change(function () { skipPatterns (); });
  $('#D0500F2').change(function () { skipPatterns (); });
  $('#D0500G2').change(function () { skipPatterns (); });
  $('#D0500H2').change(function () { skipPatterns (); });
  $('#D0500I2').change(function () { skipPatterns (); });
  $('#D0500J2').change(function () { skipPatterns (); });
    
  /****************************** 
             SECTION E
  *******************************/

  $('#E0200A').change(function () { skipPatterns (); });
  $('#E0200B').change(function () { skipPatterns (); });
  $('#E0200C').change(function () { skipPatterns (); });
  $('#E0300').change(function () { skipPatterns (); });
  $('#E0900').change(function () { skipPatterns (); });
    
  /****************************** 
             SECTION F
  *******************************/

  $('#F0300').change(function () { skipPatterns (); });
  $('#F0700').change(function () { skipPatterns (); });

  if ($('#AssessmentType').val() == 'NQ' && $('#AssessmentItemSubset').val() == '1.10') {
    $('.section-f').hide();
  }
    
  /****************************** 
             SECTION G
  *******************************/

  // NO SKIP PATTERNS
    
  /****************************** 
             SECTION H
  *******************************/

  $('#H0200A').change(function () { skipPatterns (); });
    
  /****************************** 
             SECTION I
  *******************************/

  // NO SKIP PATTERNS
    
  /****************************** 
             SECTION J
  *******************************/

  $('#J0200').change(function () { skipPatterns (); });
  $('#J0300').change(function () { skipPatterns (); });
  $('#J0400').change(function () { skipPatterns (); });
  $('#J0800Z').change(function () { skipPatterns (); });
  $('#J0700').change(function () { skipPatterns (); });
  $('#J1800').change(function () { skipPatterns (); });
    
  /****************************** 
             SECTION K
  *******************************/

  $('#K0510A1').change(function () { skipPatterns (); });
  $('#K0510A2').change(function () { skipPatterns (); });
  $('#K0510B1').change(function () { skipPatterns (); });
  $('#K0510B2').change(function () { skipPatterns (); });
    
  /****************************** 
             SECTION L
  *******************************/

  // NO SKIP PATTERNS
    
  /****************************** 
             SECTION M
  *******************************/

  $('#M0210').change(function () { skipPatterns (); });
  $('#M0300B1').change(function () { skipPatterns (); });
  $('#M0300C1').change(function () { skipPatterns (); });
  $('#M0300D1').change(function () { skipPatterns (); });
  $('#M0300E1').change(function () { skipPatterns (); });
  $('#M0300F1').change(function () { skipPatterns (); });
  $('#M0300G1').change(function () { skipPatterns (); });
  $('#M0300B1').keyup(function () { skipPatterns (); });
  $('#M0300C1').keyup(function () { skipPatterns (); });
  $('#M0300D1').keyup(function () { skipPatterns (); });
  $('#M0300E1').keyup(function () { skipPatterns (); });
  $('#M0300F1').keyup(function () { skipPatterns (); });
  $('#M0300G1').keyup(function () { skipPatterns (); });
  $('#M0900').change(function () { skipPatterns (); });
    
  /****************************** 
             SECTION N
  *******************************/

  $('#N0300').keyup(function () { skipPatterns (); });
  $('#N0300').change(function () { skipPatterns (); });
    
  /****************************** 
             SECTION O
  *******************************/

  $('#O0250A').change(function () { skipPatterns (); });
  $('#O0300A').change(function () { skipPatterns (); });

  $('#O0400A1').change(function () { skipPatterns (); });
  $('#O0400A2').change(function () { skipPatterns (); });
  $('#O0400A3').change(function () { skipPatterns (); });
  $('#O0400B1').change(function () { skipPatterns (); });
  $('#O0400B2').change(function () { skipPatterns (); });
  $('#O0400B3').change(function () { skipPatterns (); });
  $('#O0400B4').change(function () { skipPatterns (); });
  $('#O0400C1').change(function () { skipPatterns (); });
  $('#O0400C2').change(function () { skipPatterns (); });
  $('#O0400C3').change(function () { skipPatterns (); });
  $('#O0400D1').change(function () { skipPatterns (); });
  $('#O0400E1').change(function () { skipPatterns (); });
  $('#O0400F1').change(function () { skipPatterns (); });
  $('#O0450A').change(function () { skipPatterns (); });

  $('#O0400A1').keyup(function () { skipPatterns (); });
  $('#O0400A2').keyup(function () { skipPatterns (); });
  $('#O0400A3').keyup(function () { skipPatterns (); });
  $('#O0400A4').keyup(function () { skipPatterns (); });
  $('#O0400B1').keyup(function () { skipPatterns (); });
  $('#O0400B2').keyup(function () { skipPatterns (); });
  $('#O0400B3').keyup(function () { skipPatterns (); });
  $('#O0400B4').keyup(function () { skipPatterns (); });
  $('#O0400C1').keyup(function () { skipPatterns (); });
  $('#O0400C2').keyup(function () { skipPatterns (); });
  $('#O0400C3').keyup(function () { skipPatterns (); });
  $('#O0400C4').keyup(function () { skipPatterns (); });
  $('#O0400D1').keyup(function () { skipPatterns (); });
  $('#O0400E1').keyup(function () { skipPatterns (); });
  $('#O0400F1').keyup(function () { skipPatterns (); });

  /****************************** 
             SECTION P
  *******************************/

  // NO SKIP PATTERNS
    
  /****************************** 
             SECTION Q
  *******************************/

  $('#Q0400A').change(function () { skipPatterns (); });
  $('#Q0500B').change(function () { skipPatterns (); });
  $('#Q0490').change(function () { skipPatterns (); });

    
  /****************************** 
             SECTION V
  *******************************/

  // NO SKIP PATTERNS
    
  /****************************** 
             SECTION X
  *******************************/

  $('#A0050').change(function () { skipPatterns (); });
  $('#X0150').change(function () { skipPatterns (); });
  $('#X0600F').change(function () { skipPatterns (); });
    
  /****************************** 
             SECTION Z
  *******************************/

});

function skipPatterns () {
  
  /****************************** 
             VARIABLES
  *******************************/

  // Section A
  var A0310A = $('#A0310A').val();
  var A0310B = $('#A0310B').val();
  var A0310C = $('#A0310C').val();
  var A0310D = $('#A0310D').val();
  var A0310E = $('#A0310E').val();
  var A0310F = $('#A0310F').val();
  var A0310G = $('#A0310G').val();
  
  // Section C
  var C0200 = parseInt($('#C0200').val());
  var C0300A = parseInt($('#C0300A').val());
  var C0300B = parseInt($('#C0300B').val());
  var C0300C = parseInt($('#C0300C').val());
  var C0400A = parseInt($('#C0400A').val());
  var C0400B = parseInt($('#C0400B').val());
  var C0400C = parseInt($('#C0400C').val());
  var C0500_99 = 0;
  var C0500 = 0;

  // Section D

  var D0500A2 = parseInt($('#D0500A2').val());
  var D0500B2 = parseInt($('#D0500B2').val());
  var D0500C2 = parseInt($('#D0500C2').val());
  var D0500D2 = parseInt($('#D0500D2').val());
  var D0500E2 = parseInt($('#D0500E2').val());
  var D0500F2 = parseInt($('#D0500F2').val());
  var D0500G2 = parseInt($('#D0500G2').val());
  var D0500H2 = parseInt($('#D0500H2').val());
  var D0500I2 = parseInt($('#D0500I2').val());
  var D0500J2 = parseInt($('#D0500J2').val());
  var D0600;


  var O0400A1 = parseInt($('#O0400A1').val());
  var O0400A2 = parseInt($('#O0400A2').val());
  var O0400A3 = parseInt($('#O0400A3').val());
  var O0400A4 = parseInt($('#O0400A4').val());

  var O0400B1 = parseInt($('#O0400B1').val());
  var O0400B2 = parseInt($('#O0400B2').val());
  var O0400B3 = parseInt($('#O0400B3').val());
  var O0400B4 = parseInt($('#O0400B4').val());

  var O0400C1 = parseInt($('#O0400C1').val());
  var O0400C2 = parseInt($('#O0400C2').val());
  var O0400C3 = parseInt($('#O0400C3').val());
  var O0400C4 = parseInt($('#O0400C4').val());

  var O0400D1 = parseInt($('#O0400D1').val());
  var O0400E1 = parseInt($('#O0400E1').val());
  var O0400F1 = parseInt($('#O0400F1').val());

  // Section O
  if ($('#O0400A1').val() == '') O0400A1 = 0;
  if ($('#O0400A2').val() == '') O0400A2 = 0;
  if ($('#O0400A3').val() == '') O0400A3 = 0;
  if ($('#O0400B1').val() == '') O0400B1 = 0;
  if ($('#O0400B2').val() == '') O0400B2 = 0;
  if ($('#O0400B3').val() == '') O0400B3 = 0;
  if ($('#O0400C1').val() == '') O0400C1 = 0;
  if ($('#O0400C2').val() == '') O0400C2 = 0;
  if ($('#O0400C3').val() == '') O0400C3 = 0;
  if ($('#O0400D1').val() == '') O0400D1 = 0;
  if ($('#O0400E1').val() == '') O0400E1 = 0;
  if ($('#O0400F1').val() == '') O0400F1 = 0;

  var O0400A = O0400A1 + O0400A2 + O0400A3;
  var O0400B = O0400B1 + O0400B2 + O0400B3;
  var O0400C = O0400C1 + O0400C2 + O0400C3;


  /****************************** 
             SECTION A
  *******************************/

  if ($('#A0050').val() == '1') {
    $('.section-x').hide();
  }

  if ($('#A0310A').val() == '01' || $('#A0310A').val() == '03' || $('#A0310A').val() == '04' || $('#A0310A').val() == '05') { 
    $('.A1500').show(); 
    $('.A1510').show(); $('.A1510A').show(); $('.A1510B').show(); $('.A1510C').show(); 
  }
  else { 
    $('.A1500').hide(); 
    $('.A1510').hide(); $('.A1510A').hide(); $('.A1510B').hide(); $('.A1510C').hide(); 
  }

  if (
    ($('#A0310A').val() == '01' && $('#age').val() >= 21) ||
    (($('#A0310A').val() == '01' || $('#A0310A').val() == '03' || $('#A0310A').val() == '04' || $('#A0310A').val() == '05') && $('#age').val() < 21)
  ) {
    $('.A1550').show(); 
    $('.A1550A').show(); $('.A1550B').show(); $('.A1550C').show(); $('.A1550D').show(); $('.A1550E').show(); $('.A1550Z').show(); 
  } 
  else {
    $('.A1550').hide(); 
    $('.A1550A').hide(); $('.A1550B').hide(); $('.A1550C').hide(); $('.A1550D').hide(); $('.A1550E').hide(); $('.A1550Z').hide(); 
  }

  if ($('#A0310A').val() == '05' || $('#A0310A').val() == '06') {
    $('.A2200').show();
  }
  else {
    $('.A2200').hide();
  }

  if ($('#A0310F').val() == 10 || $('#A0310F').val() == 11) {
    $('.A0310G').show(); 
  }
  else {
    $('.A0310G').hide(); 
  }

  if ($('#A0310F').val() == 10 || $('#A0310F').val() == 11 || $('#A0310F').val() == 12) {
    $('.A2000').show(); $('.A2100').show(); 
  }
  else {
    $('.A2000').hide(); $('.A2100').hide(); 
  }

  if ($('#A1100A').val() == 1) { $('.A1100B').show(); }
  else if ($('#A1100A').val() == 9) { $('.A1100B').show(); }
  else { $('.A1100B').hide(); }

  if ($('#A2400A').val() == 0) {
     $('.A2400B').hide(); $('.A2400C').hide(); 
  }
  else {
     $('.A2400B').show(); $('.A2400C').show(); 
  }

  /****************************** 
             SECTION B
  *******************************/

  if ($('#B0100').val() == 1) {
    $('.section-c').hide(); $('.section-d').hide(); $('.section-e').hide(); $('.section-f').hide(); 
    $('.B0200').hide(); $('.B0300').hide(); $('.B0600').hide(); $('.B0700').hide(); $('.B0800').hide(); $('.B1000').hide(); $('.B1200').hide(); 
  }
  else {
    $('.section-c').show(); $('.section-d').show(); $('.section-e').show(); $('.section-f').show(); 
    $('.B0200').show(); $('.B0300').show(); $('.B0600').show(); $('.B0700').show(); $('.B0800').show(); $('.B1000').show(); $('.B1200').show(); 
  }
    
  /****************************** 
             SECTION C
  *******************************/

  if ($('#C0100').val() == 0) {
    $('.C0200').hide(); $('.C0300').hide(); $('.C0400').hide(); $('.C0500').hide(); $('.C0600').hide(); 
    $('.C0300A').hide(); $('.C0300B').hide(); $('.C0300C').hide(); 
    $('.C0400A').hide(); $('.C0400B').hide(); $('.C0400C').hide(); 
    $('#C0600').val('0');
    $('.C0700').hide(); 
    $('.C0800').hide(); 
    $('.C0900A').hide(); $('.C0900B').hide(); $('.C0900C').hide(); $('.C0900D').hide(); $('.C0900Z').hide(); 
    $('.C1000').hide(); 
  }
  if ($('#C0100').val() == 1) {
    $('.C0200').show(); $('.C0300').show(); $('.C0400').show(); $('.C0500').show(); $('.C0600').show(); 
    $('.C0300A').show(); $('.C0300B').show(); $('.C0300C').show(); 
    $('.C0400A').show(); $('.C0400B').show(); $('.C0400C').show(); 
    $('#C0600').val('1');
    $('.C0700').show(); 
    $('.C0800').show(); 
    $('.C0900A').show(); $('.C0900B').show(); $('.C0900C').show(); $('.C0900D').show(); $('.C0900Z').show(); 
    $('.C1000').show(); 
  }

  if ($('#C0100').val() != 0 && $('#C0500').val() == 99) {
    $('#C0600').val('1');
    $('.C0700').show(); 
    $('.C0800').show(); 
    $('.C0900A').show(); $('.C0900B').show(); $('.C0900C').show(); $('.C0900D').show(); $('.C0900Z').show(); 
    $('.C1000').show(); 
  }
  else {
    $('#C0600').val('0');
    $('.C0700').hide(); 
    $('.C0800').hide(); 
    $('.C0900A').hide(); $('.C0900B').hide(); $('.C0900C').hide(); $('.C0900D').hide(); $('.C0900Z').hide(); 
    $('.C1000').hide(); 
  }
  
  if ($('#C0100').val() == 0) {
    $('.C0700').show(); 
    $('.C0800').show(); 
    $('.C0900A').show(); $('.C0900B').show(); $('.C0900C').show(); $('.C0900D').show(); $('.C0900Z').show(); 
    $('.C1000').show(); 
  }

  if ($('#B0100').val() == 0 && $('#A0310G').val() == 2 && $('#A0310A').val() == 99 && $('#A0310B').val() == 99) {
    $('#C0100').val(0);
    $('.C0200').hide(); $('.C0300').hide(); $('.C0400').hide(); $('.C0500').hide(); $('.C0600').hide(); 
    $('.C0300A').hide(); $('.C0300B').hide(); $('.C0300C').hide(); 
    $('.C0400A').hide(); $('.C0400B').hide(); $('.C0400C').hide(); 
    $('.C0600').hide();
    $('.C0700').show(); 
    $('.C1000').show(); 
  }

  /****************************** 
             SECTION D
  *******************************/

  if ($('#D0100').val() == 0) {
    $('.D0200').hide(); 
    $('.D0200A1').hide(); $('.D0200A2').hide(); 
    $('.D0200B1').hide(); $('.D0200B2').hide(); 
    $('.D0200C1').hide(); $('.D0200C2').hide(); 
    $('.D0200D1').hide(); $('.D0200D2').hide(); 
    $('.D0200E1').hide(); $('.D0200E2').hide(); 
    $('.D0200F1').hide(); $('.D0200F2').hide(); 
    $('.D0200G1').hide(); $('.D0200G2').hide(); 
    $('.D0200H1').hide(); $('.D0200H2').hide(); 
    $('.D0200I1').hide(); $('.D0200I2').hide(); 
    $('.D0300').hide(); 
    $('.D0350').hide(); 

    $('.D0500').show();
    $('.D0500A1').show(); $('.D0500A2').show(); 
    $('.D0500B1').show(); $('.D0500B2').show(); 
    $('.D0500C1').show(); $('.D0500C2').show(); 
    $('.D0500D1').show(); $('.D0500D2').show(); 
    $('.D0500E1').show(); $('.D0500E2').show(); 
    $('.D0500F1').show(); $('.D0500F2').show(); 
    $('.D0500G1').show(); $('.D0500G2').show(); 
    $('.D0500H1').show(); $('.D0500H2').show(); 
    $('.D0500I1').show(); $('.D0500I2').show(); 
    $('.D0500J1').show(); $('.D0500J2').show();
    $('.D0600').show();
  }
  else {
    $('.D0200').show(); 
    $('.D0200A1').show(); $('.D0200A2').show(); 
    $('.D0200B1').show(); $('.D0200B2').show(); 
    $('.D0200C1').show(); $('.D0200C2').show(); 
    $('.D0200D1').show(); $('.D0200D2').show(); 
    $('.D0200E1').show(); $('.D0200E2').show(); 
    $('.D0200F1').show(); $('.D0200F2').show(); 
    $('.D0200G1').show(); $('.D0200G2').show(); 
    $('.D0200H1').show(); $('.D0200H2').show(); 
    $('.D0200I1').show(); $('.D0200I2').show(); 
    $('.D0300').show(); 
    $('.D0350').show(); 

    $('.D0500').hide();
    $('.D0500A1').hide(); $('.D0500A2').hide(); 
    $('.D0500B1').hide(); $('.D0500B2').hide(); 
    $('.D0500C1').hide(); $('.D0500C2').hide(); 
    $('.D0500D1').hide(); $('.D0500D2').hide(); 
    $('.D0500E1').hide(); $('.D0500E2').hide(); 
    $('.D0500F1').hide(); $('.D0500F2').hide(); 
    $('.D0500G1').hide(); $('.D0500G2').hide(); 
    $('.D0500H1').hide(); $('.D0500H2').hide(); 
    $('.D0500I1').hide(); $('.D0500I2').hide(); 
    $('.D0500J1').hide(); $('.D0500J2').hide(); 
    $('.D0600').hide();
  }

  if ($('#D0200I1').val() == 1) {
    $('.D0350').show(); 
  }
  else {
    $('.D0350').hide(); 
  }

  if ($('#D0200A1').val() == 9) $('.D0200A2').hide();
  else $('.D0200A2').show();

  if ($('#D0200B1').val() == 9) $('.D0200B2').hide();
  else $('.D0200B2').show();

  if ($('#D0200C1').val() == 9) $('.D0200C2').hide();
  else $('.D0200C2').show();

  if ($('#D0200D1').val() == 9) $('.D0200D2').hide();
  else $('.D0200D2').show();

  if ($('#D0200E1').val() == 9) $('.D0200E2').hide();
  else $('.D0200E2').show();

  if ($('#D0200F1').val() == 9) $('.D0200F2').hide();
  else $('.D0200F2').show();

  if ($('#D0200G1').val() == 9) $('.D0200G2').hide();
  else $('.D0200G2').show();

  if ($('#D0200H1').val() == 9) $('.D0200H2').hide();
  else $('.D0200H2').show();

  if ($('#D0200I1').val() == 9) $('.D0200I2').hide();
  else $('.D0200I2').show();

  if ($('#D0200A2').val() != '') var D0200A2 = parseInt($('#D0200A2').val()); else var D0200A2 = 0;
  if ($('#D0200B2').val() != '') var D0200B2 = parseInt($('#D0200B2').val()); else var D0200B2 = 0;
  if ($('#D0200C2').val() != '') var D0200C2 = parseInt($('#D0200C2').val()); else var D0200C2 = 0;
  if ($('#D0200D2').val() != '') var D0200D2 = parseInt($('#D0200D2').val()); else var D0200D2 = 0;
  if ($('#D0200E2').val() != '') var D0200E2 = parseInt($('#D0200E2').val()); else var D0200E2 = 0;
  if ($('#D0200F2').val() != '') var D0200F2 = parseInt($('#D0200F2').val()); else var D0200F2 = 0;
  if ($('#D0200G2').val() != '') var D0200G2 = parseInt($('#D0200G2').val()); else var D0200G2 = 0;
  if ($('#D0200H2').val() != '') var D0200H2 = parseInt($('#D0200H2').val()); else var D0200H2 = 0;
  if ($('#D0200U2').val() != '') var D0200I2 = parseInt($('#D0200I2').val()); else var D0200I2 = 0;
  

  var D0300_99 = 0;
  if ($('#D0200A1').val() == 9) D0300_99++;
  if ($('#D0200B1').val() == 9) D0300_99++;
  if ($('#D0200C1').val() == 9) D0300_99++;
  if ($('#D0200D1').val() == 9) D0300_99++;
  if ($('#D0200E1').val() == 9) D0300_99++;
  if ($('#D0200F1').val() == 9) D0300_99++;
  if ($('#D0200G1').val() == 9) D0300_99++;
  if ($('#D0200H1').val() == 9) D0300_99++;
  if ($('#D0200I1').val() == 9) D0300_99++;
  var D0300 = 0;

  D0300 = D0200A2 + D0200B2 + D0200C2 + D0200D2 + D0200E2 + D0200F2 + D0200G2 + D0200H2 + D0200I2;
  if (D0300_99 == 2) {
    var DIVIDE_BY = (9/(9-D0300_99));
    D0300 = D0300 * DIVIDE_BY;
  }
  if (D0300_99 == 1) {
    D0300 = D0300 * 1.125;
  }
  if (D0300_99 >= 3) D0300 = 99;

  D0300 = Math.round(D0300);

  $('#D0300').val(D0300);

  if ($('#D0100').val() == 0) {

    $('.D0200').hide(); 
    $('.D0200A1').hide(); $('.D0200A2').hide(); 
    $('.D0200B1').hide(); $('.D0200B2').hide(); 
    $('.D0200C1').hide(); $('.D0200C2').hide(); 
    $('.D0200D1').hide(); $('.D0200D2').hide(); 
    $('.D0200E1').hide(); $('.D0200E2').hide(); 
    $('.D0200F1').hide(); $('.D0200F2').hide(); 
    $('.D0200G1').hide(); $('.D0200G2').hide(); 
    $('.D0200H1').hide(); $('.D0200H2').hide(); 
    $('.D0200I1').hide(); $('.D0200I2').hide(); 
    $('.D0300').hide(); 
    $('.D0350').hide(); 

    $('.D0500').show();
    $('.D0500A1').show(); $('.D0500A2').show(); 
    $('.D0500B1').show(); $('.D0500B2').show(); 
    $('.D0500C1').show(); $('.D0500C2').show(); 
    $('.D0500D1').show(); $('.D0500D2').show(); 
    $('.D0500E1').show(); $('.D0500E2').show(); 
    $('.D0500F1').show(); $('.D0500F2').show(); 
    $('.D0500G1').show(); $('.D0500G2').show(); 
    $('.D0500H1').show(); $('.D0500H2').show(); 
    $('.D0500I1').show(); $('.D0500I2').show(); 
    $('.D0500J1').show(); $('.D0500J2').show(); 
    $('.D0600').show();
  }

  else if ($('#D0100').val() == 1 && $('#D0300').val() == 99) {

    $('.D0500').show();
    $('.D0500A1').show(); $('.D0500A2').show(); 
    $('.D0500B1').show(); $('.D0500B2').show(); 
    $('.D0500C1').show(); $('.D0500C2').show(); 
    $('.D0500D1').show(); $('.D0500D2').show(); 
    $('.D0500E1').show(); $('.D0500E2').show(); 
    $('.D0500F1').show(); $('.D0500F2').show(); 
    $('.D0500G1').show(); $('.D0500G2').show(); 
    $('.D0500H1').show(); $('.D0500H2').show(); 
    $('.D0500I1').show(); $('.D0500I2').show(); 
    $('.D0500J1').show(); $('.D0500J2').show(); 
    $('.D0600').show();
  }
  else {
    $('.D0500').hide();
    $('.D0500A1').hide(); $('.D0500A2').hide(); 
    $('.D0500B1').hide(); $('.D0500B2').hide(); 
    $('.D0500C1').hide(); $('.D0500C2').hide(); 
    $('.D0500D1').hide(); $('.D0500D2').hide(); 
    $('.D0500E1').hide(); $('.D0500E2').hide(); 
    $('.D0500F1').hide(); $('.D0500F2').hide(); 
    $('.D0500G1').hide(); $('.D0500G2').hide(); 
    $('.D0500H1').hide(); $('.D0500H2').hide(); 
    $('.D0500I1').hide(); $('.D0500I2').hide(); 
    $('.D0500J1').hide(); $('.D0500J2').hide(); 
    $('.D0600').hide();
  }

  D0600 = D0500A2 + D0500B2 + D0500C2 + D0500D2 + D0500E2 + D0500F2 + D0500G2 + D0500H2 + D0500I2 + D0500J2;

  if ($('#D0500I1').val() == 1) {
    $('.D0650').show();
    $('#D0650').val(1);
  }
  else {
    $('.D0650').hide();
  }

  if ($('#A0310A').val() == 99 && $('#A0310B').val() == 99 && $('#A0310G').val() == 2) {
    $('.section-d').hide();
  }
    
  /****************************** 
             SECTION E
  *******************************/

  if ($('#E0200A').val() > 0 || $('#E0200B').val() > 0 || $('#E0200C').val() > 0) {
    $('#E0300').val(1);
  }
  else {
    $('#E0300').val(0);
  }

  if ($('#E0300').val() == 0) {
    $('.E0500').hide(); 
    $('.E0500A').hide(); $('.E0500B').hide(); $('.E0500C').hide(); 
    $('.E0600A').hide(); $('.E0600B').hide(); $('.E0600C').hide(); 
  }
  else {
    $('.E0500').show(); 
    $('.E0500A').show(); $('.E0500B').show(); $('.E0500C').show(); 
    $('.E0600A').show(); $('.E0600B').show(); $('.E0600C').show(); 
  }


  if ($('#E0900').val() == 0) {
    $('.E1000A').hide(); $('.E1000B').hide();
  }
  else {
    $('.E1000A').show(); $('.E1000B').show();
  }
    
  /****************************** 
             SECTION F
  *******************************/

  if ($('#F0300').val() == 0) {
    $('.F0400').hide();
    $('.F0400A').hide(); $('.F0400B').hide(); $('.F0400C').hide(); $('.F0400D').hide(); 
    $('.F0400E').hide(); $('.F0400F').hide(); $('.F0400G').hide(); $('.F0400H').hide();
    $('.F0500').hide();
    $('.F0500A').hide(); $('.F0500B').hide(); $('.F0500C').hide(); $('.F0500D').hide(); 
    $('.F0500E').hide(); $('.F0500F').hide(); $('.F0500G').hide(); $('.F0500H').hide();
    $('.F0600').hide();
    $('.F0700').hide();

    $('.F0800').show();
    $('.F0800A').show();
    $('.F0800B').show();
    $('.F0800C').show();
    $('.F0800D').show();
    $('.F0800E').show();
    $('.F0800F').show();
    $('.F0800G').show();
    $('.F0800H').show();
    $('.F0800I').show();
    $('.F0800J').show();
    $('.F0800K').show();
    $('.F0800L').show();
    $('.F0800M').show();
    $('.F0800N').show();
    $('.F0800O').show();
    $('.F0800P').show();
    $('.F0800Q').show();
    $('.F0800R').show();
    $('.F0800S').show();
    $('.F0800T').show();
    $('.F0800Z').show();
  }
  else {
    $('.F0400').show();
    $('.F0400A').show(); $('.F0400B').show(); $('.F0400C').show(); $('.F0400D').show(); 
    $('.F0400E').show(); $('.F0400F').show(); $('.F0400G').show(); $('.F0400H').show();
    $('.F0500').show();
    $('.F0500A').show(); $('.F0500B').show(); $('.F0500C').show(); $('.F0500D').show(); 
    $('.F0500E').show(); $('.F0500F').show(); $('.F0500G').show(); $('.F0500H').show();
    $('.F0600').show();
    $('.F0700').show();


    $('.F0800').hide();
    $('.F0800A').hide();
    $('.F0800B').hide();
    $('.F0800C').hide();
    $('.F0800D').hide();
    $('.F0800E').hide();
    $('.F0800F').hide();
    $('.F0800G').hide();
    $('.F0800H').hide();
    $('.F0800I').hide();
    $('.F0800J').hide();
    $('.F0800K').hide();
    $('.F0800L').hide();
    $('.F0800M').hide();
    $('.F0800N').hide();
    $('.F0800O').hide();
    $('.F0800P').hide();
    $('.F0800Q').hide();
    $('.F0800R').hide();
    $('.F0800S').hide();
    $('.F0800T').hide();
    $('.F0800Z').hide();


    
    if ($('#F0700').val() == 1) {

      $('.F0800').show();
      $('.F0800A').show();
      $('.F0800B').show();
      $('.F0800C').show();
      $('.F0800D').show();
      $('.F0800E').show();
      $('.F0800F').show();
      $('.F0800G').show();
      $('.F0800H').show();
      $('.F0800I').show();
      $('.F0800J').show();
      $('.F0800K').show();
      $('.F0800L').show();
      $('.F0800M').show();
      $('.F0800N').show();
      $('.F0800O').show();
      $('.F0800P').show();
      $('.F0800Q').show();
      $('.F0800R').show();
      $('.F0800S').show();
      $('.F0800T').show();
      $('.F0800Z').show();
    }
    else {
      $('.F0800').hide();
      $('.F0800A').hide();
      $('.F0800B').hide();
      $('.F0800C').hide();
      $('.F0800D').hide();
      $('.F0800E').hide();
      $('.F0800F').hide();
      $('.F0800G').hide();
      $('.F0800H').hide();
      $('.F0800I').hide();
      $('.F0800J').hide();
      $('.F0800K').hide();
      $('.F0800L').hide();
      $('.F0800M').hide();
      $('.F0800N').hide();
      $('.F0800O').hide();
      $('.F0800P').hide();
      $('.F0800Q').hide();
      $('.F0800R').hide();
      $('.F0800S').hide();
      $('.F0800T').hide();
      $('.F0800Z').hide();
    }

  }

    
  /****************************** 
             SECTION G
  *******************************/

  if ($('#A0310A').val() == '01') {
    $('.G0900A').show(); $('.G0900B').show();
  }
  else {
    $('.G0900A').hide(); $('.G0900B').hide();
  }
    
  /****************************** 
             SECTION H
  *******************************/

  if ($('#H0200A').val() == '0') {
    $('.H0200B').hide(); 
    $('.H0200C').hide();
  }
  else if ($('#H0200A').val() == '9') {
    $('.H0200B').hide();
    $('.H0200C').show();
  }
  else {
    $('.H0200B').show(); 
    $('.H0200C').show();
  }

  /****************************** 
             SECTION I
  *******************************/

  // NO SKIP PATTERNS
    
  /****************************** 
             SECTION J
  *******************************/

  if ($('#J0200').val() == 0) {
    $('.J0300').hide(); 
    $('.J0400').hide(); 
    $('.J0500').hide(); $('.J0500A').hide(); $('.J0500B').hide(); 
    $('.J0600').hide(); $('.J0600A').hide(); $('.J0600B').hide(); 
    $('.J0700').hide(); 
    $('.J0800').show(); $('.J0800A').show(); $('.J0800B').show(); $('.J0800C').show(); $('.J0800D').show(); $('.J0800Z').show(); 
    $('.J0850').show(); 
  }
  else {
    $('.J0300').show(); 
    $('.J0400').show(); 
    $('.J0500').show(); $('.J0500A').show(); $('.J0500B').show(); 
    $('.J0600').show(); $('.J0600A').show(); $('.J0600B').show(); 
    $('.J0700').show(); 


    if ($('#J0400').val() == 9) $('#J0700').val('1');
    else  $('#J0700').val('0');

    if ($('#J0700').length > 1) {
      if ($('#J0700').val() == 0) {
        $('.J0800').hide();
        $('.J0800A').hide(); $('.J0800B').hide(); $('.J0800C').hide(); $('.J0800D').hide(); $('.J0800Z').hide(); 
        $('.J0850').hide(); 
      }
      else {
        $('.J0800').show();
        $('.J0800A').show(); $('.J0800B').show(); $('.J0800C').show(); $('.J0800D').show(); $('.J0800Z').show(); 
        $('.J0850').show(); 
      }
    }
    else {
        $('.J0800').hide();
        $('.J0800A').hide(); $('.J0800B').hide(); $('.J0800C').hide(); $('.J0800D').hide(); $('.J0800Z').hide(); 
        $('.J0850').hide(); 
    }

  }

  if ($('#J0200').val() != 0 && $('#J0300').val() == 0) {
    $('.J0400').hide(); 
    $('.J0500').hide(); $('.J0500A').hide(); $('.J0500B').hide(); 
    $('.J0600').hide(); $('.J0600A').hide(); $('.J0600B').hide(); 
    $('.J0700').hide(); 
    $('.J0800').hide();
    $('.J0800A').hide(); $('.J0800B').hide(); $('.J0800C').hide(); $('.J0800D').hide(); $('.J0800Z').hide(); 
    $('.J0850').hide(); 
  }
  if ($('#J0200').val() != 0 && $('#J0300').val() == 9) {
    $('.J0400').hide(); 
    $('.J0500').hide(); $('.J0500A').hide(); $('.J0500B').hide(); 
    $('.J0600').hide(); $('.J0600A').hide(); $('.J0600B').hide(); 
    $('.J0700').hide(); 
    $('.J0800').show();
    $('.J0800A').show(); $('.J0800B').show(); $('.J0800C').show(); $('.J0800D').show(); $('.J0800Z').show(); 
    $('.J0850').show(); 
  }

  if ($('#J0800Z').length > 1) {
    if ($('#J0800Z').is(':checked')) {
      $('.J0850').hide(); 
    }
    else {
      $('.J0850').show(); 
    }
  }

  if ($('#A0310A').val() == '01' || $('#A0310E').val() == 1) {
    $('.J1700').show(); $('.J1700A').show(); $('.J1700B').show(); $('.J1700C').show(); 
  }
  else {
    $('.J1700').hide(); $('.J1700A').hide(); $('.J1700B').hide(); $('.J1700C').hide(); 
  }

  if ($('#J1800').val() == 0) {
    $('.J1900').hide();
    $('.J1900A').hide(); $('.J1900B').hide(); $('.J1900C').hide(); 
  }
  else {
    $('.J1900').show();
    $('.J1900A').show(); $('.J1900B').show(); $('.J1900C').show(); 
  }

  if (
    $('#A0310G').val() == 2 && 
    $('#AssessmentType').val() != 'NOD' && 
    $('#A0310A').val() != '01' && $('#A0310A').val() != '02' && $('#A0310A').val() != '03' && 
    $('#A0310A').val() != '04' && $('#A0310A').val() != '05' && $('#A0310A').val() != '06' && 

    $('#A0310B').val() != '01' && $('#A0310B').val() != '02' && $('#A0310B').val() != '03' && 
    $('#A0310B').val() != '04' && $('#A0310B').val() != '05' && $('#A0310B').val() != '06' && $('#A0310B').val() != '07'
  ) {
      $('.J0200').hide(); 
      $('.J0300').hide(); 
      $('.J0400').hide(); 
      $('.J0500').hide(); $('.J0500A').hide(); $('.J0500B').hide(); 
      $('.J0600').hide(); $('.J0600A').hide(); $('.J0600B').hide(); 
      $('.J0700').hide(); 
      $('.J0800').hide();
      $('.J0800A').hide(); $('.J0800B').hide(); $('.J0800C').hide(); $('.J0800D').hide(); $('.J0800Z').hide(); 
      $('.J0850').hide(); 
  }

  if ($('#J0700').val() == 1) {
    $('.J0800').show();
    $('.J0800A').show(); $('.J0800B').show(); $('.J0800C').show(); $('.J0800D').show(); $('.J0800Z').show(); 
    $('.J0850').show(); 
  }

  if ($('#B0100').val() == 1) {
    $('.J0200').hide(); 
    $('.J0300').hide(); 
    $('.J0400').hide(); 
    $('.J0500').hide(); $('.J0500A').hide(); $('.J0500B').hide(); 
    $('.J0600').hide(); $('.J0600A').hide(); $('.J0600B').hide(); 
    $('.J0700').hide(); 
    $('.J0800').hide(); $('.J0800A').hide(); $('.J0800B').hide(); $('.J0800C').hide(); $('.J0800D').hide(); $('.J0800Z').hide(); 
    $('.J0850').hide(); 
  }

    
  /****************************** 
             SECTION K
  *******************************/

  if ($('#admitted').val() >= 7) {
    $('.K0510A1').hide(); 
    $('.K0510B1').hide(); 
    $('.K0510C1').hide(); 
    $('.K0510D1').hide(); 
    $('.K0510Z1').hide(); 
  }
  else {
    $('.K0510A1').show(); 
    $('.K0510B1').show(); 
    $('.K0510C1').show(); 
    $('.K0510D1').show(); 
    $('.K0510Z1').show(); 
  }

  if ($('#K0510A1').is(':checked') || $('#K0510A2').is(':checked') || $('#K0510B1').is(':checked') || $('#K0510B2').is(':checked')) {
    $('.K0700').show(); 
    $('.K0700A').show(); 
    $('.K0700B').show(); 
  }
  else {
    $('.K0700').hide(); 
    $('.K0700A').hide(); 
    $('.K0700B').hide(); 
  }

  if ($("#K0500A").is(':checked') || $("#K0500B").is(':checked')) {
    $('.K0700').show(); 
    $('.K0700A').show(); 
    $('.K0700B').show(); 
  }

  if (
    $('#A0310G').val() == 2 && 
    ($('#A0310A').val() != '01' && $('#A0310A').val() != '02' && $('#A0310A').val() != '03' && $('#A0310A').val() != '04' && $('#A0310A').val() != '05' && $('#A0310A').val() != '06') && 
    ($('#A0310B').val() != '01' && $('#A0310B').val() != '02' && $('#A0310B').val() != '03' && $('#A0310B').val() != '04' && $('#A0310B').val() != '05' && $('#A0310B').val() != '06' && $('#A0310B').val() != '07')
  ) {
    $('.K0510C').hide(); $('.K0510C1').hide(); $('.K0510C2').hide(); 
    $('.K0510D').hide(); $('.K0510D1').hide(); $('.K0510D2').hide(); 
    $('.K0510Z').hide(); $('.K0510Z1').hide(); $('.K0510Z2').hide(); 
  }
    
  /****************************** 
             SECTION L
  *******************************/

  // NO SKIP PATTERNS
    
  /****************************** 
             SECTION M
  *******************************/

  if ($('#M0210').val() == 0) {
    $('.M0300').hide();
    $('.M0300A').hide();
    $('.M0300B').hide(); $('.M0300B1').hide(); $('.M0300B2').hide(); $('.M0300B3').hide(); 
    $('.M0300C').hide(); $('.M0300C1').hide(); $('.M0300C2').hide();
    $('.M0300D').hide(); $('.M0300D1').hide(); $('.M0300D2').hide();
    $('.M0300E').hide(); $('.M0300E1').hide(); $('.M0300E2').hide();
    $('.M0300F').hide(); $('.M0300F1').hide(); $('.M0300F2').hide();
    $('.M0300G').hide(); $('.M0300G1').hide(); $('.M0300G2').hide();
    $('.M0610').hide(); $('.M0610A').hide(); $('.M0610B').hide(); $('.M0610C').hide();
    $('.M0700').hide();
    $('.M0800').hide(); $('.M0800A').hide(); $('.M0800B').hide(); $('.M0800C').hide();
  }
  else {
    $('.M0300').show();
    $('.M0300A').show();
    $('.M0300B').show(); $('.M0300B1').show(); $('.M0300B2').show(); $('.M0300B3').show(); 
    $('.M0300C').show(); $('.M0300C1').show(); $('.M0300C2').show();
    $('.M0300D').show(); $('.M0300D1').show(); $('.M0300D2').show();
    $('.M0300E').show(); $('.M0300E1').show(); $('.M0300E2').show();
    $('.M0300F').show(); $('.M0300F1').show(); $('.M0300F2').show();
    $('.M0300G').show(); $('.M0300G1').show(); $('.M0300G2').show();
    $('.M0610').show(); $('.M0610A').show(); $('.M0610B').show(); $('.M0610C').show();
    $('.M0700').show();
    $('.M0800').show(); $('.M0800A').show(); $('.M0800B').show(); $('.M0800C').show();
  }

  if ($('#M0300B1').val() == 0) {
    $('.M0300B2').hide(); $('.M0300B3').hide();
  }
  else {
    $('.M0300B2').show(); $('.M0300B3').show();
  }

  if ($('#M0300C1').val() == 0)  {
    $('.M0300C2').hide(); 
  }
  else {
    $('.M0300C2').show();
  }

  if ($('#M0300D1').val() == 0) 
    $('.M0300D2').hide(); 
  else 
    $('.M0300D2').show();

  if ($('#M0300E1').val() == 0) 
    $('.M0300E2').hide(); 
  else 
    $('.M0300E2').show(); 

  if ($('#M0300F1').val() == 0) 
    $('.M0300F2').hide(); 
  else 
    $('.M0300F2').show(); 

  if ($('#M0300G1').val() == 0) 
    $('.M0300G2').hide(); 
  else 
    $('.M0300G2').show(); 

  if ($('#A0310E').val() == 0) {
    $('.M0800').show(); $('.M0800A').show(); $('.M0800B').show(); $('.M0800C').show(); 
    $('.M0900').show(); $('.M0900A').show(); $('.M0900B').show(); $('.M0900C').show(); $('.M0900D').show(); 
    if ($('#M0900').val() == 0) {
      $('.M0900A').hide(); $('.M0900B').hide(); $('.M0900C').hide(); $('.M0900D').hide(); 
    }
    else {
      $('.M0900A').show(); $('.M0900B').show(); $('.M0900C').show(); $('.M0900D').show(); 
    }
  }
  else {
    $('.M0800').hide(); $('.M0800A').hide(); $('.M0800B').hide(); $('.M0800C').hide(); 
    $('.M0900').hide(); $('.M0900A').hide(); $('.M0900B').hide(); $('.M0900C').hide(); $('.M0900D').hide(); 
  }

  if ($('#M0300C1').val() > 0 || $('#M0300D1').val() > 0 || $('#M0300F1').val() > 0) {
     $('.M0610').show(); $('.M0610A').show(); $('.M0610B').show(); $('.M0610C').show();
  }
  else {
     $('.M0610').hide(); $('.M0610A').hide(); $('.M0610B').hide(); $('.M0610C').hide();
  }

    
  /****************************** 
             SECTION N
  *******************************/

  if ($("#N0300").val() == 0) {
    $('.N0350').hide(); $('.N0350A').hide(); $('.N0350B').hide(); 
  }
  else {
    $('.N0350').show(); $('.N0350A').show(); $('.N0350B').show(); 
  }
    
  /****************************** 
             SECTION O
  *******************************/

  if ($('#admitted').val() >= 14) {
    $('.O0100A1').hide();
    $('.O0100B1').hide();
    $('.O0100C1').hide();
    $('.O0100D1').hide();
    $('.O0100E1').hide();
    $('.O0100F1').hide();
    $('.O0100G1').hide();
    $('.O0100H1').hide();
    $('.O0100I1').hide();
    $('.O0100J1').hide();
    $('.O0100K1').hide();
    $('.O0100M1').hide();
    $('.O0100Z1').hide();
  }

  if ($('#O0250A').val() == 0) {
    $('.O0250B').hide(); $('.O0250C').show(); 
  }
  else {
    $('.O0250B').show(); $('.O0250C').hide(); 
  }

  if ($('#O0300A').val() == 0) {
    $('.O0300B').show(); 
  }
  else {
    $('.O0300B').hide(); 
  }

  if ($("#O0400A4").length > 0) {
    if (O0400A > 0 ) {
      $('#O0400A5').show(); $('#O0400A6').show(); 
      $('.O0400A5').show(); $('.O0400A6').show(); 
    }
    else {
      if ($("#O0400A1").length > 0 && $("#O0400A2").length > 0 && $("#O0400A3").length > 0) {
        O0400A4 = 0;
        $("#O0400A4").val(O0400A4);
      }
      $('#O0400A5').hide(); $('#O0400A6').hide(); 
      $('.O0400A5').hide(); $('.O0400A6').hide(); 
    }
    if (O0400A4 != 0) { $('#O0400A5').show(); $('#O0400A6').show(); $('.O0400A5').show(); $('.O0400A6').show(); }
    else {  $('#O0400A5').hide(); $('#O0400A6').hide(); $('.O0400A5').hide(); $('.O0400A6').hide(); }
  }

  if ($("#O0400B4").length > 0) {
    if (O0400B > 0) {
      $('#O0400B5').show(); $('#O0400B6').show(); 
      $('.O0400B5').show(); $('.O0400B6').show(); 
    }
    else {
      if ($("#O0400B1").length > 0 && $("#O0400B2").length > 0 && $("#O0400B3").length > 0) {
        O0400B4 = 0;
        $("#O0400B4").val(O0400B4);
      }
      $('#O0400B5').hide(); $('#O0400B6').hide(); 
      $('.O0400B5').hide(); $('.O0400B6').hide(); 
    }
    if (O0400B4 != 0) { $('#O0400B5').show(); $('#O0400B6').show(); $('.O0400B5').show(); $('.O0400B6').show(); }
    else {  $('#O0400B5').hide(); $('#O0400B6').hide(); $('.O0400B5').hide(); $('.O0400B6').hide(); }
  }

  if ($("#O0400C4").length > 0) {
    if (O0400C > 0) {
      $('#O0400C5').hide(); $('#O0400C6').hide(); 
      $('.O0400C5').show(); $('.O0400C6').show(); 
    }
    else {
      if ($("#O0400C1").length > 0 && $("#O0400C2").length > 0 && $("#O0400C3").length > 0) {
        O0400C4 = 0;
        $("#O0400C4").val(O0400C4);
      }
      $('#O0400C5').hide(); $('#O0400C6').hide(); 
      $('.O0400C5').hide(); $('.O0400C6').hide(); 
    }
    if (O0400C4 != 0) { $('#O0400C5').show(); $('#O0400C6').show(); $('.O0400C5').show(); $('.O0400C6').show(); }
    else {  $('#O0400C5').hide(); $('#O0400C6').hide(); $('.O0400C5').hide(); $('.O0400C6').hide(); }
  }

  if (($('#A0310C').val() == 2 || $('#A0310C').val() == 3) && $('#A0310F').val() == 99) {
    $('.O0450').show(); $('.O0450A').show(); $('.O0450A').show(); 
  }
  else  {
    $('.O0450').hide(); $('.O0450A').hide(); $('.O0450B').hide(); 
  }

  if ($('#O0450A').val() == 0) {
    $('.O0450B').hide(); 
  }
  else  {
    $('.O0450B').show(); 
  }
    
  /****************************** 
             SECTION P
  *******************************/

  // NO SKIP PATTERNS
    
  /****************************** 
             SECTION Q
  *******************************/

  if ($('#A0310E').val() == 1) {
    $('.Q0300').show(); $('.Q0300A').show(); $('.Q0300B').show(); 
  }
  else  {
    $('.Q0300').hide(); $('.Q0300A').hide(); $('.Q0300B').hide(); 
  }

  if ($('#Q0400A').val() == 1) {
    $('.Q0490').hide();
    $('.Q0500').hide(); $('.Q0500A').hide(); $('.Q0500B').hide();
    $('.Q0550').hide(); $('.Q0550A').hide(); $('.Q0550B').hide();
  }
  else  {
    $('.Q0490').show();
    $('.Q0500').show(); $('.Q0500A').show(); $('.Q0500B').show();
    $('.Q0550').show(); $('.Q0550A').show(); $('.Q0550B').show();
    if ($('#A0310A').val() == '02' || $('#A0310A').val() == '06' || $('#A0310A').val() == '99') {
      $('.Q0490').show();

      if ($('#Q0490').val() == 1) {
        $('.Q0500').hide(); $('.Q0500A').hide(); $('.Q0500B').hide(); 
        $('.Q0550').hide(); $('.Q0550A').hide(); $('.Q0550B').hide();
      }
      else  {
        $('.Q0500').show(); $('.Q0500A').show(); $('.Q0500B').show();
        $('.Q0550').show(); $('.Q0550A').show(); $('.Q0550B').show();
      }
    }
    else {
      $('.Q0490').hide();
    }
  }

  if ($('#Q0400B').val() == 2) {
    $('.Q0500').hide(); $('.Q0500A').hide(); $('.Q0500B').hide(); 
    $('.Q0550').hide(); $('.Q0550A').hide(); $('.Q0550B').hide();
  }

  if ($('#AssessmentItemSubset').val() == '1.00') {

    if ($('#Q0400A').val() == 1) {
      $('.Q0400B').hide();
      $('.Q0500').hide(); $('.Q0500A').hide();  $('.Q0500B').hide(); 
    }
    else {
      $('.Q0400B').show();
      $('.Q0500').show(); $('.Q0500A').show();  $('.Q0500B').show(); 
    }

    if ($('#Q0400B').val() == 1) {
      $('.Q0500').hide(); $('.Q0500A').hide();  $('.Q0500B').hide(); 
    }
    else {
      $('.Q0500').show(); $('.Q0500A').show();  $('.Q0500B').show(); 
    }

    if ($('#Q0400B').val() == 2) {
      $('.Q0500').hide(); $('.Q0500A').hide(); $('.Q0500B').hide(); $('.Q0600').hide(); 
    }
    else {
      $('.Q0500').show(); $('.Q0500A').show(); $('.Q0500B').show(); $('.Q0600').show(); 
    }
  }
    
  /****************************** 
             SECTION V
  *******************************/
  if (
    $('#A0310E').val() == 0 && 
    $('#V0100SHOW').val() == 1 && 
    (
      A0310A == '01' || A0310A == '02' || A0310A == '03' || A0310A == '04' || A0310A == '05' || A0310A == '06' || 
      A0310B == '01' || A0310B == '02' || A0310B == '03' || A0310B == '04' || A0310B == '05' || A0310B == '06' 
    )
  ) {
    $('.V0100').show(); $('.V0100A').show(); $('.V0100B').show(); $('.V0100C').show(); $('.V0100D').show(); $('.V0100E').show(); $('.V0100F').show(); 
  }
  else {
    $('.V0100').hide(); $('.V0100A').hide(); $('.V0100B').hide(); $('.V0100C').hide(); $('.V0100D').hide(); $('.V0100E').hide(); $('.V0100F').hide(); 
  }
    
  /****************************** 
             SECTION X
  *******************************/

  if ($('#A0050').val() == 2 || $('#A0050').val() == 3) {
    $('.section-x').show();
  }
  else {
    if ($('#AssessmentItemSubset').val() == '1.00') $('.section-x').show();
    else $('.section-x').hide();
  }

  if ($('#A0050').val() == 3) {
    $('.section-b').hide();
    $('.section-c').hide();
    $('.section-d').hide();
    $('.section-e').hide();
    $('.section-f').hide();
    $('.section-g').hide();
    $('.section-h').hide();
    $('.section-i').hide();
    $('.section-j').hide();
    $('.section-k').hide();
    $('.section-l').hide();
    $('.section-m').hide();
    $('.section-n').hide();
    $('.section-o').hide();
    $('.section-p').hide();
    $('.section-q').hide();
    $('.section-s').hide();
    $('.section-v').hide();
  }

  if ($('#X0150').val() == 2) {
    $('.X0600D').show();
  }
  else {
    $('.X0600D').hide();
  }

  if ($('#X0100').val() == 1) {
    $('.X0100-SKIP').hide();
  }
  else {
    $('.X0100-SKIP').show();
  }

  if ($('#X0600F').val() == 99) {
    $('.X0700').show(); $('.X0700A').show(); $('.X0700B').hide(); $('.X0700C').hide();
  }
  else if ($('#X0600F').val() == 10 || $('#X0600F').val() == 11 || $('#X0600F').val() == 12) {
    $('.X0700').show(); $('.X0700A').hide(); $('.X0700B').show(); $('.X0700C').hide();
  }
  else if ($('#X0600F').val() == '01') {
    $('.X0700').show(); $('.X0700A').hide(); $('.X0700B').hide(); $('.X0700C').show();
  }
  else {
    $('.X0700').hide(); $('.X0700A').hide(); $('.X0700B').hide(); $('.X0700C').hide();
  }

  if ($('#A0050').val() == 2 || $('#X0100').val() == 2) {
    $('.X0900').show(); $('.X0900A').show(); $('.X0900B').show(); $('.X0900C').show(); $('.X0900D').show(); $('.X0900E').show(); $('.X0900Z').show(); 
    $('.X1050').hide(); $('.X1050A').hide(); $('.X1050Z').hide(); 
  }
  else if ($('#A0050').val() == 3 || $('#X0100').val() == 3) {
    $('.X0900').hide(); $('.X0900A').hide(); $('.X0900B').hide(); $('.X0900C').hide(); $('.X0900D').hide(); $('.X0900E').hide(); $('.X0900Z').hide(); 
    $('.X1050').show(); $('.X1050A').show(); $('.X1050Z').show(); 
  }
  else {
    $('.X0900').hide(); $('.X0900A').hide(); $('.X0900B').hide(); $('.X0900C').hide(); $('.X0900D').hide(); $('.X0900E').hide(); $('.X0900Z').hide(); 
    $('.X1050').hide(); $('.X1050A').hide(); $('.X1050Z').hide(); 
  }
    
  /****************************** 
             SECTION Z
  *******************************/


}