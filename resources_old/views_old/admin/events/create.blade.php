@extends('admin.layouts.default')
@section('content')
<div class="breadcrumbs-area">
    <h3>Events</h3>
    <ul>
        <li>
            <a href="{{ url('/admin/home')}}">Home</a>
        </li>
        <li>Add New Event</li>
    </ul>
</div>
<!-- Breadcubs Area End Here -->
<!-- Add New Event Area Start Here -->
<div class="card ui-tab-card">
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (\Session::has('success'))
            <div class="alert alert-success">
                <ul>
                    <li>{!! \Session::get('success') !!}</li>
                </ul>
            </div>
        @endif
        <div class="basic-tab">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#tab1" role="tab" aria-selected="true">ORGANIZER</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab2" id="lun" role="tab" aria-selected="false">EVENT DETAILS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab3" role="tab" aria-selected="false">EVENT DATE</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tab4" role="tab" aria-selected="false">KEYWORDS</a>
                </li>
            </ul>
            <form class="new-added-form" id="eventForm" method="POST" enctype="multipart/form-data" action="/admin/events/add">
                @csrf
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab1" role="tabpanel">
                        <input type="hidden" name="id" value="{{$event->id ?? 0}}">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3>ORGANIZER DETAILS</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-12 form-group">
                                <label>Name of organization *</label>
                                <input type="text" name="organization_name" placeholder="" class="form-control" value="{{$event->organization_name ?? ''}}">
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12 form-group">
                                <label>Admin email address *</label>
                                <input type="text" name="admin_email_address" placeholder="" class="form-control" value="{{$event->admin_email_address ?? ''}}">
                            </div>
                            <div class="col-12 form-group mg-t-8">
                                <a class="btn-fill-md text-light bg-dodger-blue radius-4 continue">Continue</a>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab2" role="tabpanel">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3>CONFERENCE/EVENTS DETAILS</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-12 form-group">
                                <label>Logo (optional)</label>
                                <input type="file" name="logo" id="logo" accept="image/*" class="form-control-file">
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12 form-group">
                                <div class="item-img-custom">
                                    <img src="{{isset($event->logo) ? asset('logos/events/'.$event->logo) : '/admin/img/figure/parents.jpg'}}" alt="student" id="logoPreview">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12 form-group">
                                <label>Conference/Event Title *</label>
                                <input type="text" name="title" placeholder="" class="form-control" value="{{$event->title ?? ''}}">
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12 form-group">
                                <label>Event Category *</label>
                                <select class="select2" name="category_ids[]">
                                    <option value="" disabled="">Select Category</option>
                                    @if(isset($categories) && $categories->count() > 0)
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}" 
                                                {{isset($category_ids) && (in_array($category->id, $category_ids)) ? "selected" : ""}} > {{$category->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12 form-group">
                                <label>Event Type *</label>
                                <select class="select2" name="type_id">
                                    <option value="">Select Type</option>
                                    @if(isset($types) && $types->count() > 0)
                                        @foreach($types as $type)
                                            <option value="{{$type->id}}" {{isset($event->type_id) && $type->id == $event->type_id ? 'selected' : ''}}>{{$type->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12 form-group">
                                <label>Country</label>
                                <select class="select2 countries" name="country_id">
                                    <option value="">Select Country </option>
                                    @if(isset($countries) && $countries->count() > 0)
                                        @foreach($countries as $country)
                                            <option value="{{$country->id}}" {{isset($event->country_id) && $country->id == $event->country_id ? 'selected' : ''}}>{{$country->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12 form-group">
                                <label>State</label>
                                <select class="select2 states" name="state_id">
                                    <option value="">Select State</option>
                                </select>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12 form-group">
                                <label>City</label>
                                <select class="select2 cities" name="city_id">
                                    <option value="">Select City</option>
                                </select>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12 form-group">
                                <label>Organizing society</label>
                                <input type="input" name="organizing_society" placeholder="" class="form-control" value="{{$event->organizing_society ?? ''}}">
                            </div>
                            <div class="col-12 form-group mg-t-8">
                                <a class="btn-fill-md text-light bg-dodger-blue radius-4 continue">Continue</a>
                                <a class="btn-fill-md text-light bg-orange-peel radius-4 back">Go Back</a>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab3" role="tabpanel">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-12 form-group">
                                <label>Contact person for event *</label>
                                <input type="text" name="contact_person" placeholder="" class="form-control" value="{{$event->contact_person ?? ''}}">
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12 form-group">
                                <label>Event enquiries email address *</label>
                                <input type="text" name="enquireis_email_address" placeholder="" class="form-control" value="{{$event->enquireis_email_address ?? ''}}">
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12 form-group">
                                <label>Website Address *</label>
                                <input type="text" name="website_address" placeholder="" class="form-control" value="{{$event->website_address ?? ''}}">
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12 form-group">
                                <label>Event start date *</label>
                                <input type="text" name="start_date" readonly="" placeholder="" class="form-control air-datepicker" value="{{$event->start_date ?? ''}}">
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12 form-group">
                                <label>Event end date *</label>
                                <input type="text" name="end_date" readonly="" placeholder="" class="form-control air-datepicker" value="{{$event->end_date ?? ''}}">
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12 form-group">
                                <label>Deadline for abstracts/proposals *</label>
                                <input type="text" name="abstract" placeholder="" readonly="" class="form-control air-datepicker" value="{{$event->abstract ?? ''}}">
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12 form-group">
                                <label>Short description *</label>
                                <textarea class="textarea form-control" name="short_description" id="short_description" cols="10" rows="4">{{$event->short_description ?? ''}}</textarea>
                            </div>
                            <div class="col-12 form-group mg-t-8">
                                <a class="btn-fill-md text-light bg-dodger-blue radius-4 continue">Continue</a>
                                <a class="btn-fill-md text-light bg-orange-peel radius-4 back">Go Back</a>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab4" role="tabpanel">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-12 form-group">
                                <label>Event Keywords *</label>
                                <textarea class="textarea form-control" name="keywords" id="keywords" cols="10" rows="9">{{$event->keywords ?? ''}}</textarea>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12 form-group">
                                <label>Keynote Speakers (optional)</label>
                                <textarea class="textarea form-control" name="keynote_speakers" id="" cols="10" rows="9">{{$event->keynote_speakers ?? ''}}</textarea>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12 form-group">
                                <label>Conference Highlights (optional)</label>
                                <textarea class="textarea form-control" name="conference_highlights" id="conference_highlights" cols="10" rows="9">{{$event->conference_highlights ?? ''}}</textarea>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12 form-group">
                                <label>Venue (optional)</label>
                                <input type="text" placeholder="" id="autocomplete" name="venue" class="form-control" value="{{$event->venue ?? ''}}">
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12 form-group">
                                <label>Publisher*</label>
                                <select class="select2 publishers" name="publisher_id">
                                    <option value="">Select Publisher</option>
                                    @if(isset($publishers) && $publishers->count() > 0)
                                        @foreach($publishers as $publisher)
                                            <option value="{{$publisher->id}}" {{isset($event->publisher_id) && $publisher->id == $event->publisher_id ? 'selected' : ''}}>{{$publisher->name}}</option>
                                        @endforeach
                                    @endif
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12 form-group hide otherField">
                                <label>Other*</label>
                                <input type="text" placeholder="" name="other" class="form-control">
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12 form-group hide otherField">
                                <label>Logo (optional)</label>
                                <input type="file" name="publisher_logo" id="" accept="image/*" class="form-control-file">
                            </div>
                            <div class="col-xl-6 col-lg-6 col-12 form-group">
                                <div class="form-check">
                                    <input class="form-check-input" value="1" type="checkbox" name="is_featured" id="is_featured" {{isset($event->is_featured) && $event->is_featured == 1 ? 'checked' : ''}}>
                                    <label for="is_featured" class="form-check-label">Is Featured</label>
                                </div>
                            </div>
                            <div class="col-12 form-group mg-t-8">
                                <button type="button" class="btn-fill-md text-light bg-dark-pastel-green radius-4" id="btnSave">Save</button>
                                <a class="btn-fill-md text-light bg-orange-peel radius-4 back">Go Back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@section('js')
<script type="text/javascript">
    var countryId = {{$event->country_id ?? 0}};
    var stateId = {{$event->state_id ?? 0}};
    var cityId = {{$event->city_id ?? 0}};
</script>


    <script>
// This sample uses the Autocomplete widget to help the user select a
// place, then it retrieves the address components associated with that
// place, and then it populates the form fields with those details.
// This sample requires the Places library. Include the libraries=places
// parameter when you first load the API. For example:
// <script
// src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

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
  // Create the autocomplete object, restricting the search predictions to
  // geographical location types.
  autocomplete = new google.maps.places.Autocomplete(
      document.getElementById('autocomplete'), {types: ['geocode']});

  // Avoid paying for data that you don't need by restricting the set of
  // place fields that are returned to just the address components.
  autocomplete.setFields(['address_component']);

  // When the user selects an address from the drop-down, populate the
  // address fields in the form.
  autocomplete.addListener('place_changed', fillInAddress);
}

function fillInAddress() {
  // Get the place details from the autocomplete object.
  var place = autocomplete.getPlace();

  for (var component in componentForm) {
    document.getElementById(component).value = '';
    document.getElementById(component).disabled = false;
  }

  // Get each component of the address from the place details,
  // and then fill-in the corresponding field on the form.
//   for (var i = 0; i < place.address_components.length; i++) {
//     var addressType = place.address_components[i].types[0];
//     if (componentForm[addressType]) {
//       var val = place.address_components[i][componentForm[addressType]];
//       document.getElementById(addressType).value = val;
//     }
//   }
}

// Bias the autocomplete object to the user's geographical location,
// as supplied by the browser's 'navigator.geolocation' object.
function geolocate() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var geolocation = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };
      var circle = new google.maps.Circle(
          {center: geolocation, radius: position.coords.accuracy});
      autocomplete.setBounds(circle.getBounds());
    });
  }
}
    </script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCA6KNVJIQdfSlty9HB83I8psfgCeYe74E&libraries=places&callback=initAutocomplete"
        async defer></script>
        
<script src="{{ asset('js/event.js') }}"></script>
@stop