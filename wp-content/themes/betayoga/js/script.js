jQuery(function($) {
    var topSlider = $('.bxslider').bxSlider({
        auto: false,
		speed: 1000,
		pause: 500,
		mode: 'fade',
		captions: false,
		onSliderLoad:function(currentIndex){
            $('.bxslider').css('margin-left','0');
		}
    });
    $( window ).resize(function(){
		topSlider.reloadSlider();
	});
	
	var topBtn = $('#btn-up');    
    topBtn.hide();
    //スクロールが100に達したらボタン表示
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            topBtn.fadeIn();
        } else {
            topBtn.fadeOut();
        }
    });
    //スクロールしてトップ
    topBtn.click(function () {
        $('body,html').animate({
            scrollTop: 0
        }, 500);
        return false;
    });
});

/* DOMの読み込み完了後に処理 */
if(window.addEventListener) {
	window.addEventListener( "load" , shareButtonReadSyncer, false );
}else{
	window.attachEvent( "onload", shareButtonReadSyncer );
}

/* シェアボタンを読み込む関数 */
function shareButtonReadSyncer(){

// 遅延ロードする場合は次の行と、終わりの方にある行のコメント(//)を外す
// setTimeout(function(){

// Facebook
(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	js = d.createElement(s); js.id = id;
	js.src = "//connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v2.0";
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

// Google+
var scriptTag = document.createElement("script");
scriptTag.type = "text/javascript"
scriptTag.src = "https://apis.google.com/js/platform.js";
scriptTag.async = true;
document.getElementsByTagName("head")[0].appendChild(scriptTag);

// はてなブックマーク
var scriptTag = document.createElement("script");
scriptTag.type = "text/javascript"
scriptTag.src = "https://b.st-hatena.com/js/bookmark_button.js";
scriptTag.async = true;
document.getElementsByTagName("head")[0].appendChild(scriptTag);

// pocket
(!function(d,i){if(!d.getElementById(i)){var j=d.createElement("script");j.id=i;j.src="https://widgets.getpocket.com/v1/j/btn.js?v=1";var w=d.getElementById(i);d.body.appendChild(j);}}(document,"pocket-btn-js"));

//},5000);	//ページを開いて5秒後(5,000ミリ秒後)にシェアボタンを読み込む

}