jQuery(function($){
    $('.slider-for').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        speed: 200,
        arrows: false,
        infinite: false,
        adaptiveHeight: true,
        //respondTo: "min",
        //touchThreshold: 0.5,
        //fade: true,
        initialSlide: 1,
        //adaptiveHeight: true,
        asNavFor: '.slider-nav',
        responsive: [{
            breakpoint: 640,
            settings: {
                adaptiveHeight: true,
            }
        }]
    });
    $('.slider-nav').slick({
        accessibility: false,
        autoplay: false,
        slidesToShow: 6,
        slidesToScroll: 1,
        speed: 300,
        asNavFor: '.slider-for',
        edgeFriction: 0,
        //touchThreshold: 1,
        //dots: true,
        arrows: false,
        infinite: false,
        respondTo: "min",
        // 最初のスライダーの位置
        initialSlide: 1,
        //centerMode: true,
        swipe: true,
        focusOnSelect: true,
        responsive: [{
            breakpoint: 640,
            settings: {
                slidesToShow: 4,
            }
        }]
    });
    
    var navTop = $('.slider-for').offset().top - 40;
    var next = 1;
    var prev = 1;
    $('.slider-for').on('afterChange', function(event, slick, currentSlide, nextSlide){
        var element = $(this).find('.slick-current');
        if(!element.hasClass('display')){
            var data = element.attr('data-schedule');
            var jqXHR = ajaxScheduleFunc(data);
            jqXHR.always(function(results){
                if(results != 'NotData'){
                    var empty;
                    var txt;
                    //console.log(element);
                    if(results != null){
                        txt = results.responseText;
                        var html = txt.substr(0,(txt.length-2));
                        element.append(html);
                        element.addClass('display');
                        element.children('.loading').hide();
                    }else{
                        console.log('Error');
                        //return false;
                    }
                }else{
                    console.log('Error');
                    //return false;
                }
            });
        }
        if($(window).width() < 640){
            next = currentSlide;
            if(next != prev){
                $("html,body").animate({scrollTop: navTop},0);
                prev = next;
            }
        }
    });

    function ajaxScheduleFunc(data){
        var plugin = pacSetting();
        var jqXHR = $.ajax({
            type: 'post',
            url: plugin.url+'/inc/getposts.php',
            data: {
                'schedule':data
            }
        });
        return jqXHR;
    }
});

function pacSetting(){
	var data = new Object();
	data.url = "/wp-content/themes/starter";
	return data;
}

// ページの読み込みが完全に完了したら以下の処理を実行
jQuery(function ($) {
    if($(window).width() < 640){
    if($('.schedule-nav').length){
    var element = $('.schedule-nav');
    var entry = $('body');
    // 「#top-bar」を固定/解除するための基準となる値を取得し、変数「topbar」に代入
    var topbar = element.offset().top - 0;
/*
    // 「#bottom-bar」を固定/解除するための基準となる値を取得し、
    // 変数「bottombar」に代入
    var bottombar = $("#related-posts").offset().top - $(window).height() + 24
        + element.height();
*/
    // 画面がスクロールされたら以下の処理を実行
    $(window).scroll(function () {
/*
    // 「#top-bar」上にScrollTopの位置の値を表示
    element.text(
        "「#top-bar」scrollTop: " + $(this).scrollTop()
    );
*/
    // ScrollTopの位置が「topbar」よりも値が大きければ、「#top-bar」を固定し、
    // 記事部分のブロック要素の位置を「#top-bar」の高さ分だけ下げる
    if ($(window).scrollTop() > topbar) {

        element.css({"position": "fixed", "top": "0"});
        entry.css({"position": "relative", "top": element.height() + "px"});

    // 小さければ、「#top-bar」の固定を解除し、
    // 記事部分のブロック要素の位置を元に戻す
    } else {

        element.css("position", "static");
        entry.css({"position": "relative", "top": 0});

    }
/*
    // ScrollTopの位置が「bottombar」よりも値が小さければ、
    // 「#bottom-bar」を固定
    if ($(window).scrollTop() < bottombar) {
        $("#bottom-bar").addClass("fixed-bottom");
    // 大きければ、「#bottom-bar」の固定を解除
    } else {
        $("#bottom-bar").removeClass("fixed-bottom");
    }
*/
    });
    }
    }
});