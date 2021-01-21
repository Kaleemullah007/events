$(document).ready(function(){

    $("#profileForm").validate({
        ignore: [],  // ignore NOTHING
        rules: {
            'title': {
                required: true,
            },
            'first_name': {
                required: true,
                minlength: 3,
                maxlength: 100
            },
            'last_name': {
                required: true,
                minlength: 3,
                maxlength: 100
            },
            'country_id': {
                required: true
            },
            'user_name': {
                required: true,
                minlength: 3,
                maxlength: 100
            }
        },
        highlight: function(element) {
            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
        success: function(element) {
            $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
        },
        errorClass: 'help-block',
        errorPlacement: function (error, element) {
            if(element.hasClass('select2') && element.next('.select2-container').length) {
                error.insertAfter(element.next('.select2-container'));
            } else if (element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            }
            else if (element.prop('type') === 'radio' && element.parent('.radio-inline').length) {
                error.insertAfter(element.parent().parent());
            }
            else if (element.prop('type') === 'checkbox' || element.prop('type') === 'radio') {
                error.appendTo(element.parent().parent());
            }
            else {
                error.insertAfter(element);
            }
        },
        submitHandler: function(form) {
            form.submit();
        },
    });

    $('#btnSave').on('click', function (e) {
        $("#profileForm").valid();
        if($("#profileForm div.has-error").length){
            $("#profileForm div.has-error:first").focus();
        }else{
            $("#profileForm").submit();
        }
    });
});