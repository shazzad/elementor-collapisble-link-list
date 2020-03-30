(function($){
	$(document).ready(function() {
		var
		closeOpenBoxes = function($exclude) {
			if ($('.coll-wrap.coll-open').not($exclude).length) {
				$('.coll-wrap.coll-open').not($exclude).each(function(i, el){
					closeBox($(el));
				});
			}
		},
		closeBox = function($wrap) {
			var
			effect_duration = 500;

			$wrap.removeClass('coll-open');
			$wrap.find('.open-icon').hide();
			$wrap.find('.close-icon').show();

			$wrap.find('.coll-download-links').slideDown(effect_duration, function(){
				$wrap.removeClass('coll-animating');
			});
		},
		openBox = function($wrap) {
			var
			effect_duration = 500;

			$wrap.addClass('coll-open');
			$wrap.find('.open-icon').show();
			$wrap.find('.close-icon').hide();

			$wrap.find('.coll-download-links').slideUp(effect_duration, function(){
				$wrap.removeClass('coll-animating');
			});
		};

		/* toggle button */
		$(document.body).on('click', '.coll-title-wrapper', function(){
			var $wrap = $(this).closest('.coll-wrap');

			closeOpenBoxes($wrap);

			if ($wrap.hasClass('coll-animating')) {
				return false;
			}
			$wrap.addClass('coll-animating');

			if (! $wrap.hasClass('coll-open')) {
				openBox($wrap);
			} else {
				closeBox($wrap);
			}

			return false;
		});
	});
})(jQuery);
