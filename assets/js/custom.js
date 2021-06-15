/* Back To Top */
$(window).scroll(function (){
    var height_scroll = $(this).scrollTop();
    if(height_scroll > 300) {
        $('.back-top').fadeIn()
    }
    else{
        $('.back-top').fadeOut()
    }
});
$('.back-top').click(function() { 
    $('html, body').animate({scrollTop :0}, 1000);
});

/* Language */
$('.language').click(function (){
   $('.select-lg').slideToggle();
   if ($('.money').show()) {
    $('.money').hide();};
   if ($('.list-account').show()) {
    $('.list-account').hide();};
   $('.select-lg').css('z-index', '1000');
});
/* Money */
$('.drop-down').click(function (){
    $('.money').slideToggle();
    if ($('.select-lg').show()) {
        $('.select-lg').hide();};
    if ($('.list-account').show()) {
        $('.list-account').hide();};
    $('.money').css('z-index', '1000');
 });
/* Account */
 $('.account').click(function (){
    $('.list-account').slideToggle();
    if ($('.money').show()) {
        $('.money').hide();};
    if ($('.select-lg').show()) {
        $('.select-lg').hide();};
    $('.list-account').css('z-index', '1000');
 });

// Menu Mobile 
$('.nav-mobile').click(function (){
    $('.menu-mobile').toggle(function(){
        $('html').css('overflow-y','hidden');
        $('.nav-overlay').css('position','fixed');
    });
});
/* Hide Menu */
$('.remove').click(function(){
    $('.menu-mobile').css('display', 'none');
    $('html').css('overflow-y','unset');
    $('.nav-overlay').css('position','unset');
});
/* Menu Level 2 */
$('#show-menu-shop').click(function (){
    $('.mega-menu-shop').slideToggle();
});
$('#show-menu-organic').click(function (){
    $('.mega-menu-organic').toggle();
});
$('#show-menu-page').click(function (){
    $('.mega-menu-page').toggle();
});

// Slide for Banner 
$('.owl-carousel.owl-banner').owlCarousel({
    items: 1,
    dots: false,
    loop: true,
    autoplay:true,
    autoplayTimeout: 5000,
    nav: true,
    navText: [
    '<i class="fal fa-chevron-left next-page next-left">',
    '<i class="fal fa-chevron-right next-page next-right">'
    ] 
});

// Slide for New Arrivals
$('.owl-carousel.owl-product').owlCarousel({
    loop:true,
    margin: 15,
    dots: false,
    autoplay:true,
    autoplayTimeout:5000,
    nav: true,
    navText: [
    '<i class="fal fa-chevron-left btn-prev">',
    '<i class="fal fa-chevron-right btn-next">'
    ],
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
        },
        600:{
            items:2,
        },
        1000:{
            items:3,
        },
        1025:{
            items: 4,
        }

    }
})

// Slide for Brands
$('.owl-brands.owl-carousel').owlCarousel({
    loop:true,
    dots: false,
    autoplay:true,
    autoplayTimeout:4000,
    nav: true,
    navText: [
    '<i class="fal fa-chevron-left brands-prev">',
    '<i class="fal fa-chevron-right brands-next">'
    ],
    responsive: {
        0:{
            items: 2,
        },
        500:{
            items: 3,
        },
        1024:{
            items: 5,
        },
    },
})

// Change Image Detail
$('.img-child').click(function(){
    var src_img = this.src;
    $('.slide').attr('src', src_img);
});

// The number of products
$('.plus').click(function(){
    $('.value').val( parseInt($('.value').val()) + 1);
});

$('.minus').click(function(){
    var value_a = $('.value').val();
    if(value_a == 1) {
        $('.value').val(1);
    }
    else{
        $('.value').val( parseInt($('.value').val()) - 1);
    }
});

// Toggle Tab
$('.list-item-1').click(function(){
    $('.descriptions').css('display','block');
    $('.reviews').css('display','none');
    $('.list-item').css('border','1px solid #549843');
    $('.list-item-2').css('border','1px solid #fff');

});
$('.list-item-2').click(function(){
    $('.reviews').css('display','block');
    $('.descriptions').css('display','none');
    $('.list-item-1').css('border','1px solid #fff');
    $('.list-item-2').css('border','1px solid #549843');
});

// Toggle Tab Mobile 
$('.tab-description-mb').click(function(){
    $('.content-des').slideToggle();
    // Change arrow direction
    $('.change-arrow-des').toggleClass('fa-caret-down');
    $('.change-arrow-des').toggleClass('fa-caret-up');
})
$('.tab-reviews-mb').click(function(){
    $('.content-rew').slideToggle();
    // Change arrow direction
    $('.change-arrow-rev').toggleClass('fa-caret-down');
    $('.change-arrow-rev').toggleClass('fa-caret-up');
})

