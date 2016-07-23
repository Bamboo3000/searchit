var currentState;
var newState;
var xxl = $('*[class*="col-xxl-"]');
var xl = $('*[class*="col-xl-"]');
var l = $('*[class*="col-l-"]');
var m = $('*[class*="col-m-"]');
var s = $('*[class*="col-s-"]');
var xs = $('*[class*="col-xs-"]');
var hundredpercent = {
	xxlScreen : 1441,
	xlScreen : 1280,
	lScreen : 1024,
	mScreen : 800,
	sScreen : 580,
	cState : function(){
		var $window = $(window).innerWidth();
		if($window >= this.xxlScreen){
			currentState = 'xxl';
		} else if($window < this.xxlScreen && $window > this.xlScreen){
			currentState = 'xl';
		} else if($window <= this.xlScreen && $window > this.lScreen){
			currentState = 'l';
		} else if($window <= this.lScreen && $window > this.mScreen){
			currentState = 'm';
		} else if($window <= this.mScreen && $window > this.sScreen){
			currentState = 's';
		} else {
			currentState = 'xs';
		}
	},
	nState : function(){
		var $window = $(window).innerWidth();
		if($window >= this.xxlScreen){
			newState = 'xxl';
		} else if($window < this.xxlScreen && $window > this.xlScreen){
			newState = 'xl';
		} else if($window <= this.xlScreen && $window > this.lScreen){
			newState = 'l';
		} else if($window <= this.lScreen && $window > this.mScreen){
			newState = 'm';
		} else if($window <= this.mScreen && $window > this.sScreen){
			newState = 's';
		} else {
			newState = 'xs';
		}
	},
	drink : function(){
		var $window = $(window).innerWidth();
		if($window > this.xxlScreen){
			xsWidth();
			sWidth();
			mWidth();
			lWidth();
			xlWidth();
			xxlWidth();
		} else if($window > this.xlScreen){
			xsWidth();
			sWidth();
			mWidth();
			lWidth();
			xlWidth();
		} else if($window > this.lScreen){
			xsWidth();
			sWidth();
			mWidth();
			lWidth();
		} else if($window > this.mScreen){
			xsWidth();
			sWidth();
			mWidth();
		} else if($window > this.sScreen){
			xsWidth();
			sWidth();
		} else{
			xsWidth();
		}
	}
}

function xxlWidth()
{
	xxl.each(function(){
		var first = this.className.match(/col-xxl-(\d+)/)[1];
		var second = this.className.match(/col-xxl-(\d+)of(\d+)/)[2];
		var result = (first/second)*100;
		$(this).css({'width' : ''+result+'%'});
	});
}
function xlWidth()
{
	xxl.css({'width' : '100%'});
	xl.each(function(){
		var first = this.className.match(/col-xl-(\d+)/)[1];
		var second = this.className.match(/col-xl-(\d+)of(\d+)/)[2];
		var result = (first/second)*100;
		$(this).css({'width' : ''+result+'%'});
	});
}
function lWidth()
{
	xxl.css({'width' : '100%'});
	xl.css({'width' : '100%'});
	l.each(function(){
		var first = this.className.match(/col-l-(\d+)/)[1];
		var second = this.className.match(/col-l-(\d+)of(\d+)/)[2];
		var result = (first/second)*100;
		$(this).css({'width' : ''+result+'%'});
	});
}
function mWidth()
{
	xxl.css({'width' : '100%'});
	xl.css({'width' : '100%'});
	l.css({'width' : '100%'});
	m.each(function(){
		var first = this.className.match(/col-m-(\d+)/)[1];
		var second = this.className.match(/col-m-(\d+)of(\d+)/)[2];
		var result = (first/second)*100;
		$(this).css({'width' : ''+result+'%'});
	});
}
function sWidth()
{
	xxl.css({'width' : '100%'});
	xl.css({'width' : '100%'});
	l.css({'width' : '100%'});
	m.css({'width' : '100%'});
	s.each(function(){
		var first = this.className.match(/col-s-(\d+)/)[1];
		var second = this.className.match(/col-s-(\d+)of(\d+)/)[2];
		var result = (first/second)*100;
		$(this).css({'width' : ''+result+'%'});
	});
}
function xsWidth()
{
	xxl.css({'width' : '100%'});
	xl.css({'width' : '100%'});
	l.css({'width' : '100%'});
	m.css({'width' : '100%'});
	s.css({'width' : '100%'});
	xs.each(function(){
		var first = this.className.match(/col-xs-(\d+)/)[1];
		var second = this.className.match(/col-xs-(\d+)of(\d+)/)[2];
		var result = (first/second)*100;
		$(this).css({'width' : ''+result+'%'});
	});
}

