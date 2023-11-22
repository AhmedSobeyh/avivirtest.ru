$(function(){
	
	let gallery = $(".gallery_default .gallery");
	
	gallery
		.on('jcarousel:create jcarousel:reload', function() {
			//var element = $(this),
			//	width = element.innerWidth();
			
			/*
			if( $(window).width() <= 812 && $(window).width() >= 376 )
				widthItem = (width / 2) + 10;
			else if( $(window).width() <= 375 )
				widthItem = width;
			else
				widthItem = (width / 4) + 3;
			
			element.jcarousel('items').css('width', widthItem + 'px');
			*/
		})
		.jcarousel({wrap:'circular'})
		.jcarouselSwipe();
	
	var fullyvisible = gallery.jcarousel('fullyvisible');
	var fullyvisible_Size = fullyvisible.length;
	var list = gallery.jcarousel('items');
	
	// Если количество видимых элементов равно количеству всех элементов,
	// то скроем кнопки навигации
	if( fullyvisible == list.length )
		$('.gallery_default .nav_but').hide();
	
	$(window).resize(function(){
		gallery.on('jcarousel:reload');
	});
	
	$(".gallery_default .nav_but .prev").jcarouselControl({
		target: "-=1"
	});
	
	$(".gallery_default .nav_but .next").jcarouselControl({
		target: "+=1"
	});
});