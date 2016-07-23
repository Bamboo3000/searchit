/*!
 * equalize.js
 * Author & copyright (c) 2012: Tim Svensen
 * Dual MIT & GPL license
 *
 * Page: http://tsvensen.github.com/equalize.js
 * Repo: https://github.com/tsvensen/equalize.js/
 */
!function(i){i.fn.equalize=function(e){var n,t,h=!1,c=!1;return i.isPlainObject(e)?(n=e.equalize||"height",h=e.children||!1,c=e.reset||!1):n=e||"height",i.isFunction(i.fn[n])?(t=0<n.indexOf("eight")?"height":"width",this.each(function(){var e=h?i(this).find(h):i(this).children(),s=0;e.each(function(){var e=i(this);c&&e.css(t,""),e=e[n](),e>s&&(s=e)}),e.css(t,s+"px")})):!1}}(jQuery);


$(function(){
	vHeight();
	centerV();
	divsEqualH()
	labelFile();
	labelFileCV();
	labelFileUniversal();
	labelFileUniversalChange();
	cvFile();
	scrollTo();
	hotSkills();
	mobileBtn();
	filterOpen(250);
	$(".owl-carousel").owlCarousel({
		loop: false,
		items: 1,
		autoplay: true,
		autoplayTimeout: 4000,
    	autoplayHoverPause: true,
    	dots: true,
    	mouseDrag: false,
    	// autoHeight: true
	});
	// applyForm();

	smartsupp('theme:set', 'flat');
	// setup your colors
	smartsupp('theme:colors', {
		primary: '#50e3c2',
		primaryText: '#ffffff',
		widget: '#43c1a5',
		widgetText: '#ffffff',
		banner: '#333333'
	});
});

$(window).on('load resize', function(){
	parentH(50, 150);
	vHeight();
	centerV();
	divsEqualH()
	equalH();
	if($(window).width() >= 800) {
		$('.filter-opener').next().css('display', 'block');
	}
	asideStick();
});
$(document).on('scroll', function(){
	menuStick();
});

function scrollTo(){
	$('.scrollTo').on('click touchstart', function(e){
		e.preventDefault();
		$('html, body').animate({
	        scrollTop: $('.'+$(this).attr('data-to')).offset().top - 120
	    }, 750);
	});
}

function vHeight(){
	$('.vheight').height($(window).height());
}

function centerV(){
	$('.centerV').each(function(){
		$(this).css({'margin-top' : '-'+$(this).height()/2+'px'});
	});
}

function parentH( $time1, $time2 ){
	$('.parentH').each(function(){
		var $this = $(this);
		var $thisH = $this.height();
		var $child = $this.children();
		var $childH = $child.height();

		$child.outerHeight('auto');
		if($(window).width() >= 800) {
			setTimeout(function() {
				$child.outerHeight($thisH);	
			}, $time1);
			setTimeout(function() {
				$child.outerHeight($thisH);	
			}, $time2);
		}

	});
}

function menuStick(){
	if($(window).scrollTop() >= 34){
		$('nav.main-navigation').addClass('stick');
	} else{
		$('nav.main-navigation').removeClass('stick');
	}
}

function divsEqualH(){
	var maxHeight = -1;

	$('.footer-section').each(function() {
		maxHeight = maxHeight > $(this).height() ? maxHeight : $(this).height();
	});
	if($(window).width() >= 1024) {
		$('.footer-section').each(function() {
			$(this).height(maxHeight);
		});
	} else {
		$('.footer-section').each(function() {
			$(this).height('auto');
		});
	}
}

function equalH(){
	var maxHeight = -1;

	$('.equalH').each(function() {
		maxHeight = maxHeight > $(this).height() ? maxHeight : $(this).height();
	});
	$('.equalH').each(function() {
		$(this).height(maxHeight);
	});
}

function asideStick(){
	if($(window).width() >= 800) {
		if($(window).height() - $('.main-navigation').height() > $('.job-filters, .job-details').find('aside').outerHeight()){
			$('.job-filters, .job-details').find('aside').addClass('sticky');
		} else {
			$('.job-filters, .job-details').find('aside').removeClass('sticky');
		}
	}
	if($(window).width() > 1920 && $('.job-filters, .job-details').find('aside').hasClass('sticky')) {
		$('.job-filters, .job-details').find('aside').css({'left' : ''+($(window).width() - 1920)/2+'px'});
	} else {
		$('.job-filters, .job-details').find('aside').css({'left' : '0'});
	}
}

function labelFile(){
	$('form').find('.photoLabel').on('click touchstart', function(){
		$(this).parent().find('.photo-file').trigger('click');
	});
}

function labelFileCV(){
	$('form').find('.cvLabel').on('click touchstart', function(){
		$(this).parent().find('.cv').trigger('click');
	});
}

function labelFileUniversal(){
	$('form').find('label.file').on('click touchstart', function(){
		$('form').find('input.file').trigger('click');
	});
}

function labelFileUniversalChange(){
	$('form').find('input.file').on('change', function(input){
		$('form').find('label.file').text($('form').find('input.file').val().replace("C:\\fakepath\\", ""));
	});
}

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#labelP').css('background-image', 'url('+e.target.result+')');
            $('.photoLabel').text('');
            $('.apply-form').find('input.photo-url').val('');
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function cvFile(){
	$('label.cvLabel').prev().on('change', function(input){
		$(this).next().text($(this).val().replace("C:\\fakepath\\", ""));
	});
}

function hotSkills(){
	$('footer').find('.hot-skills').find('a').on('click touchstart', function(e){
		e.preventDefault();
		var str = $(this).attr('href');
		var $search = str.replace( " ", "+" );
		window.location.href = 'https://www.searchitrecruitment.com/?s=' + $search;
	});
}

function mobileBtn() {
	$('.mobile-menu-btn').on('click', function(e) {
		e.preventDefault();
		$(this).toggleClass('active');
		$('ul.main-menu').toggleClass('active');
	});
}

function filterOpen( $time ) {
	$('.filter-opener').on('click', function() {
		$(this).next().slideToggle( $time );
	});
}