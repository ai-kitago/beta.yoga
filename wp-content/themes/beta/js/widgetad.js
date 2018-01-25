jQuery(window).load(function () {
    if(jQuery(window).width() > 640){
        var stop_h = jQuery('#instagram').offset().top - jQuery('.widget_ad_widget_org').height() -50;
        var widget_w = jQuery('.item-image').width();
        var tab = jQuery('.widget_ad_widget_org'),
        offset = tab.offset();
        
        console.log('takasa : '+stop_h);
        
        jQuery(window).scroll(function () {
            
            console.log(jQuery(window).scrollTop());
            
            if(jQuery(window).scrollTop() > offset.top && jQuery(window).scrollTop() < stop_h) {
                tab.width(widget_w);
                tab.css('top','10px');
                tab.addClass('ad-fixed');
                tab.removeClass('ad-absolute');
            }else if(jQuery(window).scrollTop() > stop_h){
                tab.css('top',stop_h - 130 +'px');
                tab.removeClass('ad-fixed');
                tab.addClass('ad-absolute');
            }else{
                tab.removeClass('ad-fixed');
                tab.removeClass('ad-absolute');
            }
        });
    }
});