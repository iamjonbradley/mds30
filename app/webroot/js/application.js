$(document).ready(function() {   

  $('.facility').change(function () {
    $.get("/midnight_rules/lookup", 
      { facility_id:  $('.facility').val() },
      function(data){
        $('.residents').html(data);
      }
    );
  });
  
  $(".left-nav").show();
  
  $('#select-all').click(function () {
  	$('input[type=checkbox]').attr('checked','checked');
  });
  
  $(".tooltip") .mousemove(function() { 
    var t = this.title + " ( <a href='#'>close</a> )";
    $(".tip").show().html(t);
  });  

  $(".tip").click(function() { 
    $(".tip").fadeOut();
  });  
  
  $('#I8000A').keyup(function () {
    $.get("/idc9_codes/lookup", {code:  $('#I8000A').val()},
    function(data){$('.I8000A').html(data);});
  })
  $('#I8000B').keyup(function () {
    $.get("/idc9_codes/lookup", {code:  $('#I8000B').val()},
    function(data){$('.I8000B').html(data);});
  })
  $('#I8000C').keyup(function () {
    $.get("/idc9_codes/lookup", {code:  $('#I8000C').val()},
    function(data){$('.I8000C').html(data);});
  })
  $('#I8000D').keyup(function () {
    $.get("/idc9_codes/lookup", {code:  $('#I8000D').val()},
    function(data){$('.I8000D').html(data);});
  })
  $('#I8000E').keyup(function () {
    $.get("/idc9_codes/lookup", {code:  $('#I8000E').val()},
    function(data){$('.I8000E').html(data);});
  })
  $('#I8000F').keyup(function () {
    $.get("/idc9_codes/lookup", {code:  $('#I8000F').val()},
    function(data){$('.I8000F').html(data);});
  })
  $('#I8000G').keyup(function () {
    $.get("/idc9_codes/lookup", {code:  $('#I8000G').val()},
    function(data){$('.I8000G').html(data);});
  })
  $('#I8000H').keyup(function () {
    $.get("/idc9_codes/lookup", {code:  $('#I8000H').val()},
    function(data){$('.I8000H').html(data);});
  })
  $('#I8000I').keyup(function () {
    $.get("/idc9_codes/lookup", {code:  $('#I8000I').val()},
    function(data){$('.I8000I').html(data);});
  })
  $('#I8000J').keyup(function () {
    $.get("/idc9_codes/lookup", {code:  $('#I8000J').val()},
    function(data){$('.I8000J').html(data);});
  })

  /**
   * copy information
   */
  $("a.copy").click(function() {
    ZeroClipboard.setMoviePath( '/js/ZeroClipboard10.swf' );
    var text = $('textarea#SectionVV0200A' + this.id + 'D').val();
  	var clip = new ZeroClipboard.Client();
  	clip.setText(text);
  	clip.addEventListener('load', function(client) {
      // alert( "movie is loaded" );
  	});
  	clip.glue('copy_me');
  });
  

  $('.history-show').click(function () {
  	$('.' + this.id).show();
  })
  
  $('.clear-caa').click(function () {
  	if ($(this).is(':checked')) {
  		$('#' + this.id + '-input').val();
  		console.log('#' + this.id + '-input');
  	}
  });

  $('.drug-hide td').hide();
  $('.drug-hide th').hide();

  $('.drug-header').click(function () {
    $('.drug-hide td').hide();
    $('.drug-hide th').hide();
    $('.' + this.id + ' td').show();
    $('.' + this.id + ' th').show();
  });

  
}); 

jQuery(document).ready(function($) {
  $('a[rel*=facebox]').facebox()
}) 

// function will clear input elements on each form
function clearForms(){
	// declare element type
	var type = null;
	// loop through forms on HTML page
	for (var x=0; x<document.forms.length; x++){
		// loop through each element on form
		for (var y=0; y<document.forms[x].elements.length; y++){
			// define element type
			type = document.forms[x].elements[y].type
			// alert before erasing form element
			//alert('form='+x+' element='+y+' type='+type);
			// switch on element type
			switch(type){
				case "text":
				case "textarea":
				case "password":
				//case "hidden":
					document.forms[x].elements[y].value = "";
					break;
				case "radio":
				case "checkbox":
					document.forms[x].elements[y].checked = "";
					break;
				case "select-one":
					document.forms[x].elements[y].options[0].selected = true;
					break;
				case "select-multiple":
					for (z=0; z<document.forms[x].elements[y].options.length; z++){
						document.forms[x].elements[y].options[z].selected = false;
					}
				break;
			}
		}
	}

}

var d = new Date();
var minYear = d.getFullYear() - 120;
var maxYear = d.getFullYear();
var yearRage = minYear + ':' + maxYear;

var options = {
  inline: true, 
  changeYear: true, 
  dateFormat: 'yy-mm-dd', 
  yearRange: minYear + ':' + maxYear
}
$(function() {
  $('#A0900').datepicker(options);
  $('#A1600').datepicker(options);
  $('#A2000').datepicker(options);
  $('#A2200').datepicker(options);
  $('#A2300').datepicker(options);
  $('#A2400B').datepicker(options);
  $('#A2400C').datepicker(options);

  $('#O0400A5').datepicker(options);
  $('#O0400A6').datepicker(options);
  $('#O0400B5').datepicker(options);
  $('#O0400B6').datepicker(options);
  $('#O0400C5').datepicker(options);
  $('#O0400C6').datepicker(options);

  $('#Z0400A4').datepicker(options);
  $('#Z0400B4').datepicker(options);
  $('#Z0400C4').datepicker(options);
  $('#Z0400D4').datepicker(options);
  $('#Z0400E4').datepicker(options);
  $('#Z0400F4').datepicker(options);
  $('#Z0400G4').datepicker(options);
  $('#Z0400H4').datepicker(options);
  $('#Z0400I4').datepicker(options);
  $('#Z0400J4').datepicker(options);
  $('#Z0400K4').datepicker(options);
  $('#Z0400L4').datepicker(options);


  $('#ard_start').datepicker(options);
  $('#ard_end').datepicker(options);
  $('#start').datepicker(options);
  $('#end').datepicker(options);
});