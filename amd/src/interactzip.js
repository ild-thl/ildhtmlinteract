/* 
define(['jquery', 'core/ajax', 'core/notification'], function ($, ajax) {


$(document).ready( function() {
			
			$(window).on("resize", resizeZips)
			$(document).ready(resizeZips)

			var window_width
			var available_width
			var zip_width = new Array;
			var zip_height = new Array;
			var zip_ratio = new Array

			function resizeZips() {
				$(".interact-zip").each( //.interact-zip ist der iframe, glaube ich
						function() {
							window_width = $(window).width()
							available_width = $(this).parent().width()
							zip_width = parseInt($(this).prop("width"))
							zip_height = parseInt($(this).prop("height"))
							zip_ratio = available_width / zip_width;

							if (available_width < zip_width) { // klasse "viewport" wird vergeben, wenn die breite nicht ausreicht. der inhalt, also der iframe, wird dann skaliert.
								$(this).addClass("viewport").css({ 
									"transform" : "scale(" + zip_ratio + ")",
									"-ms-transform" : "scale(" + zip_ratio + ")",
									"-webkit-transform" : "scale(" + zip_ratio + ")"})
								$(this).parent().css( "height", zip_height * zip_ratio )
							} else {
								$(this).removeClass("viewport").css( { //wenn aber genug platz ist, soll die eigene breite beibehalten werden.
									"transform": "none",
									"-ms-transform": "none",
									"-webkit-transform": "none" } )
								$(this).parent().css( "height", "auto" )
							}
						})
			}
}) 

return {
	init: function() {
		console.log('hallo');
	}
	
} 

}); */