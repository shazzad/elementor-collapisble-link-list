(function($){
	$(document).ready(function() {
		var
		closeOpenBoxes = function($exclude) {
			if ($('.ecll-wrap.ecll-open').not($exclude).length) {
				$('.ecll-wrap.ecll-open').not($exclude).each(function(i, el){
					closeBox($(el));
				});
			}
		},
		closeBox = function($wrap) {
			var
			effect_duration = 500;

			$wrap.removeClass('ecll-open');
			$wrap.find('.open-icon').hide();
			$wrap.find('.close-icon').show();

			$wrap.find('.ecll-download-links').slideDown(effect_duration, function(){
				$wrap.removeClass('ecll-animating');
			});
		},
		openBox = function($wrap) {
			var
			effect_duration = 500;

			$wrap.addClass('ecll-open');
			$wrap.find('.open-icon').show();
			$wrap.find('.close-icon').hide();

			$wrap.find('.ecll-download-links').slideUp(effect_duration, function(){
				$wrap.removeClass('ecll-animating');
			});
		};

		/* toggle button */
		$(document.body).on('click', '.ecll-title-wrapper', function(){
			var $wrap = $(this).closest('.ecll-wrap');

			closeOpenBoxes($wrap);

			if ($wrap.hasClass('ecll-animating')) {
				return false;
			}
			$wrap.addClass('ecll-animating');

			if (! $wrap.hasClass('ecll-open')) {
				openBox($wrap);
			} else {
				closeBox($wrap);
			}

			return false;
		});
	});
})(jQuery);