$(function(){
	hundredpercent.cState();
	hundredpercent.drink();
});
$(window).on('load', function(){
	hundredpercent.cState();
	hundredpercent.drink();
});
$(window).on('resize', function(){
	hundredpercent.nState();
	if(newState !== currentState){
		hundredpercent.drink();
		hundredpercent.cState();
	}
});
$(document).ajaxComplete(function(){
	var currentState;
	var newState;
	var xxl = $('*[class*="col-xxl-"]');
	var xl = $('*[class*="col-xl-"]');
	var l = $('*[class*="col-l-"]');
	var m = $('*[class*="col-m-"]');
	var s = $('*[class*="col-s-"]');
	var xs = $('*[class*="col-xs-"]');
	var hundredpercent = {
		xxlScreen : 1441,
		xlScreen : 1280,
		lScreen : 1024,
		mScreen : 800,
		sScreen : 580,
		cState : function(){
			var $window = $(window).innerWidth();
			if($window >= this.xxlScreen){
				currentState = 'xxl';
			} else if($window < this.xxlScreen && $window > this.xlScreen){
				currentState = 'xl';
			} else if($window <= this.xlScreen && $window > this.lScreen){
				currentState = 'l';
			} else if($window <= this.lScreen && $window > this.mScreen){
				currentState = 'm';
			} else if($window <= this.mScreen && $window > this.sScreen){
				currentState = 's';
			} else {
				currentState = 'xs';
			}
		},
		nState : function(){
			var $window = $(window).innerWidth();
			if($window >= this.xxlScreen){
				newState = 'xxl';
			} else if($window < this.xxlScreen && $window > this.xlScreen){
				newState = 'xl';
			} else if($window <= this.xlScreen && $window > this.lScreen){
				newState = 'l';
			} else if($window <= this.lScreen && $window > this.mScreen){
				newState = 'm';
			} else if($window <= this.mScreen && $window > this.sScreen){
				newState = 's';
			} else {
				newState = 'xs';
			}
		},
		drink : function(){
			var $window = $(window).innerWidth();
			if($window > this.xxlScreen){
				xsWidth();
				sWidth();
				mWidth();
				lWidth();
				xlWidth();
				xxlWidth();
			} else if($window > this.xlScreen){
				xsWidth();
				sWidth();
				mWidth();
				lWidth();
				xlWidth();
			} else if($window > this.lScreen){
				xsWidth();
				sWidth();
				mWidth();
				lWidth();
			} else if($window > this.mScreen){
				xsWidth();
				sWidth();
				mWidth();
			} else if($window > this.sScreen){
				xsWidth();
				sWidth();
			} else{
				xsWidth();
			}
		}
	}

	function xxlWidth()
	{
		xxl.each(function(){
			var first = this.className.match(/col-xxl-(\d+)/)[1];
			var second = this.className.match(/col-xxl-(\d+)of(\d+)/)[2];
			var result = (first/second)*100;
			$(this).css({'width' : ''+result+'%'});
		});
	}
	function xlWidth()
	{
		xxl.css({'width' : '100%'});
		xl.each(function(){
			var first = this.className.match(/col-xl-(\d+)/)[1];
			var second = this.className.match(/col-xl-(\d+)of(\d+)/)[2];
			var result = (first/second)*100;
			$(this).css({'width' : ''+result+'%'});
		});
	}
	function lWidth()
	{
		xxl.css({'width' : '100%'});
		xl.css({'width' : '100%'});
		l.each(function(){
			var first = this.className.match(/col-l-(\d+)/)[1];
			var second = this.className.match(/col-l-(\d+)of(\d+)/)[2];
			var result = (first/second)*100;
			$(this).css({'width' : ''+result+'%'});
		});
	}
	function mWidth()
	{
		xxl.css({'width' : '100%'});
		xl.css({'width' : '100%'});
		l.css({'width' : '100%'});
		m.each(function(){
			var first = this.className.match(/col-m-(\d+)/)[1];
			var second = this.className.match(/col-m-(\d+)of(\d+)/)[2];
			var result = (first/second)*100;
			$(this).css({'width' : ''+result+'%'});
		});
	}
	function sWidth()
	{
		xxl.css({'width' : '100%'});
		xl.css({'width' : '100%'});
		l.css({'width' : '100%'});
		m.css({'width' : '100%'});
		s.each(function(){
			var first = this.className.match(/col-s-(\d+)/)[1];
			var second = this.className.match(/col-s-(\d+)of(\d+)/)[2];
			var result = (first/second)*100;
			$(this).css({'width' : ''+result+'%'});
		});
	}
	function xsWidth()
	{
		xxl.css({'width' : '100%'});
		xl.css({'width' : '100%'});
		l.css({'width' : '100%'});
		m.css({'width' : '100%'});
		s.css({'width' : '100%'});
		xs.each(function(){
			var first = this.className.match(/col-xs-(\d+)/)[1];
			var second = this.className.match(/col-xs-(\d+)of(\d+)/)[2];
			var result = (first/second)*100;
			$(this).css({'width' : ''+result+'%'});
		});
	}

	$(function(){
		hundredpercent.cState();
		hundredpercent.drink();
	});
	$(window).on('load', function(){
		hundredpercent.cState();
		hundredpercent.drink();
	});
	$(window).on('resize', function(){
		hundredpercent.nState();
		if(newState !== currentState){
			hundredpercent.drink();
			hundredpercent.cState();
		}
	});
});