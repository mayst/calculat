$(document).ready(function() {

    var MAX_FILES_QUANTITY = 6;

    var ALLOW_IMAGE_TYPES = ['image/png', 'image/jpeg', 'image/gif'];

    var IMAGE_DATA_ARRAY = [];

    /* GOOD START */

    // drag and drop images
    $('#drop-files').on('drop', function(event) {

        var imageArray = event.dataTransfer.files;

        handleImageArray(imageArray);

    });

    // click and select images
    $('#input-file').on('change', function() {

        var imageArray = $(this)[0].files;

        handleImageArray(imageArray);

    });


    function handleImageArray(imageArray) {

        if (imageArray.length <= MAX_FILES_QUANTITY) {

            var imagesTypeValidation = checkImagesTypeValidation(imageArray);

            if(imagesTypeValidation) {
                manipulationWithUploadBlock('hide');
                loadImageArrayForPreview(imageArray);
            } else {
                alert('Sorry, upload only images in format: png, jpg, gif.');
            }

        } else {
            alert("Sorry, you can't upload more than + MAX_FILES_QUANTITY + ' images per one time.");
        }

    }


    function checkImagesTypeValidation(imageArray) {

        var validImageQuantity = 0;

        for(var i = 0; i < imageArray.length; i++) {

            for(var j = 0; j < ALLOW_IMAGE_TYPES.length; j++) {

                if(imageArray[i].type === ALLOW_IMAGE_TYPES[j]) {
                    validImageQuantity++;
                }

            }

        }

        return imageArray.length === validImageQuantity;
    }


    function loadImageArrayForPreview(imageArray) {

        $('.uploaded-holder').show(); // show preview block with images

        $('.upload-button').css({'display':'block'}); // show after uploading buttons box

        var imageIndex = 0;

        var uploadedImageQuantity = imageArray.length;

        $.each(imageArray, function(index, file) {

            var fileReader = new FileReader();

            fileReader.readAsDataURL(file);

            fileReader.onload = (function(event) {

                IMAGE_DATA_ARRAY[imageIndex] = event.target.result;

                imageIndex++;

                if(imageIndex === uploadedImageQuantity) {
                    addImageArrayOnPage(IMAGE_DATA_ARRAY);
                }

            });

        });

    }


    function addImageArrayOnPage(imageArray) {

        var imageArraySize = imageArray.length;

        if(imageArraySize === 0) {

            $('.upload-button').hide();

            $('.uploaded-holder').hide();

        } else if (imageArraySize === 1) {

            $('.upload-button .quantity-of-file').html("1 file was selected");

        } else {

            $('.upload-button .quantity-of-file').html(imageArraySize + " files were selected");

        }

        var imageHTML = null;

        for (var i = 0; i < imageArraySize; i++) {

            imageHTML = "<div id='img-" + i + "' class='image' style='background-image: url(" + imageArray[i] + ")'>";

            imageHTML += "<button type='button' id='preview-image-button__" + i + "'>Remove image</button>";

            imageHTML += '</div>';

            $('.uploaded-images-box').append(imageHTML);

            imageHTML = "";

        }

    }


    // remove only selected image in 'images preview' box
    $(".dropped-files .uploaded-images-box").on("click", "button", function() {

        var buttonID = $(this).attr('id');

        var temporaryArray = [];

        temporaryArray = buttonID.split('__');

        var previewImageIdForRemoving = temporaryArray[1];

        $('.uploaded-images-box > #img-' + previewImageIdForRemoving).remove();

        IMAGE_DATA_ARRAY[previewImageIdForRemoving] = "remove";

        var quantityOfExistImageInPreview = $('.uploaded-images-box > .image').length;

        if(quantityOfExistImageInPreview === 0) {

            $("#remove-all-image").click();

        }

    });


    // remove all images in 'images preview' box by click on 'Remove all' button
    $('#remove-all-image').on('click', function() {

        $('.uploaded-holder').hide(240);

        document.getElementById("frm").reset();

        $('.dropped-files > .uploaded-images-box > .image').remove();

        manipulationWithUploadBlock('show');

        IMAGE_DATA_ARRAY.length = 0;

    });

    /* GOOD FINISH */

    $(".result").on('click', '#add-new-image-btn', function() {

        console.log("add");

        $('.dropped-files > .uploaded-images-box > .image').remove();

        IMAGE_DATA_ARRAY.length = 0;

        $(".resul #add-new-image-btn").remove();

        $(".uploaded-holder").slideUp(300);

        $("#drop-files").slideDown(600);

    });


    // Загрузка изображений на сервер
    $('#upload-all-image-on-server').on('click', function() {

        $(".quantity-of-file").slideUp();

        $('.upload-button .result button').slideUp();

        var queryURL = DOMAIN + "/upload_gallery/";

        //$('.loading-content').html(IMAGE_DATA_ARRAY[0].name);
        //$('.loading-content').html('Download complete!');

        var form = new FormData($('#frm')[0]);

        $.ajax({
            type: "post",
            url: queryURL,
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            contentType: false,
            processData: false,
            data: form,
            beforeSend: function () {
                $(".loading").css("display", "block");
            },
            success: function (data, status) {

                if(status === 'success') {

                    console.log('success');

                    console.log("DATA: " + data);

                    setTimeout(function() {

                        $(".loading").slideUp(300);

                        $("p.quantity-of-file").html('Download complete!');

                        $("p.quantity-of-file").after('<button type="button" id="add-new-image-btn" class="add-new-images">add new images</button>');

                        $("p.quantity-of-file").slideDown(300);

                        }, 2000);

                    document.getElementById("frm").reset();

                }

            }

        });

    });

    $('#drop-files').on('dragenter', function() {
        $(this).css({'box-shadow' : 'inset 0px 0px 20px rgba(0, 0, 0, 0.1)', 'border' : '4px dashed #bb2b2b'});
        return false;
    });

    $('#drop-files').on('drop', function() {
        $(this).css({'box-shadow' : 'none', 'border' : '4px dashed rgba(0,0,0,0.2)'});
        return false;
    });

    function manipulationWithUploadBlock(status) {

        var uploadImageBlock = $('#drop-files');

        if(status === 'hide') {
            uploadImageBlock.slideUp(600);
        } else if(status === 'show') {
            uploadImageBlock.slideDown(600);
        }

    }

});
