$(function(){
	$(".meeting button").on("click", function(event){
		
		event.preventDefault();
		
		var parentDiv = $(this).parents(".form");
		var parentForm = $(this).parent();
		
		var errorArray = [];
		
		parentDiv.find('.sure').each(function(){
			var _this = $(this);
			
			if( _this.val() == "" )
			{
				errorArray.push("1");
				_this.addClass("error");
			}
			else
			{
				_this.removeClass("error");
			}
		});
		
		if( errorArray.length == 0 && parentForm.find('input[name="default"]').val() == "" )
		{
			var options = {
				target: parentDiv,
				type: 'post'
			};
	
			$(parentForm).ajaxForm(options);
			$(parentForm).submit();
		}
	});

});