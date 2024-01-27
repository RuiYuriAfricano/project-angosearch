		$(document).ready(function(){
				$('#layerslider').layerSlider({
					skinsPath : 'layerslider/skins/',
					hoverPrevNext : true,
					skin : 'fullwidth',
					cbInit				: function(element){jQuery('.c-api').append(jQuery('<span>function cbInit() called</span><br>'));},
					cbStart				: function(data){jQuery('.c-api').append( jQuery('<span>function cbStart() called</span><br>'));},
					cbStop				: function(data){jQuery('.c-api').append( jQuery('<span>function cbStop() called</span><br>'));},
					cbPause				: function(data){jQuery('.c-api').append( jQuery('<span>function cbPause() called (pauseOnHover)</span><br>'));},
					cbAnimStart			: function(data){jQuery('.c-api').append( jQuery('<span>function cbAnimStart() called, current layer is: '+data.curLayerIndex+', next layer is: '+data.nextLayerIndex+'</span><br>'));},
					cbAnimStop			: function(data){jQuery('.c-api').append( jQuery('<span>function cbAnimStop() called</span><br>'));},
					cbPrev				: function(data){jQuery('.c-api').append( jQuery('<span>function cbPrev() called</span><br>'));},
					cbNext				: function(data){jQuery('.c-api').append( jQuery('<span>function cbNext() called</span><br>'));}
				});
				
			});