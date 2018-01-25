jQuery(function($){

    $('.timeline h3,.timeline .thumb').click(function(){
        var parent = $(this).parents('article');
        //console.log(parent.children('input'));
        if(!parent.children('input').prop('checked')){
            parent.children('input').prop('checked',true);
        }
    });

});