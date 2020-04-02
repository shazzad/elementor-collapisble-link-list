(function($){
	$(document).ready(function() {
		var
		closeBox = function($wrap) {
			var
			effect_duration = 500;

			$wrap.removeClass('ecll-open');
			$wrap.find('.close-icon, .ecll-shrink-text').hide();
			$wrap.find('.open-icon, .ecll-expand-text').show();

			$wrap.find('.ecll-hidden-downloads').slideUp(effect_duration, function(){
				$wrap.removeClass('ecll-animating');
			});
		},
		openBox = function($wrap) {
			var
			effect_duration = 500;

			$wrap.addClass('ecll-open');
			$wrap.find('.close-icon, .ecll-shrink-text').show();
			$wrap.find('.open-icon, .ecll-expand-text').hide();

			$wrap.find('.ecll-hidden-downloads').slideDown(effect_duration, function(){
				$wrap.removeClass('ecll-animating');
			});
		};

		/* toggle button */
		$(document.body).on('click', '.ecll-title, .ecll-expand-btn', function(){
			var $wrap = $(this).closest('.ecll-wrap');

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
