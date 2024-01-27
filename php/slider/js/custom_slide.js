		jQuery(function(){
			jQuery('#products').slides({
				preload: true,
				preloadImage: 'assets/images/loading.gif',
				effect: 'slide, fade',
				crossfade: true,
				slideSpeed: 350,
				fadeSpeed: 500,
		
				generateNextPrev: true,
				generatePagination: false
			});
			
		});
			
		