if(countryId > 0){
    getStates(countryId, stateId);
}

if(stateId > 0){
    getCities(stateId, cityId);
}

function getStates(countryId, stateId = 0){

    if(countryId != ''){
        
        $('.cities').empty().append('<option selected="selected" value="">Select City</option>');
        $.ajax({
            /* the route pointing to the post function */
            url: '/events/states',
            type: 'POST',
            data: {country_id: countryId},
            dataType: 'JSON',
            /* remind that 'data' is the response of the AjaxController */
            success: function (data) { 
                
                if(data.status == 200){
                    //alert('href');
                    //console.log(data.options);
                    $('.states').empty().append(data.options);
                    if(stateId != 0){
                        $('.states').val(stateId);    
                    }
                }else{
                    $('.states').empty().append('<option selected="selected" value="">Select State</option>');
                }
            }
        }); 
    }else{
        $('.states').empty().append('<option selected="selected" value="">Select State</option>');
    }
}

function getCities(stateId, cityId = 0){
    if(stateId != ''){
        
        $.ajax({
            /* the route pointing to the post function */
            url: '/events/cities',
            type: 'POST',
            data: {state_id: stateId},
            dataType: 'JSON',
            /* remind that 'data' is the response of the AjaxController */
            success: function (data) { 
                
                if(data.status == 200){
                    $('.cities').empty().append(data.options);
                    if(cityId != 0){
                        $('.cities').val(cityId);    
                    }
                }else{
                    $('.cities').empty().append('<option selected="selected" value="">Select City</option>');
                }
            }
        }); 
    }else{
        $('.cities').empty().append('<option selected="selected" value="">Select City</option>');
    }
}

$(document).ready(function(){

    $("#eventForm").validate({
        ignore: [],  // ignore NOTHING
        rules: {
            'organization_name': {
                required: true,
                minlength: 3,
                maxlength: 100
            },
            'admin_email_address': {
                required: true,
                email: true,
                minlength: 3,
                maxlength: 100
            },
            'title': {
                required: true,
                minlength: 3,
                maxlength: 100
            },
            'category_ids[]': {
                required: true
            },
            'type_id': {
                required: true
            },
            'contact_person': {
                required: true,
                minlength: 3,
                maxlength: 100
            },
            'enquireis_email_address': {
                required: true,
                email: true,
                minlength: 3,
                maxlength: 100
            },
            'website_address': {
                required: true,
                url: true,
                minlength: 3,
                maxlength: 100
            },
            'start_date': {
                required: true
            },
            'end_date': {
                required: true
            },
            'abstract': {
                required: true,
                minlength: 3,
                maxlength: 100
            },
            'short_description': {
                required: true,
                minlength: 3,
                maxlength: 500
            },
            'keywords': {
                required: true,
                minlength: 3,
                maxlength: 500
            },
            'publisher_id': {
                required: true
            },
            'other': {
                required: function(element){
                    return $(".publishers").val() == "other";
                }
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
        $("#eventForm").valid();
        if($("#eventForm div.has-error").length){
            var ele = $("#eventForm div.has-error:first");
            ele.focus();
            var tabToShow = ele.closest('.tab-pane');
            $('.nav-tabs > li.nav-item > a[href="#' + tabToShow.attr('id') + '"]').trigger('click');
        }else{
            $("#eventForm").submit()
        }
    });

    $('.continue').click(function(){
        $('.nav-tabs > li.nav-item > a.active').parent().next('li').find('a').trigger('click');
        $("html, body").animate({ scrollTop: 0 }, "slow");
    });

    $('.back').click(function(){
        $('.nav-tabs > li.nav-item > a.active').parent().prev('li').find('a').trigger('click');
    });

    $('.countries').on('change', function(){
        getStates($(this).val());
    });

    $('.states').on('change', function(){

        getCities($(this).val());
    });

    $('.publishers').on('change', function(){

        if($(this).val() && $(this).val() == 'other'){
            $('.otherField').removeClass('hide');
        }else{
            $("input[name='other']").val('');
            $('.otherField').addClass('hide');
        }
    });

    // This example displays an address form, using the autocomplete feature
    // of the Google Places API to help users fill in the information.

    // This example requires the Places library. Include the libraries=places
    // parameter when you first load the API. For example:
    // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

    var placeSearch, autocomplete;
    var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name'
    };

    function initAutocomplete() {
        // Create the autocomplete object, restricting the search to geographical
        // location types.
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
            {types: ['geocode']});

        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);
    }

    function fillInAddress() {
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();

        for (var component in componentForm) {
            document.getElementById(component).value = '';
            document.getElementById(component).disabled = false;
        }

        // Get each component of the address from the place details
        // and fill the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
            var addressType = place.address_components[i].types[0];
            if (componentForm[addressType]) {
                var val = place.address_components[i][componentForm[addressType]];
                document.getElementById(addressType).value = val;
            }
        }
    }
});