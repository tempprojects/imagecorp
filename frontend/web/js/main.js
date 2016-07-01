$(function () {

	
	jQuery.fn.existing = function () {
		return $(this).length;
	};
	if ($('.face').existing()) {
		$('.image-editor').cropit({
			imageState: {
				src: 'http://imagec1s.bget.ru/new/img/sample1.png'
			}, 
			onImageLoaded() {
				//$('.primary').addClass("ready").removeClass("is-disabled");
				$(function () {
					$('.primary').addClass("is-disabled").removeClass("ready");
					$("input[type=radio]").change(function () {
						var $inputs4 = $(this);
						if ($inputs4.is(':checked')) {
							var inputid = $(this).attr('id');
							switch (inputid) {
							case 'r1':
								$('.faces').html("<img src='http://imagec1s.bget.ru/new/img/big_ov.png'>");
								break;
							case 'r2':
								$('.faces').html("<img src='http://imagec1s.bget.ru/new/img/big_pr.png'>");
								break;
							case 'r3':
								$('.faces').html("<img src='http://imagec1s.bget.ru/new/img/big_kr.png'>");
								break;
							case 'r4':
								$('.faces').html("<img src='http://imagec1s.bget.ru/new/img/big_rm.png'>");
								break;
							case 'r5':
								$('.faces').html("<img src='http://imagec1s.bget.ru/new/img/big_kv.png'>");
								break;
							case 'r6':
								$('.faces').html("<img src='http://imagec1s.bget.ru/new/img/big_cr.png'>");
								break;
							default:
								$('.faces').html("<img src='http://imagec1s.bget.ru/new/img/big_pr.png'>");
							}
							$('.primary').addClass("ready").removeClass("is-disabled");
						} else {
							$('.primary').addClass("is-disabled").removeClass("ready");
						}
					}).change();
				});
			}
		});
		var htmlfaces = "<div class='faces is-overlay'></div>";
		$('.cropit-preview .cropit-preview-image-container').after(htmlfaces);


	} else {
		$('.image-editor').cropit({
			imageState: {
				src: 'http://imagec1s.bget.ru/new/img/sample.png'
			},
			onImageLoaded() {
				$('.primary').addClass("ready").removeClass("is-disabled");
				if ($('.coloring').existing()) {
					$(function () {
						$('.primary').addClass("is-disabled").removeClass("ready");
						$("input[type=checkbox]").change(function () {
							var $inputs3 = $(this);
							if ($inputs3.is(':checked')) {
								$('.primary').addClass("ready").removeClass("is-disabled");
							} else {
								$('.primary').addClass("is-disabled").removeClass("ready");
							}
						}).change();
					})
				};
			}
		});
	}
	$('.cam').click(function () {
		$('.cropit-image-input').click();
	});
});
$('input[type=range]').on('input', function (e) {
	var min = e.target.min,
		max = e.target.max,
		val = e.target.value;
	$(e.target).css({
		'backgroundSize': (val - min) * 100 / (max - min) + '% 100%'
	});
}).trigger('input');
$(document).ready(function () {
	$linkurl = $('.primary').attr('href');
	$('.primary').addClass("is-disabled").removeClass("ready");
	if ($('input[type=checkbox]').existing()) {
		$(function () {
			$("input[type=checkbox]").change(function () {
				var $input = $(this);
				if ($input.is(':checked')) {
					$('.primary').addClass("ready").removeClass("is-disabled");
				} else {
					$('.primary').addClass("is-disabled").removeClass("ready");
				}
			}).change();
		});
	};
	if ($('input[type=radio]').existing()) {
		$(function () {
			$("input[type=radio]").change(function () {
				var $input1 = $(this);
				if ($input1.is(':checked')) {
					$('.primary').addClass("ready").removeClass("is-disabled");
				} else {
					$('.primary').addClass("is-disabled").removeClass("ready");
				}
			}).change();
		});
	};
	if ($('.skin').existing()) {
		$(function () {
			$("input[type=radio]").change(function () {
				var $inputs1 = $('.skin input[type=radio]');
				var $inputs2 = $('.skins input[type=radio]');
				if ($inputs1.is(':checked') && $inputs2.is(':checked')) {
					$('.primary').addClass("ready").removeClass("is-disabled");
				} else {
					$('.primary').addClass("is-disabled").removeClass("ready");
				}
			}).change();
		});
	}
	if ($('.coloring').existing()) {
		$(function () {
			var htmlcolors = "<div class='color-box'><div class='col1_1'></div><div class='col1_2'></div><div class='col1_3'></div><div class='col1_4'> </div> <div class='col1_5'></div> <div class='col1_6'></div><div class='col1_7'></div><div class='col1_8'></div></div>";
			$('.cropit-preview .cropit-preview-image-container').after(htmlcolors);
			$('.color-box > div').each(function (indx) {
				var idname = $(this).css('background-color');
				var idnow = $('.color-box > div.col1_4').css('background-color');
				$('.color-box > div.col1_4').css('width', '40px');
				$('.cropit-preview').css('border-color', idnow);
				$(this).click(function () {
					$('.color-box > div').css('width', '20px');
					$(this).css('width', '40px');
					$('.cropit-preview').css('border-color', idname);
				});
			});
		});
	}
	if ($('.hair').existing()) {
		$(function () {
			$('.hair1-1, .hair2-1, .hair3-1, .hair4-1, .hair5-1, .hair6-1, .hair7-1, .hair8-1, .hair9-1').hide();
			$("#r1, #r2, #r3, #r4, #r5, #r6, #r7, #r8, #r9").change(function () {
				var $input = $(this);
				if ($input.is(':checked')) {
					$('.primary').addClass("is-disabled").removeClass("ready");
				}
				if ($('#r10, #r11, #r12, #r13, #r14, #r15, #r16, #r17, #r18').is(':checked')) {
					$('.primary').addClass("ready").removeClass("is-disabled");
				}
				if ($('#r1').is(':checked')) {
					$('#h1').css('opacity', ' 1');
					$('#hair1-1').fadeIn();
					$('#hair2-1, #hair3-1, #hair4-1, #hair5-1, #hair6-1, #hair7-1, #hair8-1, #hair9-1').hide();
					$('#h2, #h3, #h4, #h5, #h6, #h7, #h8, #h9').css('opacity', ' .5');
				}
				if ($('#r2').is(':checked')) {
					$('#h2').css('opacity', ' 1');
					$('#hair1-1, #hair3-1, #hair4-1, #hair5-1, #hair6-1, #hair7-1, #hair8-1, #hair9-1').hide();
					$('#hair2-1').fadeIn();
					$('#h1, #h3, #h4, #h5, #h6, #h7, #h8, #h9').css('opacity', ' .5');
				}
				if ($('#r3').is(':checked')) {
					$('#h3').css('opacity', ' 1');
					$('#hair1-1, #hair2-1, #hair4-1, #hair5-1, #hair6-1, #hair7-1, #hair8-1, #hair9-1').hide();
					$('#hair3-1').fadeIn();
					$('#h1, #h2, #h4, #h5, #h6, #h7, #h8, #h9').css('opacity', ' .5');
				}
				if ($('#r4').is(':checked')) {
					$('#h4').css('opacity', ' 1');
					$('#hair1-1, #hair2-1, #hair3-1, #hair5-1, #hair6-1, #hair7-1, #hair8-1, #hair9-1').hide();
					$('#hair4-1').fadeIn();
					$('#h1, #h2, #h3, #h5, #h6, #h7, #h8, #h9').css('opacity', ' .5');
				}
				if ($('#r5').is(':checked')) {
					$('#h5').css('opacity', ' 1');
					$('#hair1-1, #hair2-1, #hair3-1, #hair4-1, #hair6-1, #hair7-1, #hair8-1, #hair9-1').hide();
					$('#hair5-1').fadeIn();
					$('#h1, #h2, #h3, #h4, #h6, #h7, #h8, #h9').css('opacity', ' .5');
				}
				if ($('#r6').is(':checked')) {
					$('#h6').css('opacity', ' 1');
					$('#hair1-1, #hair2-1, #hair3-1, #hair4-1, #hair5-1, #hair7-1, #hair8-1, #hair9-1').hide();
					$('#hair6-1').fadeIn();
					$('#h1, #h2, #h3, #h4, #h5, #h7, #h8, #h9').css('opacity', ' .5');
				}
				if ($('#r7').is(':checked')) {
					$('#h7').css('opacity', ' 1');
					$('#hair1-1, #hair2-1, #hair3-1, #hair4-1, #hair5-1, #hair6-1, #hair8-1, #hair9-1').hide();
					$('#hair7-1').fadeIn();
					$('#h1, #h2, #h3, #h4, #h5, #h6, #h8, #h9').css('opacity', ' .5');
				}
				if ($('#r8').is(':checked')) {
					$('#h8').css('opacity', ' 1');
					$('#hair1-1, #hair2-1, #hair3-1, #hair4-1, #hair5-1, #hair6-1, #hair7-1, #hair9-1').hide();
					$('#hair8-1').fadeIn();
					$('#h1, #h2, #h3, #h4, #h5, #h6, #h7, #h9').css('opacity', ' .5');
				}
				if ($('#r9').is(':checked')) {
					$('#h9').css('opacity', ' 1');
					$('#hair1-1, #hair2-1, #hair3-1, #hair4-1, #hair5-1, #hair6-1, #hair7-1, #hair8-1').hide();
					$('#hair9-1').fadeIn();
					$('#h1, #h2, #h3, #h4, #h5, #h6, #h7, #h8').css('opacity', ' .5');
				}
			}).change();

		});
	}
	if ($('.eye').existing()) {
		$(function () {
			$('.eye1-1, .eye2-1, .eye3-1, .eye4-1, .eye5-1, .eye6-1').hide();
			$("#r1, #r2, #r3, #r4, #r5, #r6").change(function () {
				var $input1 = $(this);
				if ($input1.is(':checked')) {
					$('.primary').addClass("is-disabled").removeClass("ready");
				};
				if ($('#r7, #r8, #r9, #r10, #r11, #r12').is(':checked')) {
					$('.primary').addClass("ready").removeClass("is-disabled");
				};
				if ($('#r1').is(':checked')) {
					$('#e1').css('opacity', ' 1');
					$('#eye2-1, #eye3-1, #eye4-1, #eye5-1, #eye6-1').hide();
					$('#eye1-1').fadeIn();
					$('#e2, #e3, #e4, #e5, #e6').css('opacity', ' .5');
				};
				if ($('#r2').is(':checked')) {
					$('#e2').css('opacity', ' 1');
					$('#eye1-1, #eye3-1, #eye4-1, #eye5-1, #eye6-1').hide();
					$('#eye2-1').fadeIn();
					$('#e1, #e3, #e4, #e5, #e6').css('opacity', ' .5');
				};
				if ($('#r3').is(':checked')) {
					$('#e3').css('opacity', ' 1');
					$('#eye1-1, #eye2-1, #eye4-1, #eye5-1, #eye6-1').hide();
					$('#eye3-1').fadeIn();
					$('#e1, #e2, #e4, #e5, #e6').css('opacity', ' .5');
				};
				if ($('#r4').is(':checked')) {
					$('#e4').css('opacity', ' 1');
					$('#eye1-1, #eye2-1, #eye3-1, #eye5-1, #eye6-1').hide();
					$('#eye4-1').fadeIn();
					$('#e1, #e2, #e3, #e5, #e6').css('opacity', ' .5');
				};
				if ($('#r5').is(':checked')) {
					$('#e5').css('opacity', ' 1');
					$('#eye1-1, #eye2-1, #eye3-1, #eye4-1, #eye6-1').hide();
					$('#eye5-1').fadeIn();
					$('#e1, #e2, #e3, #e4, #e6').css('opacity', ' .5');
				};
				if ($('#r6').is(':checked')) {
					$('#e6').css('opacity', ' 1');
					$('#eye1-1, #eye2-1, #eye3-1, #eye4-1, #eye5-1').hide();
					$('#eye6-1').fadeIn();
					$('#e1, #e2, #e3, #e4, #e5').css('opacity', ' .5');
				};
			}).change();

		});
	}
	if ($('.owl-carousel').existing()) {
		$("#owl-demo").owlCarousel({

			navigation: true, // Show next and prev buttons
			slideSpeed: 300,
			paginationSpeed: 400,
			singleItem: true,
			navigation: false
		});
		$("#owl-testim").owlCarousel({
			navigation: true,
			navigationText: [
      "<i class='fa fa-angle-left arrows2'></i>",
      "<i class='fa fa-angle-right arrows2'></i>"
      ],
			slideSpeed: 300,
			paginationSpeed: 400,
			singleItem: true,
			pagination: false
		});
		$("#owl-mail").owlCarousel({
			navigation: true,
			navigationText: [
      "<i class='fa fa-angle-left arrows1'></i>",
      "<i class='fa fa-angle-right arrows1'></i>"
      ],
			slideSpeed: 300,
			pagination: false,
			paginationSpeed: 400,
			singleItem: false,
			items: 3,
			itemsDesktop: [1199, 3],
			itemsDesktopSmall: [979, 3]
		});
	}

	if ($('.lower').existing()) {
		$("#owl-main").owlCarousel({
			navigation: true,
			navigationText: [
      "<i class='fa fa-angle-left arrows'></i>",
      "<i class='fa fa-angle-right arrows'></i>"
      ],
			slideSpeed: 300,
			paginationSpeed: 400,
			pagination: false,
			singleItem: true,
			transitionStyle: "fade"
		});
		var cntr = 1;
		$('.lower .owl-next').click(function () {
			while (cntr < 4) {
				cntr += 1;
				var clsname = $('.hero').attr('class');
				$('.hero').removeClass(clsname).addClass('hero').addClass('is-fullheight').addClass('bg-slider-' + cntr);
			}
		});
		$('.lower .owl-prev').click(function () {
			while (cntr > 0) {
				cntr -= 1;
				var clsname1 = $('.hero').attr('class');
				$('.hero').removeClass(clsname1).addClass('hero').addClass('is-fullheight').addClass('bg-slider-' + cntr);
			}
		});
	}

});


