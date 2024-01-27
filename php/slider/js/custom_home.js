		
		
		$(document).ready(function(){
			$('#menu').slicknav();
			
			// Search Box Code
				$(".search_box_icon").click(function(){
					$(".search_box_inner").show(1000);
					$(".search_box_inner").fadeToggle();
					$(".search_box_inner").fadeToggle("slow");
					$(".search_box_inner").fadeToggle(6000);
				})
		});