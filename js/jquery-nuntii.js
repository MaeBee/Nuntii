$(document).ready(function() {
	$('.nuntiiclose').each(function (index) {
		$(this).click(function() { hidehint($(this)); });
	});
});

function hidehint(caller) {
	var treeUp = caller.parents();
	var widget;
	var siblings;
	var movement;
	
	widget = $(treeUp[2]);
	siblings = widget.nextAll();
	movement = widget.height();
	
	widget
		.animate({opacity: 0.0}, 600)
		.queue(function(){
			$.each(siblings, function(index, value) {
				$(value).animate({bottom: "+=" + movement}, 600)
			});
			$(this).dequeue();
		});
}