$(function(){
    /* Call Me */
    $(document).on('submit', '#js-call-me-body form', function( e ) {
        /* позвони мне */
        var $self = $(this),
            href = $self.attr('action');

        AJAXGlobals({
            url: href,
            data:  $self.serialize(),
            success: function (data) {
                if(data.result.isSend){
                    $('#js-call-me__name').val("");
                    $('#js-call-me__phone').val("");
                    $('#js-call-me__text').val("");
                    $('#js-call-me__iAgree').prop('checked', false);
                } else {
                    $('#call-me #call-me__body').html(data.result.html);
                }

            }
        });
        e.preventDefault();
    });
});