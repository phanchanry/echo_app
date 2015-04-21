$(document).ready(function() {

    $(".sortable").sortable();

    if($('ul li.nav-header a').hasClass('active')){
        //alert($('ul li.nav-header a.active').text());
        $('ul li.nav-header a.active').next().addClass('in');
    }



});

$('ul li.nav-header a').click(function(){
    $('ul li.nav-header a').removeClass('active');
    $(this).addClass('active');
    //$('ul li.nav-header a.active').next().addClass('in');
});



$('[data-action=close]').click(function(){
    jQuery(this).closest(".panel").remove();
});


