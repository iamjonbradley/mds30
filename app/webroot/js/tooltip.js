$(document).ready(function() 
{     
  $(".tooltip") .mousemove(function() { 
    // var t = this.title + " ( <a href='#'>close</a> )";
    var t = this.title;
    $(".tip").show().html(t);
  });  
  $(".tip") .click(function() { 
    $(".tip").fadeOut();
  });  
}); 