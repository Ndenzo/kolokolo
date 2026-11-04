(function ($) {
	("use strict");

	// meanmenu
	$("#mobile-menu").meanmenu({
		meanMenuContainer: ".mobile-menu",
		meanScreenWidth: "992",
	});

	$(".side-info-close,.offcanvas-overlay").on("click", function () {
		$(".side-info").removeClass("info-open");
		$(".offcanvas-overlay").removeClass("overlay-open");
	});
	$(".side-toggle").on("click", function (e) {
		e.preventDefault();
		$(".side-info").addClass("info-open");
		$(".offcanvas-overlay").addClass("overlay-open");
	});

	// Search
	var $searchWrap = $(".search-wrap");
	var $navSearch = $(".nav-search");
	var $searchClose = $("#search-close");

	$(".search-trigger").on("click", function (e) {
		e.preventDefault();
		$searchWrap.animate({ opacity: "toggle" }, 500);
		$navSearch.add($searchClose).addClass("open");
	});

	$(".search-close").on("click", function (e) {
		e.preventDefault();
		$searchWrap.animate({ opacity: "toggle" }, 500);
		$navSearch.add($searchClose).removeClass("open");
	});

	function closeSearch() {
		$searchWrap.fadeOut(200);
		$navSearch.add($searchClose).removeClass("open");
	}

	$(document.body).on("click", function (e) {
		closeSearch();
	});

	$(".search-trigger, .main-search-input, .search-suggest").on("click", function (e) {
		e.stopPropagation();
	});

	$(window).on("scroll", function () {
		var scroll = $(window).scrollTop();
		if (scroll < 245) {
			$(".header-sticky").removeClass("sticky");
		} else {
			$(".header-sticky").addClass("sticky");
		}
	});
	/*------------------------------------
        Slider
	--------------------------------------*/
	if (jQuery(".slider-active").length > 0) {
		let sliderActive1 = ".slider-active";
		let sliderInit1 = new Swiper(sliderActive1, {
			// Optional parameters
			slidesPerView: 1,
			slidesPerColumn: 1,
			paginationClickable: true,
			loop: true,
			effect: "fade",

			autoplay: {
				delay: 5000,
			},

			// If we need pagination
			pagination: {
				el: ".slider-swiper-paginations",
				// dynamicBullets: true,
				clickable: true,
			},

			// Navigation arrows
			navigation: {
				nextEl: ".swiper-button-next",
				prevEl: ".swiper-button-prev",
			},

			a11y: false,
		});

		function animated_swiper(selector, init) {
			let animated = function animated() {
				$(selector + " [data-animation]").each(function () {
					let anim = $(this).data("animation");
					let delay = $(this).data("delay");
					let duration = $(this).data("duration");

					$(this)
						.removeClass("anim" + anim)
						.addClass(anim + " animated")
						.css({
							webkitAnimationDelay: delay,
							animationDelay: delay,
							webkitAnimationDuration: duration,
							animationDuration: duration,
						})
						.one(
							"webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend",
							function () {
								$(this).removeClass(anim + " animated");
							}
						);
				});
			};
			animated();
			// Make animated when slide change
			init.on("slideChange", function () {
				$(sliderActive1 + " [data-animation]").removeClass("animated");
			});
			init.on("slideChange", animated);
		}

		animated_swiper(sliderActive1, sliderInit1);
	}

	// brand activation
	if (jQuery(".brand-active").length > 0) {
		let brand = new Swiper(".brand-active", {
			slidesPerView: 1,
			spaceBetween: 30,
			// direction: 'vertical',
			loop: true,
			autoplay: {
				delay: 2000,
			},

			breakpoints: {
				500: {
					slidesPerView: 2,
				},
				768: {
					slidesPerView: 3,
				},
				992: {
					slidesPerView: 4,
				},
				1200: {
					slidesPerView: 5,
				},
			},
		});
	}

	// portfolio activation
	if (jQuery(".portfolio-active").length > 0) {
		const portfolioSlides = jQuery(".portfolio-active .swiper-slide").length;
		// Loop clones slides; with few items it invents many duplicates (e.g. 5 → ~17).
		const portfolioLoop = portfolioSlides > 6;
		let portfolio = new Swiper(".portfolio-active", {
			slidesPerView: 1,
			spaceBetween: 30,
			loop: portfolioLoop,
			autoplay: {
				delay: 5000,
				disableOnInteraction: false,
				stopOnLastSlide: !portfolioLoop,
			},
			// Responsive breakpoints
			breakpoints: {
				768: {
					slidesPerView: Math.min(2, portfolioSlides) || 1,
					spaceBetween: 30,
				},
				1400: {
					slidesPerView: Math.min(3, portfolioSlides) || 1,
					spaceBetween: 30,
				},
			},
			// If we need pagination
			pagination: {
				el: ".portfolio-swiper-pagination",
				clickable: true,
			},

			// Navigation arrows
			navigation: {
				nextEl: ".swiper-button-next",
				prevEl: ".swiper-button-prev",
			},

			// And if we need scrollbar
			scrollbar: {
				el: ".swiper-scrollbar",
			},
		});
	}

	// portfolio-slide activation
	if (jQuery(".portfolio-slide").length > 0) {
		let portfolio2 = new Swiper(".portfolio-slide", {
			slidesPerView: 1,
			spaceBetween: 30,
			// direction: 'vertical',
			loop: false,
			autoplay: {
				delay: 5000,
			},

			// If we need pagination
			pagination: {
				el: ".portfolio2-swiper-pagination",
				clickable: true,
			},

			// Navigation arrows
			navigation: {
				nextEl: ".swiper-button-next",
				prevEl: ".swiper-button-prev",
			},

			// And if we need scrollbar
			scrollbar: {
				el: ".swiper-scrollbar",
			},
			// Responsive breakpoints
			breakpoints: {
				778: {
					slidesPerView: 2,
					spaceBetween: 30,
				},
				992: {
					slidesPerView: 3,
					spaceBetween: 30,
				},
			},
		});
	}

	// testimonial activation
	if (jQuery(".testimonial-active").length > 0) {
		let testimonial = new Swiper(".testimonial-active", {
			slidesPerView: 1,
			spaceBetween: 0,
			// direction: 'vertical',
			loop: true,
			effect: "fade",
			fadeEffect: {
				crossFade: true,
			},
			autoplay: {
				delay: 5000,
			},
			// Navigation arrows
			navigation: {
				nextEl: ".testimonial1-button-next",
				prevEl: ".testimonial1-button-prev",
			},
		});
	}

	// portfolio activation
	if (jQuery(".testimonial-active-2").length > 0) {
		let testimonial2 = new Swiper(".testimonial-active-2", {
			slidesPerView: 1,
			spaceBetween: 200,
			loop: true,
			autoplay: {
				delay: 5000,
			},
			navigation: {
				nextEl: ".testimonial2-btn-next",
				prevEl: ".testimonial2-btn-prev",
			},
			on: {
				init: function () {
					syncTestimonialPhoto(this);
				},
				slideChange: function () {
					syncTestimonialPhoto(this);
				},
			},
		});
		function syncTestimonialPhoto(swiper) {
			const slide = swiper.slides[swiper.activeIndex];
			const img = document.querySelector("[data-testimonial-client-photo]");
			if (!slide || !img) return;
			const photo = slide.getAttribute("data-photo");
			if (photo) img.src = photo;
			img.alt = slide.getAttribute("data-name") || "";
		}
	}
	// team 3 activation
	if (jQuery(".testimonial-active-3").length > 0) {
		let swipertestimonial = new Swiper(".testimonial-active-3", {
			slidesPerView: 1,
			spaceBetween: 30,
			// direction: 'vertical',
			loop: true,
			infinite: false,
			autoplay: {
				delay: 5000,
			},

			// Navigation arrows
			navigation: {
				nextEl: ".testimonial-btn-next",
				prevEl: ".testimonial-btn-prev",
			},

			breakpoints: {
				768: {
					slidesPerView: 2,
				},
			},
		});
	}

	// data background
	$("[data-background]").each(function () {
		$(this).css(
			"background-image",
			"url(" + $(this).attr("data-background") + ")"
		);
	});

	/* magnificPopup img view */
	$(".popup-image").magnificPopup({
		type: "image",
		gallery: {
			enabled: true,
		},
	});

	/* magnificPopup video view */
	$(".popup-video").magnificPopup({
		type: "iframe",
	});

	// init Isotope (uniquement si le plugin est chargé)
	if ($.fn.isotope && $(".grid").length) {
		var $grid = $(".grid").isotope({});
		$(".portfolio-button").on("click", "button", function () {
			var filterValue = $(this).attr("data-filter");
			$grid.isotope({ filter: filterValue });
		});
	}

	//for menu active class
	$(".portfolio-button button").on("click", function (event) {
		$(this).siblings(".active").removeClass("active");
		$(this).addClass("active");
		event.preventDefault();
	});

	// back to top
	$("#scrollToTop").on("click", function () {
		$("body, html").animate({ scrollTop: 0 }, 500);
		return false;
	});

	// scrollToTop
	$.scrollUp({
		scrollName: "scrollUp", // Element ID
		topDistance: "300", // Distance from top before showing element (px)
		topSpeed: 300, // Speed back to top (ms)
		animation: "fade", // Fade, slide, none
		animationInSpeed: 200, // Animation in speed (ms)
		animationOutSpeed: 200, // Animation out speed (ms)
		scrollText: '<i class="fal fa-arrow-up"></i>', // Text for element
		activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
	});

	// WOW active
	new WOW().init();

	// Active Odometer Counter (uniquement si le plugin est chargé)
	if (jQuery.fn.appear) jQuery(".odometer").appear(function (e) {
		var odo = jQuery(".odometer");
		odo.each(function () {
			var countNumber = jQuery(this).attr("data-count");
			jQuery(this).html(countNumber);
		});
	});
})(jQuery);