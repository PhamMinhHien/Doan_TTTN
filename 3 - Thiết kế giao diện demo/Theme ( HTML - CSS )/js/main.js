(function($){
	"use strict";

	/*==================================================================
    [ Load page ]*/

    try{
    	$(".animsition").animsition({
    		inClass:'fade-in',
    		outClass:'fade-out',
    		inDuration:1500,
    		outDuration:800,
    		linkElement:'.animsition-link',
    		loading:true,
    		loadingParentElement:'html',
    		loadingClass:'animsition-loading-1',
    		loadingInner:'<div class="loader-animsition"></div>',
    		timeOut:false,
    		timeoutCountdown:5000,
    		onLoadEvent:true,
    		browser:[ 'animation-duration', '-webkit-animation-duration'],
    		overlay:false,
    		overlayClass:'animsition-overlay-slide',
    		overlayParentElement : 'html',
    		transition:function(url){window.location.href = url;}
    	});
    }
    catch(er) {console.log(er);}

    /*==================================================================
    [ Back to top ]*/
    try {
        var windowH = $(window).height()/2;

        $(window).on('scroll',function(){
            if ($(this).scrollTop() > windowH) {
                $("#myBtn").addClass('show-btn-back-to-top');
            } else {
                $("#myBtn").removeClass('show-btn-back-to-top');
            }
        });

        $('#myBtn').on("click", function(){
            $('html, body').animate({scrollTop: 0}, 300);
        });
    } catch(er) {console.log(er);}

    /*==================================================================
    [ Fixed menu ]*/
    try {
        $(document).on('scroll' , function() {
            window.onscroll = function() {scrollMenu()};
            var header = document.getElementById("my-menu");
            var sticky = header.offsetTop;

            function scrollMenu() {
                if (window.pageYOffset > sticky) {
                    header.classList.add("sticky");
                } else {
                    header.classList.remove("sticky");
                }
            }
        });
    } catch(er) {console.log(er);}


    /*==================================================================
    [ Slide Swiper ]*/
    try {
        $(document).ready(function() {
            var swiper = new Swiper('.swiper-container', {
                spaceBetween: 30,
                centeredSlides: true,
                autoplay: {
                    delay: 2500,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
            });
        });
    } catch(er) {console.log(er);}




    /*==================================================================
    [ Play video 01 ]*/
    try {
        var srcOld = $('.video-mo-01').children('iframe').attr('src');

        $('[data-target="#modal-video-01"]').on('click',function(){
            $('.video-mo-01').children('iframe')[0].src += "&autoplay=1";

            setTimeout(function(){
                $('.video-mo-01').css('opacity','1');
            },300);      
        });

        $('[data-dismiss="modal"]').on('click',function(){
            $('.video-mo-01').children('iframe')[0].src = srcOld;
            $('.video-mo-01').css('opacity','0');
        });
    } catch(er) {console.log(er);}

})(jQuery);