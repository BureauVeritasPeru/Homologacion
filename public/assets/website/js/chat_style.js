$(function(){
	$('.chat-window-title').click(function(){
		if($('.chat-window').hasClass('minimized')){
			$(".chat-window-content").show();
			$(".chat-window").removeClass('minimized');
		}else{
			$(".chat-window-content").hide();
			$(".chat-window").addClass('minimized');
		}
	});
});