jQuery(function ($) {

	/*
	* show hidden menu (burgger button)
	*/

	var burger = $('.hidden-menu');

	burger.on('click', function () {
		console.log('good');
		$(this).find('.sub_menu').slideToggle();
	})

	/* *
	 * show register/login modal windows
	 * */

	var loginBtn = $('.enter-btn'),
		registerBtn = $('.register-btn'),
		recoverPassBtn = loginBtn.siblings('.login-modal').find('.recover-pass'),
		changeTelBtn = loginBtn.siblings('.login-modal').find('.change-tel');

	loginBtn.on('click', function () {

		console.log('good');

		$(this).siblings('.modals').hide();
		$(this).siblings('.login-modal').slideDown();

	});

	recoverPassBtn.on('click', function () {

		$(this).parents('.modals').hide();
		$(this).parents('.modals').siblings('.email-modal').slideDown();

	});

	changeTelBtn.on('click', function () {

		$(this).parents('.modals').hide();
		$(this).parents('.modals').siblings('.telephone-modal').slideDown();

	});

	registerBtn.on('click', function () {

		$(this).siblings('.modals').hide();
		$(this).siblings('.register-modal').slideDown();

	});

	$('.modals').on('mouseleave', function () {

		$(this).delay(3000).slideUp();

	});

});