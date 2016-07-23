$(function(){
    var $title = $('form.ajax-search').find('input.title');
    var $location = $('form.ajax-search').find('input.location');
    var $min = $('form.ajax-search').find('input.min');
    var $max = $('form.ajax-search').find('input.max');
    var $category = $('.job-categories').find('li').find('a');
    var $types = $('.job-types').find('li').find('a');
    var $content = $('.job-list');
    var cat = [];
    var typ = [];
    var title = [];
    var location = [];
    var min = [];
    var max = [];
    $category.on('click touchstart', function(e){
        e.preventDefault();
        $category.removeClass('pushed');
        $(this).addClass('pushed');
        cat = [];
        cat.push($(this).attr('href'));
        callAjax();
    });
    $types.on('click touchstart', function(e){
        e.preventDefault();
        $types.removeClass('pushed');
        $(this).addClass('pushed');
        typ = [];
        typ.push($(this).attr('href'));
        callAjax();
    });
    $(document).on('keyup', ($title, $location, $min, $max), function(e){
        e.preventDefault();
        title = [];
        location = [];
        min = [];
        max = [];
        title.push($title.val());
        location.push($location.val());
        min.push($min.val());
        max.push($max.val());
        callAjax();
    });
    function callAjax(){
        $content.stop().animate({
            opacity: 0.3
        }, 300);
        setTimeout(function(){
            $.ajax({
                type : 'POST',
                url : searchAjax.ajaxurl,
                data : {
                    action : 'ajax_search',
                    query : title[0],
                    location : location[0],
                    category : cat[0],
                    type : typ[0],
                    min : min[0],
                    max : max[0],
                },
                success : function( response ) {
                    $content.html(response);
                    $content.stop().animate({
                        opacity: 1
                    }, 300);
                    setTimeout(function(){
                        $('.parentH').each(function(){
                            if($(window).width() >= 800) {
                                $(this).height(0);
                                $(this).height('auto');
                                $(this).height($(this).parent().height());
                            } else {
                                $(this).height('auto');
                            }
                        });
                    }, 500);
                }
            });
            return false;
        }, 500);
    }
});