(function ($) {

	var
		closeBox = function ($wrap) {
			var
				effect_duration = 500;

			$wrap.removeClass('ecll-expanded');
			$wrap.find('.ecll-collapsed-icon, .ecll-collapse-text').hide();
			$wrap.find('.ecll-expanded-icon, .ecll-expand-text').show();

			$wrap.find('.ecll-hidden-links').slideUp(effect_duration, function () {
				$wrap.removeClass('ecll-animating');
			});
		},
		openBox = function ($wrap) {
			var
				effect_duration = 500;

			$wrap.addClass('ecll-expanded');
			$wrap.find('.ecll-collapsed-icon, .ecll-collapse-text').show();
			$wrap.find('.ecll-expanded-icon, .ecll-expand-text').hide();

			$wrap.find('.ecll-hidden-links').slideDown(effect_duration, function () {
				$wrap.removeClass('ecll-animating');
			});
		};

	$(document).ready(function () {

		/* toggle button */

		$(document.body).on('click', '.ecll-title-toggler, .ecll-expand-btn', function () {
			var $wrap = $(this).closest('.ecll-wrap');

			if ($wrap.hasClass('ecll-animating')) {
				return false;
			}
			$wrap.addClass('ecll-animating');

			if (!$wrap.hasClass('ecll-expanded')) {
				openBox($wrap);
			} else {
				closeBox($wrap);
			}

			return false;
		});
	}
	);
})(jQuery);
