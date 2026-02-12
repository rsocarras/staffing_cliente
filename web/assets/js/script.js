/*
Author       : Dreams Technologies
Template Name: Dreams Timer - Time Tracking Boostrap 5 Admin Dashboard
*/

(function () {
    "use strict";

	const $wrapper = $('.main-wrapper');
	const $overlay = $('<div class="sidebar-overlay"></div>');
	$overlay.insertBefore('.main-wrapper');

	// Toggle Mobile Menu
	$(document).on('click', '#mobile_btn', function (e) {
		e.preventDefault();
		$wrapper.toggleClass('slide-nav');
		$overlay.toggleClass('opened');
		$('html').toggleClass('menu-opened');
	});

	// Close sidebar on close button click
	$(document).on('click', '.sidebar-close, .sidebar-overlay', function () {
		$wrapper.removeClass('slide-nav');
		$overlay.removeClass('opened');
		$('html').removeClass('menu-opened');
	});

	// Sidebar
	function initSidebarMenu() {
		const $menuLinks = $('.sidebar-menu a');

		$menuLinks.on('click', function (e) {
			const $link = $(this);
			const $submenu = $link.next('ul');

			if ($link.parent().hasClass('submenu')) {
				e.preventDefault();

				if (!$link.hasClass('subdrop')) {
					// Collapse all other open submenus
					$link.closest('ul').find('ul:visible').slideUp(250);
					$link.closest('ul').find('a.subdrop').removeClass('subdrop');

					// Expand current
					$submenu.stop(true, true).slideDown(350);
					$link.addClass('subdrop');
				} else {
					// Collapse current
					$link.removeClass('subdrop');
					$submenu.stop(true, true).slideUp(350);
				}
			}
		});

		// Ensure any active link's submenu is shown with animation-ready state
		$('.sidebar-menu ul li.submenu a.active').each(function () {
			const $submenu = $(this).closest('ul');
			const $parentLink = $submenu.prev('a');

			$parentLink.addClass('active subdrop');
			$submenu.css('display', 'block'); // force show without using .show()

			// Now mark it manually as ready for animation
			$submenu.height($submenu.height()); // set explicit height
			$submenu.css('height', 'auto');     // restore auto height
		});
	}

	// Initialize Sidebar
	initSidebarMenu();

	// Mouse Over
	$(document).on('mouseover', function(e) {
        e.stopPropagation();
        if ($('body').hasClass('mini-sidebar') && $('#toggle_btn').is(':visible')) {
            var targ = $(e.target).closest('.sidebar, .header-left').length;
            if (targ) {
               	$('body').addClass('expand-menu');
                $('.subdrop + ul').slideDown();
            } else {
               	$('body').removeClass('expand-menu');
                $('.subdrop + ul').slideUp();
            }
            return false;
        }
    });

	// Toggle Button
	$(document).on('click', '#toggle_btn, #toggle_btn2', function () {
		const $body = $('body');
		const $html = $('html');
		const isMini = $body.hasClass('mini-sidebar');
		const isFullWidth = $html.attr('data-layout') === 'full-width';
		const isHidden = $html.attr('data-layout') === 'hidden';
	
		if (isMini) {
			$body.removeClass('mini-sidebar');
			$(this).addClass('active');
			localStorage.setItem('screenModeNightTokenState', 'night');
			setTimeout(function () {
				$(".header-left").addClass("active");
			}, 100);
		} else {
			$body.addClass('mini-sidebar');
			$(this).removeClass('active');
			localStorage.removeItem('screenModeNightTokenState');
			setTimeout(function () {
				$(".header-left").removeClass("active");
			}, 100);
		}
	
		// If <html> has data-layout="full-width", apply full-width class to <body>
		if (isFullWidth) {
			$body.addClass('full-width').removeClass('mini-sidebar');
			$('.sidebar-overlay').addClass('opened');
			$(document).on('click', '.sidebar-close , .sidebar-overlay', function () {
				$('body').removeClass('full-width');
			});
			$(document).on('click', '#toggle_btn', function (e) {
				e.preventDefault();
				$wrapper.toggleClass('slide-nav');
				$overlay.toggleClass('opened');
				$('.sidebar-overlay').addClass('opened');
				$('html').toggleClass('menu-opened');
			});
		} else {
			$body.removeClass('full-width');
		}

		// If <html> has data-layout="hidden", apply hidden-layout class to <body>
		if (isHidden) {
			$body.toggleClass('hidden-layout');
			$body.removeClass('mini-sidebar');
			$(document).on('click', '.sidebar-close', function () {
				$('body').removeClass('full-width');
			});
		} 
	
		return false;
	});

	// Tooltip
	const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
	const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

	// Input Mask
	document.querySelectorAll('[data-toggle="input-mask"]').forEach(input => {
		const format = input.getAttribute('data-mask-format');
		const reverse = input.getAttribute('data-reverse') === 'true';

		if (format && typeof Inputmask !== 'undefined') {
			Inputmask({
				mask: format.replace(/0/g, '9'),
				reverse: reverse
			}).mask(input);
		}
	});

	// Form Validation
	document.querySelectorAll('.needs-validation').forEach(form => {
		form.addEventListener('submit', event => {
			if (!form.checkValidity()) {
				event.preventDefault();
				event.stopPropagation();
			}
			form.classList.add('was-validated');
		}, false);
	});

	// Choices
	function initChoices() {
		document.querySelectorAll('[data-choices]').forEach(item => {
			const config = {
				allowHTML: true
			};
			const attrs = item.attributes;

			if (attrs['data-choices-groups']) {
				config.placeholderValue = 'This is a placeholder set in the config';
			}
			if (attrs['data-choices-search-false']) {
				config.searchEnabled = false;
			}
			if (attrs['data-choices-search-true']) {
				config.searchEnabled = true;
			}
			if (attrs['data-choices-removeItem']) {
				config.removeItemButton = true;
			}
			if (attrs['data-choices-sorting-false']) {
				config.shouldSort = false;
			}
			if (attrs['data-choices-sorting-true']) {
				config.shouldSort = true;
			}
			if (attrs['data-choices-multiple-remove']) {
				config.removeItemButton = true;
			}
			if (attrs['data-choices-limit']) {
				config.maxItemCount = parseInt(attrs['data-choices-limit'].value);
			}
			if (attrs['data-choices-editItem-true']) {
				config.editItems = true;
			}
			if (attrs['data-choices-editItem-false']) {
				config.editItems = false;
			}
			if (attrs['data-choices-text-unique-true']) {
				config.duplicateItemsAllowed = false;
			}
			if (attrs['data-choices-text-disabled-true']) {
				config.addItems = false;
			}

			const instance = new Choices(item, config);

			if (attrs['data-choices-text-disabled-true']) {
				instance.disable();
			}
		});
	}

	// Call it when the DOM is ready
	document.addEventListener('DOMContentLoaded', initChoices);

	// Initialize Flatpickr on elements with data-provider="flatpickr"
	document.querySelectorAll('[data-provider="flatpickr"]').forEach(el => {
		const config = {
			disableMobile: true
		};
		if (el.hasAttribute('data-date-format')) {
			config.dateFormat = el.getAttribute('data-date-format');
		}
		if (el.hasAttribute('data-enable-time')) {
			config.enableTime = true;
			config.dateFormat = config.dateFormat ? `${config.dateFormat} H:i` : 'Y-m-d H:i';
		}
		if (el.hasAttribute('data-altFormat')) {
			config.altInput = true;
			config.altFormat = el.getAttribute('data-altFormat');
		}
		if (el.hasAttribute('data-minDate')) {
			config.minDate = el.getAttribute('data-minDate');
		}
		if (el.hasAttribute('data-maxDate')) {
			config.maxDate = el.getAttribute('data-maxDate');
		}
		if (el.hasAttribute('data-default-date')) {
			const defaultDate = el.getAttribute('data-default-date');
			// Check if it's a valid date string
			if (!["true", "false", "", null].includes(defaultDate) && !isNaN(Date.parse(defaultDate))) {
				config.defaultDate = defaultDate;
			}
		}
		if (el.hasAttribute('data-multiple-date')) {
			config.mode = 'multiple';
		}
		if (el.hasAttribute('data-range-date')) {
			config.mode = 'range';
		}
		if (el.hasAttribute('data-inline-date')) {
			config.inline = true;
			const inlineDate = el.getAttribute('data-inline-date');
			if (!["true", "false", "", null].includes(inlineDate) && !isNaN(Date.parse(inlineDate))) {
				config.defaultDate = inlineDate;
			}
		}
		if (el.hasAttribute('data-disable-date')) {
			config.disable = el.getAttribute('data-disable-date').split(',');
		}
		if (el.hasAttribute('data-week-number')) {
			config.weekNumbers = true;
		}
		flatpickr(el, config);
	});

	// Time Picker
	document.querySelectorAll('[data-provider="timepickr"]').forEach(item => {
		const attrs = item.attributes;
		const config = {
			enableTime: true,
			noCalendar: true,
			dateFormat: "H:i"
		};

		if (attrs["data-time-hrs"]) {
			config.time_24hr = true;
		}

		if (attrs["data-min-time"]) {
			config.minTime = attrs["data-min-time"].value;
		}

		if (attrs["data-max-time"]) {
			config.maxTime = attrs["data-max-time"].value;
		}

		if (attrs["data-default-time"]) {
			config.defaultDate = attrs["data-default-time"].value;
		}

		if (attrs["data-time-inline"]) {
			config.inline = true;
			config.defaultDate = attrs["data-time-inline"].value;
		}

		flatpickr(item, config);
	});


	// Select2
	 if ($('[data-toggle="select2"]').length > 0) {
		$('[data-toggle="select2"]').each(function () {
			const $el = $(this);
			const options = {};

			// Placeholder
			if ($el.attr('data-placeholder')) {
				options.placeholder = $el.attr('data-placeholder');
			}

			// Allow clear
			if ($el.attr('data-allow-clear') === 'true') {
				options.allowClear = true;
			}

			// Tags   (user can enter new values)
			if ($el.attr('data-tags') === 'true') {
				options.tags = true;
			}

			// Maximum selection
			if ($el.attr('data-max-selections')) {
				options.maximumSelectionLength = parseInt($el.attr('data-max-selections'));
			}

			// AJAX (for dynamic search)
			if ($el.attr('data-ajax--url')) {
				options.ajax = {
					url: $el.attr('data-ajax--url'),
					dataType: 'json',
					delay: 250,
					data: function (params) {
						return {
							q: params.term, // search term
							page: params.page || 1
						};
					},
					processResults: function (data, params) {
						params.page = params.page || 1;
						return {
							results: data.items || [],
							pagination: {
								more: data.more
							}
						};
					},
					cache: true
				};
			}

			// Init Select2 with options
			$el.select2(options);
		});
	}

	// Select 2
    if ($('.select').length > 0) {
        $('.select').select2({
            minimumResultsForSearch: -1,
            width: '100%'
        });
    }

	// Popover
	const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
	const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))

	// Toasts
	document.addEventListener('DOMContentLoaded', function () {
		const toastPlacement = document.getElementById('toastPlacement');
		const placementSelect = document.getElementById('selectToastPlacement');
		if (toastPlacement && placementSelect) {
			const originalClass = toastPlacement.className;
			placementSelect.addEventListener('change', function () {
			toastPlacement.className = `${originalClass} ${this.value}`.trim();
			});
		}
	});

	// Datatable
	if($('.datatable').length > 0) {
		$('.datatable').DataTable({
			"bFilter": true,
			"ordering": true,
			"language": {
				search: ' ',
				searchPlaceholder: "Search",
				sLengthMenu: 'Row Per Page _MENU_ Entries',
				info: "_START_ - _END_ of _TOTAL_ items",
				paginate: {
					next: '<i class="ti ti-arrow-right"></i>',
					previous: '<i class="ti ti-arrow-left"></i> '
				},
			 },
			"scrollX": false,         // Enable horizontal scrolling
			"scrollCollapse": false,  // Adjust table size when the scroll is used
			"responsive": false,
			"autoWidth": false,
		});
	}

	// Toggle Password
	if ($('.toggle-password').length > 0) {
		$(document).on('click', '.toggle-password', function () {
			const $icon = $(this).find('i');
			const $input = $(this).closest('.input-group').find('.pass-input');
			if ($input.attr('type') === 'password') {
				$input.attr('type', 'text');
				$icon.removeClass('ti-eye-off').addClass('ti-eye');
			} else {
				$input.attr('type', 'password');
				$icon.removeClass('ti-eye').addClass('ti-eye-off');
			}
		});
	}

	// Custom Country Code Selector
	if ($('.phone').length > 0) {
		document.querySelectorAll(".phone").forEach(function (input) {
		  window.intlTelInput(input, {
			utilsScript: "assets/plugins/intltelinput/js/utils.js",
		  });
		});
	}

	// Select Table Checkbox
	$('#select-all').on('change', function () {
		$('.form-check.form-check-md input[type="checkbox"]').prop('checked', this.checked);
	});

	// Aprrearence Settings
	$('.theme-image').on('click', function(){
		$('.theme-image').removeClass('active');
		$(this).addClass('active');
	});

	// Sticky Sidebar

	if ($(window).width() > 767) {
		if ($('.theiaStickySidebar').length > 0) {
			$('.theiaStickySidebar').theiaStickySidebar({
				// Settings
				additionalMarginTop: 30
			});
		}
	}

	// Date Range Picker
	if ($('.daterangepick').length > 0) {
		const start = moment().subtract(29, "days");
		const end = moment();
		const report_range = (start, end) => {
			$(".daterangepick span").html(`${start.format("D MMM YY")} - ${end.format("D MMM YY")}`);
		};
		$(".daterangepick").daterangepicker(
			{
				startDate: start,
				endDate: end,
				ranges: {
					'Today': [moment(), moment()],
					'Yesterday': [moment().subtract(1, "days"), moment().subtract(1, "days")],
					"Last 7 Days": [moment().subtract(6, "days"), moment()],
					"Last 30 Days": [moment().subtract(29, "days"), moment()],
					"This Month": [moment().startOf("month"), moment().endOf("month")],
					"Last Month": [
						moment().subtract(1, "month").startOf("month"),
						moment().subtract(1, "month").endOf("month")
					]
				}
			},
			report_range
		);
		report_range(start, end);
	}

	// Circle Progress
	$(function() {
		$(".circle-progress").each(function() {
			const value = $(this).attr('data-value');
			const left = $(this).find('.progress-left .progress-bar');
			const right = $(this).find('.progress-right .progress-bar');
			if (value > 0) {
				if (value <= 50) {
					right.css('transform', 'rotate(' + percentageToDegrees(value) + 'deg)')
				} else {
					right.css('transform', 'rotate(180deg)')
					left.css('transform', 'rotate(' + percentageToDegrees(value - 50) + 'deg)')
				}
			}
		})
		function percentageToDegrees(percentage) {
		  	return percentage / 100 * 360
		}
	});

	// Call
    if($('.call-users').length > 0) {
		var swiper = new Swiper(".call-users", {
		slidesPerView: 1,
		spaceBetween: 24,
		keyboard: {
			enabled: true,
		},
		pagination: {
			el: ".swiper-pagination",
			clickable: true,
		},
		navigation: {
			nextEl: ".swiper-button-next",
			prevEl: ".swiper-button-prev",
		},
		loop: true,
		breakpoints: {
			320: {
				slidesPerView: 1,
			},
			576: {
				slidesPerView: 2,
			},
			768: {
				slidesPerView: 3,
			},
			992: {
				slidesPerView: 3,
			},
			1300: {
				slidesPerView: 4,
			},
		}
		});
	}

	// Full Screen
    if (document.querySelector('.btnFullscreen')) {
		const toggleFullscreen = function () {
			if (!document.fullscreenElement) {
				document.documentElement.requestFullscreen();
			} else {
				if (document.exitFullscreen) {
					document.exitFullscreen();
				}
			}
		};
		document.querySelectorAll('.btnFullscreen').forEach(function(btn) {
			btn.addEventListener('click', toggleFullscreen);
		});
	}

	// Show/Hide Reason Box
	if ($('#reason-select').length > 0) {
		$('#reason-select').on('change', function () {
			$('#other-reason-box').toggle($(this).val() === 'others');
		});
	}

	// Settings
	$(document).ready(function () {
		// Open sidebar
		$('.settings-collapse-bar').on('click', function () {
		  $('#sidebar2').addClass('active');
		});

		// Close sidebar
		$('#settings-sidebar-close').on('click', function () {
		  $('#sidebar2').removeClass('active');
		});
	});

	// Card Drag
	if($('.kanban-drag-wrap').length > 0) {
        $(".kanban-drag-wrap").sortable({
            connectWith: ".kanban-drag-wrap",
            handle: ".kanban-card",
            placeholder: "drag-placeholder"
        });
    }

	// fancy box
	if($('.screenshot-item').length > 0) {
		$( '[data-fancybox="gallery"]' ).fancybox({
			infobar : false,
			buttons: [
				"close"
			],
			caption : function( instance, item ) {
				var caption = $(this).data('caption') || '';
		
				return `
					${caption.length ? caption + '<br />' : ''}
			<div class="screenshot-info-top bg-dark position-fixed top-0 start-0 p-2 w-100">
				<div class="d-flex align-items-center justify-content-center">				
					<a href="#" class="avatar avatar-sm me-2 flex-shrink-0 avatar-rounded">
						<img src="assets/img/users/user-04.jpg" class="img-fluid" alt="img">
					</a>
					<span class="text-white">Ashley Regan -  24 Jan 2025, 09:01:00 AM</span>							
				</div>
			 </div>
			<div class="screenshot-info-bottom text-center bg-dark position-fixed bottom-0 start-0 p-2 w-100">
				<div class="d-flex align-items-center mb-3 gap-3 justify-content-center flex-wrap">
					<div>
						<span class="text-white">Doccure Team</span>
						<i class="ti ti-point-filled text-primary mx-2"></i>
						<i class="ti ti-activity-heartbeat text-success me-2"></i>
						<span class="text-white">73% of 03 Min</span>
						<i class="ti ti-point-filled text-primary mx-2"></i>
						<span class="text-white">Doccure V1.0</span>
					</div>
					<div class="download-delete-icon ms-2">
						<a href="javascript:void(0);" class="btn p-0 avatar-xs btn-light text-dark rounded-pill"><i class="ti ti-download fs-13"></i></a>
						<a href="javascript:void(0);" class="btn p-0 avatar-xs btn-light text-dark rounded-pill"><i class="ti ti-trash fs-13"></i></a>
					</div>
				</div>
			   <div class="row justify-content-center">
					<div class="col-md-6">
						<div class="row row-gap-3">
							<div class="col-sm-6">
								<div>
									<div class="d-flex justify-content-between mb-1 text-white">
										<div>
											<i class="ti ti-keyboard me-1"></i>
											<span>Keystroke / Min</span>
										</div>
										<span>69</span>
									</div>									
									<div class="progress-stacked progress-xs w-100">
										<div class="progress-bar bg-success" role="progressbar" style="width: 60%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div>
									<div class="d-flex justify-content-between mb-1 text-white">
										<div>
											<i class="ti ti-mouse me-1"></i>
											<span>Mouse Moments / Min</span>
										</div>
										<span>169</span>
									</div>									
									<div class="progress-stacked progress-xs w-100">
										<div class="progress-bar bg-success" role="progressbar" style="width: 80%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
								</div>
							</div>				
						</div>
					</div>
			   </div>
			</div>`;
			}
		});
	}

})();
