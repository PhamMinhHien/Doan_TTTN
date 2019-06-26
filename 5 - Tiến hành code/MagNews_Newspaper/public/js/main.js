(function($){
    "use strict";

    /*==================================================================
    [ Load page ]*/

    try{
        $(".animsition").animsition({
            inClass:'fade-in',
            outClass:'fade-out',
            inDuration:500,
            outDuration:800,
            linkElement:'.animsition-link',
            loading:true,
            loadingParentElement:'html',
            loadingClass:'animsition-loading-1',
            loadingInner:'<div class="loader-animsition"></div>',
            timeOut:false,
            timeoutCountdown:1500,
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
                centeredSlides: true,
                autoplay: {
                    delay: 4000,
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

    /*==================================================================
    [ Menu - active  ]*/
    try {
        $(function()
        {
            $('.navbar-collapse .navbar-nav li a').filter(function(){return this.href==location.href}).addClass('active');
        })
    } catch(er) {console.log(er);}



    /*==================================================================
    [ VALIDATE  LOGIN ]*/
    try 
    {
        // Validate email 
        $( "#email" ).focusout(function() 
        {
            var email = $("#email").val(); // lấy email
            var $result_email = $("#result-email"); // gọi biến kết quả chứa 
            $result_email.text("");

            if (validateEmail(email)) 
            {
                $result_email.text(" ");
                $result_email.css("color", "green");
                $("#password").prop('disabled', false);
            } 
            else 
            {
                $result_email.text("Email : " + email + " không đạt yêu cầu .");
                $result_email.css("color", "red");
                $("#password").prop('disabled', true);
            }
            return false;
        });

        // Validate password 
        $("#password").on('keypress keyup keydown focusout',function()
        {
            var password = $("#password").val().length;
            var $result_pass = $("#result-pass"); // gọi biến kết quả chứa 

            if(password > 5 && password < 50)
            {
                $result_pass.text("");
                $("#btn-submit").prop('disabled', false);
                $("#btn-submit").css("opacity", "1");
            }
            else
            {
                $result_pass.text("Độ dài yêu cầu : 6 <= Password <= 50 !");
                $result_pass.css("color", "red");
                $("#btn-submit").prop('disabled', true);
                $("#btn-submit").css("opacity", "0.5");
            }
        });
         

        function validateEmail(email) 
        {
            // Chỉ sử dụng email có @gmail.com
            var re = /^[A-Z0-9._%+-]+@(gmail+\.)+com$/i;
            return re.test(email);
        }
    } catch(er) {console.log(er);}



    /*==================================================================
    [ Search - tìm kiếm   ]*/

    try 
    {
        
    } catch(er) {console.log(er);}

})(jQuery);