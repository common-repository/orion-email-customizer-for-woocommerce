(function( $ ) {
	'use strict';

	$(document).ready(function () {

        /*====================  Begin Spectrum Script ====================*/

        // Function to trigger the color picker

        $('#ecwo-text-color-email, #ecwo-links-color-email').spectrum({

            color: "#3e58e1",

            showInput: true,

            showAlpha: true,

            // showPalette: false,

            showButtons: false,

            preferredFormat: "hex3"

        });

        /*====================  End Spectrum Script ====================*/
	
		/*====================  Begin Button Script ====================*/

        // Function to trigger the active button either "Templates" or "Edit Template"

        $(".ecwo-template-item").click(function (e) {

            $(this).siblings(".ecwo-template-active").removeClass("ecwo-template-active");

            $(this).addClass("ecwo-template-active");

        });

        /*====================  End Button Script ====================*/

        /*====================  Begin Switch Setting Script ====================*/

        // Function to trigger the active section after clicking on either the "Templates" or "Edit Template" button

        $(".ecwo-main-action-item").click(function (e) {

            $(this).siblings(".ecwo-active").removeClass("ecwo-active");

            $(this).addClass("ecwo-active");

            var targetLi = $(this).attr("data-action");

            if (targetLi == "edit-template") {

                $(".ecwo-switch-content-templates").css("margin-left", "-25%");

                $(".ecwo-btns-container").addClass("ecwo-active");

//                $("#ecwo-btn-save-template").attr("id", "ecwo-btn-edit-template");
    
            } else {
            
                $(".ecwo-switch-content-templates").css("margin-left", "0");

                $(".ecwo-btns-container").removeClass("ecwo-active");

//                $("#ecwo-btn-edit-template").attr("id", "ecwo-btn-save-template");

            }

        });

        /*====================  End Switch Setting Script ====================*/



        /*====================  Begin Upload Script ====================*/

        // Function to trigger the explorer allowing him to choose his logo

        // $(".ecwo-logo").click(function (e) {

		// 	$("#ecwo-logo").click();

		// });

        // Function to cancel logo download

        $(".ecwo-cancel-upload").click(function (e) {

			$(".ecwo-upload-area").removeClass("ecwo-active");

		});

        /*====================  End Upload Script ====================*/

    });
})( jQuery );