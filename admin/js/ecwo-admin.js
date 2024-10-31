(function ($) {
    'use strict';

    $(document).ready(function () {

        function addGoogleFont(FontName) {
            $("head").append("<link href='https://fonts.googleapis.com/css?family=" + FontName + "' rel='stylesheet' type='text/css'>");
        }
        var fontFamily = $('#ecwo-font-family').val();
        addGoogleFont(fontFamily);

        select_default_template();
        //Function to select the template saved
        function select_default_template() {
            if (typeof ecwo_template !== 'undefined') {
                $('.ecwo-template-item[data-template=' + ecwo_template + ']').addClass("ecwo-template-active");
            } else {
                $('.ecwo-template-item').first().addClass("ecwo-template-active");
            }
        }

        //Function to trigger the change of a font color"
        $(document).on('change', '#ecwo-font-family', function () {
            var fontFamily = $('#ecwo-font-family').val();
            addGoogleFont(fontFamily);
            $(".ecwo-preview-email-container").css("--ecwo-font-family", '' + fontFamily + '');
        });

        //Function to trigger the change of a text color"
        var footer_content = $('.ecwo-footer-unsubscribe').html();
        $('#footer-text').html(footer_content);

        $(document).on('keyup', '#footer-text', function () {
            $('.ecwo-footer-unsubscribe').html($(this).val());
        });

        //hide or show facebook icon when page load
        var facebook_content = $('#facebook-link').val();
        show_hide_facebook_icon(facebook_content);

        //hide or show twitter icon when page load
        var twitter_content = $('#twitter-link').val();
        show_hide_twitter_icon(twitter_content);

        //hide or show LinkdIn icon when page load
        var linkdIn_content = $('#instagram-link').val();
        show_hide_linkdIn_icon(linkdIn_content);


        //function who show or hide icon
        function show_hide_facebook_icon(facebook_content) {
            if (facebook_content === "") {
                $('#facebook-icon').hide();
            } else {
                $('#facebook-icon').attr('href', facebook_content);
                $('#facebook-icon').show();
            }
        }

        function show_hide_twitter_icon(twitter_content) {
            if (twitter_content === "") {
                $('#twiter-icon').hide();
            } else {
                $('#twiter-icon').attr('href', twitter_content);
                $('#twiter-icon').show();
            }
        }

        function show_hide_linkdIn_icon(linkdIn_content) {
            if (linkdIn_content === "") {
                $('#instagram-icon').hide();
            } else {
                $('#instagram-icon').attr('href', linkdIn_content);
                $('#instagram-icon').show();
            }
        }

        $(document).on('keyup', '#facebook-link', function () {
            var facebook_content = $(this).val();
            show_hide_facebook_icon(facebook_content);
        });

        $(document).on('keyup', '#twitter-link', function () {
            var twitter_content = $(this).val();
            show_hide_twitter_icon(twitter_content);
        });

        $(document).on('keyup', '#instagram-link', function () {
            var instagram_content = $(this).val();
            show_hide_linkdIn_icon(instagram_content);
        });

        $(document).on('keypress keyup paste blur', '#ecwo-text-color-email', function () {

            var text_color = $('#ecwo-text-color-email').val();
            var reg = /^#([0-9a-f]{3}){1,2}$/i;

            if (reg.test(text_color)) {
                $(".ecwo-preview-email-container").css("--ecwo-color-text", '' + text_color + '');
            }
        });

        //Function to trigger the change of a text color"
        $(document).on('keypress keyup paste blur', '#ecwo-links-color-email', function () {

            var primary_color = $('#ecwo-links-color-email').val();

            var reg = /^#([0-9a-f]{3}){1,2}$/i;

            if (reg.test(primary_color)) {
                $(".ecwo-preview-email-container").css("--ecwo-color-primary", '' + primary_color + '');
            }
        });

        // Function to load style for the current preview
        function loadStyleForPreview(isAjax) {

            if (isAjax == "isAjax") {

                $("link[id='style-template']").remove();

            }

            var template = $('.ecwo-template-active').attr('data-template').split("-")[1];

            var pathStyle = path + 'includes/templates/styles/style-' + template + '.css';

            $('head').append('<link rel="stylesheet" id="style-template" type="text/css" href="' + pathStyle + '">');

        }

        //Function to trigger the change of the template"
        $(document).on('click', '.ecwo-template-item', function () {
            var template = $('.ecwo-template-active').attr('data-template');
            var settings = get_template_settings_data();
            loadStyleForPreview ("isAjax");

            var data_object = {
                action: "get_ecwo_template",
                template_name: template,
                settings: settings
            };
            $(".ecwo-loader").addClass("ecwo-show");
            $.ajax({
                type: 'POST',
                url: ajax_object.ajax_url,
                data: data_object,
                success: function (data) {
                    $('#ecwo-builder-inner-preview').html(data);
                    $( ".ecwo-loader" ).removeClass( "ecwo-show");
                }
            });
        });

        loadStyleForPreview ();
        
        function  get_template_settings_data() {
            var logo = $('.ecwo-icon-upload img').attr('src');
            var fontFamily = $('#ecwo-font-family').val();
            var text_color = $('#ecwo-text-color-email').val();
            var primary_color = $('#ecwo-links-color-email').val();
            var facebook_link = $('#facebook-link').val();
            var twitter_link = $('#twitter-link').val();
            var instagram_link = $('#instagram-link').val();
            var footer_text = $('#footer-text').val();

            var settings = {
                fontFamily: fontFamily,
                text_color: text_color,
                primary_color: primary_color,
                logo_url: logo,
                facebook_link: facebook_link,
                twitter_link: twitter_link,
                instagram_link: instagram_link,
                footer_text: footer_text

            };

            return settings;
        }

        //Function to trigger the save of the template"
        $(document).on('click', '#ecwo-btn-save-template-options', function () {
            var template = $('.ecwo-template-active').attr('data-template');
            var settings = get_template_settings_data();
            var data_object = {
                action: "save_ecwo_template",
                template_name: template,
                settings: settings,
            };
            $(".ecwo-loader").addClass("ecwo-show");
            $.ajax({
                type: 'POST',
                url: ajax_object.ajax_url,
                data: data_object,
                success: function (data) {
                    var contentResponse = '<div class="ecwo-alert ecwo-alert-success">' + data + '</div>'
                    $('#ecwo-debug').html(contentResponse);
                    setTimeout(function () {
                        $('#ecwo-debug').html("");
                    }, 3000);
                    $(".ecwo-loader").removeClass("ecwo-show");
                }
            });
        });

        //Function to trigger the reset of the templates settings"
        $(document).on('click', '.ecwo-btn-reset', function () {
            if (typeof default_ecwo_template_settings !== 'undefined') {
                $(".ecwo-loader").addClass("ecwo-show");
                let default_settings = JSON.parse(default_ecwo_template_settings)
                $('.ecwo-icon-upload').children('img').remove();
                $("#ecwo-font-family").val($("#ecwo-font-family option:first").val());
                $(".ecwo-preview-email-container").css("--ecwo-font-family", '' + default_settings.fontFamily + '');

                $('#ecwo-text-color-email').spectrum({

                    color: default_settings.text_color,
                    showInput: true,

                    showAlpha: true,

                    showButtons: false,

                    preferredFormat: "hex3",

                });
                $(".ecwo-preview-email-container").css("--ecwo-color-text", '' + default_settings.text_color + '');

                $('#ecwo-links-color-email').spectrum({

                    color: default_settings.primary_color,
                    showInput: true,

                    showAlpha: true,

                    showButtons: false,

                    preferredFormat: "hex3",

                });
                $(".ecwo-preview-email-container").css("--ecwo-color-primary", '' + default_settings.primary_color + '');
                $(".ecwo-loader").removeClass("ecwo-show");
                var contentResponse = '<div class="ecwo-alert ecwo-alert-success">Parameter restore successfully</div>'
                $('#ecwo-debug').html(contentResponse);
                setTimeout(function () {
                    $('#ecwo-debug').html("");
                }, 3000);
            }
        });

        // Function to trigger the add of a logo "Select Logo" Button
        $(document).on("click", ".ecwo-logo", function (e) {
            e.preventDefault();
            var uploader = wp.media({
                title: 'Please set the picture',
                button: {
                    text: "Select picture(s)"
                },
                multiple: false
            })
                    .on('select', function () {
                        var selection = uploader.state().get('selection');
                        selection.map(
                                function (attachment) {
                                    attachment = attachment.toJSON();
                                    $('#ecwo-logo').val(attachment.id);
                                    $('#ecwo-logo').attr('filename', attachment.filename);
                                    $('#ecwo-logo').attr('ecwo-url', attachment.url);
                                    $('.ecwo-icon-upload').html('<img src="' + attachment.url + '" style="height: 70px;">');
                                    $('.ecwo-navbar-logo-title').html('<img src="' + attachment.url + '" style="max-height: 60px;">');
                                }
                        );
                    })
                    .open();
        });

    });
})(jQuery);
