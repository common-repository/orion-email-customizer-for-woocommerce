// Simple example, see optional options for more configuration.

/** https://seballot.github.io/spectrum/ */
(function ($) {

    $(document).ready(function () {
        var settings ;
        if (typeof ecwo_template_settings !== 'undefined') {
            settings = JSON.parse(ecwo_template_settings);
        }else{
            settings.text_color = '#3c3c3c';
            settings.primary_color = '#96588a';
        }
        
        $('#ecwo-text-color-email').spectrum({

            color: settings.text_color,

            showInput: true,

            showAlpha: true,

            // showPalette: false,

            showButtons: false,

            preferredFormat: "hex3",

            move: function (color) {

                $(".ecwo-preview-email-container").css("--ecwo-color-text", '' + color + '');

            },

        });

        $('#ecwo-links-color-email').spectrum({

            color: settings.primary_color,

            showInput: true,

            showAlpha: true,

            // showPalette: false,

            showButtons: false,

            preferredFormat: "hex3",

            move: function (color) {

                $(".ecwo-preview-email-container").css("--ecwo-color-primary", '' + color + '');

            },

        });

    });

})(jQuery);