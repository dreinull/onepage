$( document ).ready(function() {
	$('#fullscreen-editing').click(function(e) {
        e.preventDefault();
        $('#section-editing').toggleClass('col-sm-3 col-sm-12');
    });
});