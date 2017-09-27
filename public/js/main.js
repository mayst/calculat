jQuery.fn.exists = function() {
    return $(this).length;
}

jQuery.fn.extend({
    toggleText:function(a,b){
        if(this.html()==a){this.html(b)}
        else{this.html(a)}
    }
});

jQuery(document).ready(function($) {
    $('.select').niceSelect();

    // $( function() {
    //   $( "#slider-range1" ).slider({
    //     range: true,
    //     min: 0,
    //     max: 100,
    //     values: [ 55, 73 ],
    //     slide: function( event, ui ) {
    //       $( "#amount1" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
    //     }
    //   });
    //   $( "#amount1" ).val( "$" + $( "#slider-range1" ).slider( "values", 0 ) +
    //     " - $" + $( "#slider-range1" ).slider( "values", 1 ) );
    // } );

    // $( function() {
    //   $( "#slider-range2" ).slider({
    //     range: true,
    //     min: 0,
    //     max: 100,
    //     values: [ 55, 73 ],
    //     slide: function( event, ui ) {
    //       $( "#amount2" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
    //     }
    //   });
    //   $( "#amount2" ).val( "$" + $( "#slider-range2" ).slider( "values", 0 ) +
    //     " - $" + $( "#slider-range2" ).slider( "values", 1 ) );
    // } );

    // $( function() {
    //   $( "#slider-range3" ).slider({
    //     range: true,
    //     min: 0,
    //     max: 100,
    //     values: [ 55, 73 ],
    //     slide: function( event, ui ) {
    //       $( "#amount3" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
    //     }
    //   });
    //   $( "#amount3" ).val( "$" + $( "#slider-range3" ).slider( "values", 0 ) +
    //     " - $" + $( "#slider-range3" ).slider( "values", 1 ) );
    // } );

    $('.popup-content').magnificPopup({
        type: 'inline',
        removalDelay: 300,
        mainClass: 'my-mfp-zoom-in'
    });

    var tabContainers = $('.popup-tab');
    tabContainers.hide().filter(':first').show();

    $('.popup-tabs-btn').click(function () {
        tabContainers.hide();
        tabContainers.filter(this.hash).show();
        $('.popup-tabs-btn').removeClass('active');
        $(this).addClass('active');
        return false;
    }).filter(':first').click();

    // var owl = $('.men-slider');
    // owl.owlCarousel({
    //   items: 4,
    //   loop: true,
    //   autoplay: true,
    //   autoplayTimeout: 5000,
    //   smartSpeed: 400,
    //   margin: 0,
    //   responsive: {
    //     991: {
    //       items: 3,
    //     },
    //     1200: {
    //       items: 4,
    //       margin: 5
    //     }
    //   },
    // });

    // $('.slider-prev').click(function() {
    //   owl.trigger('prev.owl.carousel');
    // });
    // $('.slider-next').click(function() {
    //   owl.trigger('next.owl.carousel');
    // });

    var owl2 = $('.gallery-slider');
    owl2.owlCarousel({
        items: 3,
        loop: true,
        autoplay: true,
        autoplayTimeout: 5000,
        smartSpeed: 400,
        margin: 0,
        responsive: {
            0: {
                items: 2,
                margin: 10
            },
            768: {
                items: 2,
                margin: 10
            },
            991: {
                items: 3,
                margin: 30
            },
            1200: {
                items: 3,
                margin: 30
            }
        },
    });

    $('.slider-prev2').click(function() {
        owl2.trigger('prev.owl.carousel');
    });
    $('.slider-next2').click(function() {
        owl2.trigger('next.owl.carousel');
    });

    var owl3 = $('.gallery-slider2');
    owl3.owlCarousel({
        items: 2,
        loop: true,
        autoplay: true,
        autoplayTimeout: 5000,
        smartSpeed: 400,
        margin: 10,
        responsive: {
            991: {
                items: 2,
                margin: 10
            },
            1200: {
                items: 2,
                margin: 30
            }
        },
    });

    $('.slider-prev3').click(function() {
        owl3.trigger('prev.owl.carousel');
    });
    $('.slider-next3').click(function() {
        owl3.trigger('next.owl.carousel');
    });

    var indexClick = 0;
    var indexClick2 = 0;

    $('.notification-click').click(function(event) {
        if (indexClick === 0) {
            $('.notification').show();
            $('.notification').addClass('active')
            indexClick = 1;
        }
        else {
            $('.notification').hide();
            indexClick = 0;
        }
        event.stopPropagation();
    });
    $(document).click(function(event) {
        if ($(event.target).closest(".notification").length) return;
        $('.notification').hide();
        indexClick = 0;
        event.stopPropagation();
    });

    $('.acc-setting-link img').click(function(event) {
        //$(this).find('.acc-setting').toggleClass('open');
        if (indexClick2 === 0) {
            $('.acc-setting').show();
            $('.acc-setting').addClass('active')
            indexClick2 = 1;
        }
        else {
            $('.acc-setting').hide();
            indexClick2 = 0;
        }
        event.stopPropagation();
    });
    $(document).click(function(event) {
        if ($(event.target).closest(".acc-setting").length) return;
        $('.acc-setting').hide();
        indexClick2 = 0;
        event.stopPropagation();
    });


    $('.header-burger').click(function() {
        $(this).toggleClass("close");
        $('.main-header').toggleClass('open');
        $('.navigation').slideToggle();
        $('.mobile-nav').slideToggle();
    });

    $('.navigation .dropdown').hover(function(e) {
        e.preventDefault();
        $(this).find('.dropdown-list').slideToggle();
    });

    $('.mobile-nav .dropdown').hover(function(e) {
        e.preventDefault();
        $(this).find('.dropdown-list').slideToggle();
    });

    $('.aside-dropdown').click(function(e) {
        e.preventDefault();
        $(this).find('.aside-dropdown-list').slideToggle();
    });

    var owl4 = $('.finding-people');
    owl4.owlCarousel({
        items: 1,
        loop: true,
        autoplay: false,
        autoplayTimeout: 5000,
        smartSpeed: 400,
        margin: 10,
        responsive: {
            500: {
                items: 2,
                margin: 10
            },
            1200: {
                items: 2,
                margin: 30
            }
        },
    });

    $('.men-slider').on('init', function(event, slick){
        var current = $(this).find('.slick-current').find('.man');
        var name = $(current).attr('data-name');
        var address = $(current).attr('data-address');

        $(".happy-dating-man .man-info").find(".name").text(name);
        $(".happy-dating-man .man-info").find(".address").text(address);
    });

    $('.slider-for').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: '.slider-nav'
    });
    $('.slider-nav').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        asNavFor: '.slider-for',
        dots: false,
        centerMode: false,
        focusOnSelect: true,
        nextArrow: $('.happy-dating-men .slider-next1'),
        prevArrow: $('.happy-dating-men .slider-prev1'),
        responsive: [
            {
                breakpoint: 401,
                settings: {
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 3
                }
            },
        ]
    });

    $('.men-slider').on('afterChange', function(event, slick, currentSlide, nextSlide){
        var current = $(this).find('.slick-current').find('.man');
        var name = $(current).attr('data-name');
        var address = $(current).attr('data-address');

        $(".happy-dating-man .man-info").find(".name").text(name);
        $(".happy-dating-man .man-info").find(".address").text(address);
    });

    var tabContainers2 = $('.profile-info-single');
    tabContainers2.hide().filter(':first').show();
    $('.profile-tabs-btn').click(function () {
        tabContainers2.hide();
        tabContainers2.filter(this.hash).show();
        $('.profile-tabs-btn').removeClass('active');
        $(this).addClass('active');
        return false;
    }).filter(':first').click();


    $('.mobile-tab1').click(function(e) {
        e.preventDefault();
        $('#profile-tab1').slideToggle();
        $(this).toggleClass('open')
    });

    $('.mobile-tab2').click(function(e) {
        e.preventDefault();
        $('#profile-tab2').slideToggle();
        $(this).toggleClass('open')
    });

    $('.mobile-tab3').click(function(e) {
        e.preventDefault();
        $('#profile-tab3').slideToggle();
        $(this).toggleClass('open')
    });




    $('.mobile-hide').click(function(e) {
        e.preventDefault();
        $('.search-main-form').slideToggle();
        $(this).toggleText('<i class="fa fa-angle-down" aria-hidden="true"></i>Show filters', '<i class="fa fa-angle-up" aria-hidden="true"></i>Hide filters');
    });


    var heightSlider = document.getElementById('height-slider');

    noUiSlider.create(heightSlider, {
        start: [1.50, 2.10],
        connect: true,
        tooltips: true,
        step: 0.10,
        range: {
            'min': 1.40,
            'max': 2.60,
        },
    });

    var ageSlider = document.getElementById('age-slider');

    noUiSlider.create(ageSlider, {
        start: [25, 45],
        connect: true,
        tooltips: true,
        step: 1,
        range: {
            'min': 18,
            'max': 70,
        },
        format: {
            to: function ( value ) {
                return value + '';
            },
            from: function ( value ) {
                return value.replace(',-', '');
            }
        }
    });

    var weightSlider = document.getElementById('weight-slider');

    noUiSlider.create(weightSlider, {
        start: [55, 93],
        connect: true,
        tooltips: true,
        step: 1,
        range: {
            'min': 30,
            'max': 120,
        },
        format: {
            to: function ( value ) {
                return value + '';
            },
            from: function ( value ) {
                return value.replace(',-', '');
            }
        }
    });

});