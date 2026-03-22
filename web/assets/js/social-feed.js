/*
Author       : Dreams Technologies
Template Name: Dreams Timer - Time Tracking Boostrap 5 Admin Dashboard
*/

(function () {
    "use strict";

	// Stick Sidebar

	if ($(window).width() > 767) {
		if ($('.theiaStickySidebar').length > 0) {
			$('.theiaStickySidebar').theiaStickySidebar({
				// Settings
				additionalMarginTop: 30
			});
		}
	}

})();