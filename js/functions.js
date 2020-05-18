// remap jQuery to $
(function ($) {
    
    // CSS Menu
    $(document).ready(function (){

    $('#cssmenu li.active').addClass('open').children('ul').show();
        $('#cssmenu li.has-sub>a').on('click', function(){
            $(this).removeAttr('href');
            var element = $(this).parent('li');
            if (element.hasClass('open')) {
                element.removeClass('open');
                element.find('li').removeClass('open');
                element.find('ul').slideUp(500);
            }
            else {
                element.addClass('open');
                element.children('ul').slideDown(500);
                element.siblings('li').children('ul').slideUp(500);
                element.siblings('li').removeClass('open');
                element.siblings('li').find('li').removeClass('open');
                element.siblings('li').find('ul').slideUp(500);
            }
        });

    });
    // CSS Menu
    
	/* Add Class */
	$(document).ready(function (){
        
        $(".ajax").colorbox();

	});
    /* Add Class */

}(window.jQuery || window.$));
