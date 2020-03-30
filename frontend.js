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
			$wrap.find('.close-icon').hide();
			$wrap.find('.open-icon').show();

			$wrap.find('.ecll-downloads').slideUp(effect_duration, function(){
				$wrap.removeClass('ecll-animating');
			});
		},
		openBox = function($wrap) {
			var
			effect_duration = 500;

			$wrap.addClass('ecll-open');
			$wrap.find('.close-icon').show();
			$wrap.find('.open-icon').hide();

			$wrap.find('.ecll-downloads').slideDown(effect_duration, function(){
				$wrap.removeClass('ecll-animating');
			});
		};

		/* toggle button */
		$(document.body).on('click', '.ecll-title', function(){
			var $wrap = $(this).parent('.ecll-wrap');

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
