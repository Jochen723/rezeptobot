var offset=$("#wrap").offset(),topPadding=25;$(window).scroll(function(){$(window).scrollTop()>offset.top?$("#wrap").stop().animate({marginTop:$(window).scrollTop()-offset.top+topPadding}):$("#wrap").stop().animate({marginTop:0})}),$(function(){$('a[href*="#"]:not([href="#"])').click(function(){if(location.pathname.replace(/^\//,"")==this.pathname.replace(/^\//,"")&&location.hostname==this.hostname){var o=$(this.hash);if((o=o.length?o:$("[name="+this.hash.slice(1)+"]")).length)return $("html, body").animate({scrollTop:o.offset().top-30},1e3),!1}})});