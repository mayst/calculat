/* GLOBAL VARIABLES */
(function() {
    EDUCATION_FOCUS_INIT = false;

    INIT_OWL_SLIDER_FOR_QUICK_SEARCH = null;

    DOMAIN = "https://dovedating.com";

})();

$("#account-logout").on('click', function() {

    $.ajax({
        type: "post",
        url: DOMAIN + "/logout/",
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        dataType: "json"
    });

    setInterval(function() {
        window.location.href = DOMAIN;
    }, 100);

});




$.fn.exists = function() {
    return $(this).length;
};

$.fn.extend({
    toggleText:function(a, b){
        if(this.html() == a){
            this.html(b);
        } else{
            this.html(a);
        }
    }
});

$(document).ready(function() {

    selectFilesForUserGalleryBtnInit();

    niceSelectInit();

    noUiSliderInit();

    magnificPopupInit();

    userPersonalSettingsTabsTogglerInit();

    userProfileInformationActions();

    mobileChatInit();

    styleUloginAuthBlock();

    quickSearchOnMainPage();

    // Owl 1
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
        }
    });

    $('.slider-prev2').click(function() {
        owl2.trigger('prev.owl.carousel');
    });

    $('.slider-next2').click(function() {
        owl2.trigger('next.owl.carousel');
    });



    // Owl 2
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
        }
    });

    $('.slider-prev3').click(function() {
        owl3.trigger('prev.owl.carousel');
    });

    $('.slider-next3').click(function() {
        owl3.trigger('next.owl.carousel');
    });

    //


    var indexClick, indexClick2 = 0;

    $('.notification-click').click(function(event) {
        if (indexClick === 0) {
            $('.notification').show();
            $('.notification').addClass('active');
            indexClick = 1;
        } else {
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

    $('.acc-setting-link img').click(function() {
        if (indexClick2 === 0) {
            $('.acc-setting').show();
            $('.acc-setting').addClass('active');
            indexClick2 = 1;
        } else {
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
        $('.mobile-nav').slideToggle();
    });

    $('.mobile-nav .dropdown').click(function(e) {
        e.preventDefault();
        $(this).find('.dropdown-list').slideToggle();
    });

    $('.aside-dropdown').click(function(e) {
        e.preventDefault();
        $(this).find('.aside-dropdown-list').slideToggle();
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
            }
        ]
    });

    $('.men-slider').on('afterChange', function(event, slick, currentSlide, nextSlide) {
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


    function selectFilesForUserGalleryBtnInit() {

        $('#select-file-for-gallery-btn').on('click', function() {
            $('#input-file').click();
        });

    }

    function niceSelectInit() {
        $('.select').niceSelect();
    }

    function noUiSliderInit() {

        var heightSlider = document.getElementById('height-slider');

        var ageSlider = document.getElementById('age-slider');

        var weightSlider = document.getElementById('weight-slider');

        if(heightSlider) {
            noUiSlider.create(heightSlider, {
                start: [1.50, 2.10],
                connect: true,
                tooltips: true,
                step: 0.10,
                range: { 'min': 1.40, 'max': 2.60 }
            });
        }

        if(ageSlider) {
            noUiSlider.create(ageSlider, {
                start: [25, 45],
                connect: true,
                tooltips: true,
                step: 1,
                range: {'min': 18, 'max': 70},
                format: {
                    to: function ( value ) {
                        return value + '';
                    },
                    from: function ( value ) {
                        return value.replace(',-', '');
                    }
                }
            });
        }

        if(weightSlider) {
            noUiSlider.create(weightSlider, {
                start: [55, 93],
                connect: true,
                tooltips: true,
                step: 1,
                range: { 'min': 30, 'max': 120 },
                format: {
                    to: function ( value ) {
                        return value + '';
                    },
                    from: function ( value ) {
                        return value.replace(',-', '');
                    }
                }
            });
        }

    }

    function magnificPopupInit() {

        $('.popup-content').magnificPopup({
            type: 'inline',
            removalDelay: 300,
            mainClass: 'my-mfp-zoom-in'
        });

    }

    function userPersonalSettingsTabsTogglerInit() {

        $('a.popup-tabs-btn').click(function () {

            $('a.popup-tabs-btn').removeClass('active');

            $(this).addClass('active');

            var popupTabsButtonIndex = $(this).index('a.popup-tabs-btn');

            $('.popup-tab').hide();

            if(popupTabsButtonIndex === 7) {
                $("#user-personal-info-submit-box").hide();
            } else {
                $("#user-personal-info-submit-box").show();
            }

            $('.popup-tab:eq(' + popupTabsButtonIndex + ')').show();

        });
    }

    function mobileChatInit() {

        // var tabContainers = $('.popup-tab');
        // tabContainers.hide().filter(':first').show();
        //
        // $('.message-popup-peoples-single').click(function () {
        //     tabContainers.hide();
        //     tabContainers.filter(this.hash).show();
        //     $('.message-popup-peoples-single').removeClass('active');
        //     $(this).addClass('active');
        //     return false;
        // }).filter(':first').click();
        //
        // $('.message-popup-peoples-single').click(function () {
        //     $('.message-content').removeClass('active');
        //     $('.message-content').filter(this.hash).addClass('active');
        //     $('.message-popup-right').addClass('active');
        //     tabContainers.animate({scrollTop: $(document).height() + $(window).height()});
        // });
        //
        // $('.mobile-message-hide').click(function () {
        //     $('.message-popup-right').removeClass('active');
        // })

    }

    function userProfileInformationActions() {
        educationInputListeners();
        hobbyInputListeners();
        loveInputListeners();
    }

    function educationInputListeners() {

        var queryURL = DOMAIN +"/ajax/find/";

        var educationInput = $("#education");

        var educationList = $("#education-result-list");

        var hideList = function(event) {

            var eventClassName = event.target.className;

            if(eventClassName !== "education") {

                if(educationList.css("display") !== "none") {

                    educationList.hide();

                }

            }

        };

        educationInput.keyup(function () {

            $.ajax({
                type: "post",
                url: queryURL,
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: "json",
                data: {
                    category: "education",
                    word: educationInput.val()
                },
                success: function (data, status) {

                    console.log("S:", status);

                    if(data !== null && data.response.length) {

                        educationList.empty();

                        if(educationList.css("display") === "none") educationList.show();

                        for(var i = 0; i < data.response.length; i++) {

                            var liElement = "<li class='education'>" + data.response[i].education + "</li>";

                            educationList.append(liElement);
                        }

                    } else {
                        if(educationList.css("display") !== "none") educationList.hide();
                    }

                }
            });

        });

        educationInput.focus(function() {

            if(EDUCATION_FOCUS_INIT === false) {
                document.addEventListener('click', hideList);
                EDUCATION_FOCUS_INIT = true;
            }

        });

        $(educationList).on('click', 'li', function(event) {

            var liElementValue = event.target.innerText;

            educationInput.val(liElementValue);

            if(educationList.css("display") !== "none") educationList.hide();

        });

    }

    ///////TULYAKOV AS DONE START

    function hobbyInputListeners() {

        var queryURL = DOMAIN + "/ajax/find/";
        var hobbyInput = $("#hobby");
        var hobbyList = $("#hobby-result-list");
        var tagsList = $('#hobby-tags');
        var saverInput = document.createElement('input'); // here we will save hobbies, which were picked up byuser
        saverInput.setAttribute('name', 'input-saver');
        saverInput.style.display = 'none';
        tagsList.append(saverInput);
        var key = $("#add-hobby");

        function addTag() {
            if(hobbyInput.val() && (!saverInput.value.includes(',' + hobbyInput.val() + ','))) {
                var tag = '<p class="tag">' + hobbyInput.val() + '<a class="delete-el" href="#">X</a></p>';
                tagsList.append(tag);
                saverInput.value += (',' + hobbyInput.val() + ',');
                saverInput.setAttribute('value', saverInput.value);
                console.log(saverInput.value, saverInput);
            }
            hobbyInput.val('');
        }

        hobbyInput.keydown(function (event) {
            if(event.which === 13) {
                addTag();
                event.preventDefault();
            }
        });

        $(key).on('click', function (event) {
            addTag();
        });

        $(tagsList).on('click', '.delete-el', function(event) {

            var vm = event.target.parentElement;
            event.target.remove();
            var tag = vm.textContent;
            vm.remove();
            var regx = new RegExp(','+tag, 'g');
            console.log("regx: ", regx);
            saverInput.value = saverInput.value.replace(regx, '');
            saverInput.setAttribute('value', saverInput.value);

        })

    }

    function loveInputListeners() {

        var queryURL = DOMAIN + "/ajax/find/";
        var loveInput = $("#love_too");
        var loveList = $("#love_too-result-list");
        var tagsList = $('#love_too-tags');
        var saverInput = document.createElement('input'); // here we will save love_toos, which were picked up byuser
        saverInput.setAttribute('name', 'input-saver-love');
        saverInput.style.display = 'none';
        tagsList.append(saverInput);
        var key = $("#add-love");

        function addTag() {
            if(loveInput.val() && (!saverInput.value.includes(',' + loveInput.val() + ','))) {
                var tag = '<p class="tag">' + loveInput.val() + '<a class="delete-el" href="#">X</a></p>';
                tagsList.append(tag);
                saverInput.value += (',' + loveInput.val() + ',');
                saverInput.setAttribute('value', saverInput.value);
                console.log(saverInput.value, saverInput);
            }
            loveInput.val('');
        }

        loveInput.keydown(function (event) {
            if(event.which === 13) {
                addTag();
                event.preventDefault();
            }
        });

        $(key).on('click', function (event) {
            addTag();
        });

        $(tagsList).on('click', '.delete-el', function(event) {
            var vm = event.target.parentElement;
            event.target.remove();
            var tag = vm.textContent;
            vm.remove();
            var regx = new RegExp(','+tag, 'g');
            console.log("regx: ", regx);
            saverInput.value = saverInput.value.replace(regx, '');
            saverInput.setAttribute('value', saverInput.value);

        })

    }

    function styleUloginAuthBlock() {

        $("div.ulogin-buttons-container").css("display", "block");
        $("div.ulogin-buttons-container").css("width", "100%");
        $("div.ulogin-buttons-container").css("max-width", "none");
        $("div.ulogin-buttons-container").css("margin", "13px auto 0");

        $("div.ulogin-buttons-container > div").css("float", "none");
        $("div.ulogin-buttons-container > div").css("display", "inline-block");
        $("div.ulogin-buttons-container > div").css("vertical-align", "top");
        $("div.ulogin-buttons-container > div").css("margin", "0 10px");
        $("div.ulogin-buttons-container > div").css("border-radius", "5px");

        $("div.ulogin-buttons-container > img.ulogin-dropdown-button").css("display", "none");

    }


    function quickSearchOnMainPage() {

        var initOwlSliderForSearch = function() {

            INIT_OWL_SLIDER_FOR_QUICK_SEARCH = $('#quick-search-result');

            INIT_OWL_SLIDER_FOR_QUICK_SEARCH.owlCarousel({
                items: 1,
                loop: false,
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
                }
            });

        };

        function addOwlSliderElements(searchObject, sliderData) {

            var dataArray = sliderData.split('^--^');

            dataArray.splice(dataArray.length - 1, 1);

            var slideHTML = "";

            for(var i = 0; i < dataArray.length; i++) {

                if(i === 0 || i % 2 === 0) slideHTML += "<div class='item'>";

                slideHTML += dataArray[i];

                if(i % 2 !== 0) slideHTML += "</div>";

            }

            INIT_OWL_SLIDER_FOR_QUICK_SEARCH.trigger('replace.owl.carousel', slideHTML);

        }

        var searchFormHandler = function() {

            $("#quick-search-form").on('submit', function(event) {
                event.preventDefault();

                var quickSearchResult = $('#quick-search-result');

                $.ajax({
                    type: "post",
                    url: DOMAIN + "/ajax/qfind/",
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        name: $("input[name='girl_name']").val(),
                        status: $("select[name='marital_status']").val(),
                        children: $("select[name='children_exist']").val()
                    },
                    success: function (data, status) {

                        if(status === 'success') {

                            if(data === "not found") {

                                var notFoundHTML = "<div class='not-found'>"
                                    + "<div class='box'>"
                                    + "<div class='image'><i class='fa fa-exclamation-triangle' aria-hidden='true'></i></div>"
                                    + "<div class='text'>"
                                    + "<p>Sorry, but search doesn't find any girl.</p>"
                                    + "<p>Try to select another search parameter and search again.</p>"
                                    + "</div>"
                                    + "</div>"
                                    + "</div>";

                                quickSearchResult.append(notFoundHTML);

                            } else {

                                addOwlSliderElements(quickSearchResult, data);

                            }

                        }

                    }
                });

            });

        };

        initOwlSliderForSearch();

        searchFormHandler();

    }

    $(".delete-gallery-image").click(function () {
        var delPhoto = this.getAttribute("data-delete-id");

        $.ajax({
            type: "post",
            url: '/delete_gallery/' + delPhoto,
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            contentType: false,
            processData: false,
            success: function (data) {

                console.log(data);

            }

        });
    });
});