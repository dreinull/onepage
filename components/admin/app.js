$( document ).ready(function() {
	$('#fullscreen-editing').click(function(e) {
        e.preventDefault();
        $('#section-editing').toggleClass('col-sm-3 col-sm-12');
    });

    $('.field-input').change(function() {
        $(this).data('changed', 'true');
    });

    
    $('.date-input').datepicker({
        dateFormat: "dd.mm.yy"
    });

    $('#save-sections').click(function(e) {
        e.preventDefault();
        $('.section-list').find('.field-input').each(function() {
            if($(this).data('changed') == 'true') {
                var changes = {
                    type: $(this).data('type'),
                    section: $(this).closest('.section-body').data('id'),
                    field: $(this).data('field'),
                    value: $(this).val()
                }
                //alert(adminUrl + '/post');
                $.post(adminUrl + '/api/field/update', changes)
                    .done(function(data) {
                        console.log(data);
                    });
                $(this).data('changed', 'false');
            }
        });
            
    });
});