$( document ).ready(function() {
	$('#fullscreen-editing').click(function(e) {
        e.preventDefault();
        $('#section-editing').toggleClass('col-sm-3 col-sm-12');
    });

    $('.field-input').change(function() {
        $(this).data('changed', 'true').addClass('changed');
    });

    
    $('.date-input').datepicker({
        dateFormat: "dd.mm.yy"
    });

    $('#save-sections').click(function(e) {
        e.preventDefault();
        $('.section-list').find('.field-input').each(function() {
            if($(this).data('changed') == 'true') {
                var field = $(this);
                var changes = {
                    type: field.data('type'),
                    section: field.closest('.section-body').data('id'),
                    field: field.data('field'),
                    value: field.val()
                }
                $.post(adminUrl + '/api/field/update', changes)
                    .done(function(data) {
                        field.data('changed', 'false').removeClass('changed');
                    });
            }
        });
        if(sectionOrdered == true) {
            data = $(".section-list").sortable("toArray");
            //console.log()
            $.post(adminUrl + '/api/section/order', {data:data})
                .done(function(data) {
                    console.log(data);
                });
        }
        $( '#page-preview' ).attr( 'src', function ( i, val ) { return val; });
            
    });

    $('.add-this-section').click(function(e) {
        e.preventDefault;
        $('#add-section-template').val($(this).data('template'));
        $('#add-section-page').val($(this).data('page'));

        $('#add-section-list').hide();      
        $('#add-section-form').show();      

    });

    $( ".section-list" ).sortable({
        create: function() {
            sectionOrdered = false;
        },
        change: function() {
            sectionOrdered = true;
        }
    });

});