// Product Detail
$('.owl-product-detail').owlCarousel({
    dots: false,
    loop: true,
    nav: true,
    navText:[
        '<i class="fal fa-chevron-right next-page next-right">',
        '<i class="fal fa-chevron-left next-page next-left">'
    ],
    responsive:{
        0:{
            items:1
        },
        426:{
            items: 2
        },
        769:{
            items: 3
        }
    }
});

// Notification 
$.validator.setDefaults({
    submitHandler: function() {
        alert("Complete ! See you next time...");
    }
});

// Validate Form Product Detail
$('#form-review-pc').validate({
    rules: {
        name: {
            required: true,
            minlength: 4,

        },
        email: {
            required: true,
            email: true,
        },
        comment: {
            required: true,
            minlength: 20,
        }

    },
    messages: {
        name: {
            required: '<i class="fas fa-exclamation-circle"></i> Bạn chưa nhập tên !',
            minlength: '<i class="fas fa-exclamation-circle"></i> Tên tối thiểu 4 kí tự !'
        },
        email: {
            required: '<i class="fas fa-exclamation-circle"></i> Bạn chưa nhập gmail !',
            email: '<i class="fas fa-exclamation-circle"></i> Định dạng email không hợp lệ vui lòng kiểm tra lại  !',
        },
        comment: {
            required: '<i class="fas fa-exclamation-circle"></i> Vui lòng để lại đánh giá sản phẩm !',
            minlength: '<i class="fas fa-exclamation-circle"></i> Đánh giá tối thiểu 20 kí tự !',
        }
    }
});

/* Validate Form My Account */
// Form Login
$('.form-login').validate({
    rules: {
        l_name: {
            required: true,
            minlength: 4,

        },
        l_password: {
            required: true,
            minlength: 8,
        }
    },

    messages: {
        l_name: {
            required: '<i class="fas fa-times-circle"></i> Bạn chưa nhập tên !',
            minlength: '<i class="fas fa-times-circle"></i> Tên tối thiểu 4 kí tự !'
        },
        l_password: {
            required: '<i class="fas fa-times-circle"></i> Bạn chưa nhập mật khẩu !',
            minlength: '<i class="fas fa-times-circle"></i> Mật khẩu tối thiểu 8 kí tự !',
        }
    }
});

// Form Register
$('.form-register').validate({
    rules: {
        r_name: {
            required: true,
            minlength: 4,
        },
        r_email: {
            required: true,
            email: true,
            
        },
        r_password: {
            required: true,
            minlength: 8,

        },
        r_r_password: {
            required: true,
            minlength: 8,
            equalTo:" #confirm_password",
        }
    },

    messages: {
        r_name: {
            required: '<i class="fas fa-times-circle"></i> Bạn chưa nhập tên !',
            minlength: '<i class="fas fa-times-circle"></i> Tên tối thiểu 4 kí tự !',
        },
        r_email: {
            required: '<i class="fas fa-times-circle"></i> Bạn chưa nhập email !',
            email: '<i class="fas fa-times-circle"></i> Vui lòng nhập địa chỉ email hợp lệ !'
        },
        r_password: {
            required: '<i class="fas fa-times-circle"></i> Bạn chưa nhập mật khẩu !',
            minlength: '<i class="fas fa-times-circle"></i> Mật khẩu tối thiểu 8 kí tự !',
        },
        r_r_password: {
            required: '<i class="fas fa-times-circle"></i> Bạn chưa nhập mật khẩu !',
            minlength: '<i class="fas fa-times-circle"></i> Mật khẩu tối thiểu 8 kí tự !',
            equalTo: '<i class="fas fa-times-circle"></i> Mật khẩu chưa trùng nhau , hãy thử lại !'
        },
    }
});    



// Button Click
$('.plus-product').click(function(){
    alert('Oki');
    $('.value-pro').val(parseInt($('.value-product').val()) + 1);
    var amount = $('.value-product').val();
    var price = $('.price-display').val(parseFloat(amount * 2.5));
});

$('.minus').click(function(){
    var value_pro = $('.value-product').val();
    if(value_pro > 0){
        $('.value-product').val(parseInt($('.value-product').val()) - 1);
        $(this).css('cursor', 'pointer');
        var amount = $('.value-product').val();
        var price = $('.price-display').val(parseFloat(amount * 2.5));
    }
});
