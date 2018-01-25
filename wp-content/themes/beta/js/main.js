/*global $:false */

jQuery(document).ready(function($){

    var win_width  = $(window).width();
    var element = $('.slide-menu');
    var children = element.children('li');
    var li_width = win_width / 4;
    var li_count = element.children('li').length;
    element.children('li').width(li_width);
    element.width(li_width * li_count);
/*
    $('.tab_area:last').show();
    $('.tab li:last').addClass('active');
*/

    $('.tab_area:first').show();
    $('.tab li:first').addClass('active');

    $('.tab li').click(function() {
        $('.tab li').removeClass('active');
        $(this).addClass('active');
        $('.tab_area').hide();
        $(jQuery(this).find('a').attr('href')).fadeIn();
        return false;
    });
    /*
    if(!$('.home').length){
        $('.topslider').css('height','400px');
    }
    */
});

jQuery(function($){
    if($(window).width() < 640){
        var size = sp_resize();
        sp_content_image_sizing(size);
    }
    function sp_content_image_sizing(size){
        $('body.single .entry-content img').each(function(){
            if((size.width / $(this).width()) < (size.width / 2 )){
                $(this).css({
                    'width' : '100%',
                    'height' : 'auto',
                    'margin-bottom': '15px'
                });
                $(this).removeClass('alignleft');
                $(this).removeClass('alignright');
            }
        });
    }
    
    function sp_resize(){
        var size = new Array();
        size.width = $(window).width();
        size.height = $(window).height();
        return size;
    }
});

jQuery(window).load(function($){
    
});