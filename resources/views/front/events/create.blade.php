@extends('front.layouts.default')
@section('title', 'Post Event Page')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

<script src="https://www.google.com/recaptcha/api.js" async defer></script>
@section('content')
 <style>
     #g-recaptcha-response {
    display: block !important;
    position: absolute;
    margin: -78px 0 0 0 !important;
    width: 302px !important;
    height: 76px !important;
    z-index: -999999;
    opacity: 0;
}
</style>
<div class="container">
    <h2 class="big-title">Post Conference / Event</h2>
    <form id="eventForm" method="POST" enctype="multipart/form-data" action="{{ route('addFrontEvent') }}">
    	@csrf
	    <div class="common-box">
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
	        <h2 class="sub-title text-center">Organizer Details</h2>
	        <div class="row pt-20">
	            <div class="lable-input-wrap clearfix">
	                <div class="col-sm-4">
	                    <label>Name of organization *</label>
	                </div>
	                <div class="col-sm-4">
	                    <input type="text" name="organization_name" placeholder="" class="form-control" value="{{$event->organization_name ?? ''}}">
	                </div>
	            </div>
	        </div>
	        <div class="row">
	            <div class="lable-input-wrap clearfix">
	                <div class="col-sm-4">
	                    <label>Admin email address *</label>
	                </div>
	                <div class="col-sm-4">
	                    <input type="text" name="admin_email_address" placeholder="" class="form-control" value="{{$event->admin_email_address ?? ''}}">
	                </div>
	            </div>
	        </div>
	        <!-- <div class="row">
	            <div class="lable-input-wrap clearfix">
	                <div class="col-sm-4">
	                    <label>Username *</label>
	                </div>
	                <div class="col-sm-4">
	                    <input type="text" class="form-control">
	                </div>
	            </div>
	        </div>
	        <div class="row">
	            <div class="lable-input-wrap clearfix">
	                <div class="col-sm-4">
	                    <label>Password *</label>
	                </div>
	                <div class="col-sm-4">
	                    <input type="password" class="form-control">
	                </div>
	            </div>
	        </div> -->
	    </div>

	    <div class="common-box">
	        <h2 class="sub-title text-center">Conference/Events Details</h2>
	        <div class="row pt-20">
	            <div class="lable-input-wrap clearfix">
	                <div class="col-sm-4">
	                    <label>Logo (optional)</label>
	                </div>
	                <div class="col-sm-4">
	                    <input type="file" name="logo" id="logo" accept="image/*" class="form-control-file">
	                </div>
	            </div>
	        </div>
	        <div class="row">
	            <div class="lable-input-wrap clearfix">
	                <div class="col-sm-4">
	                    <label>Conference/Event Title *</label>
	                </div>
	                <div class="col-sm-4">
	                    <input type="text" name="title" placeholder="" class="form-control" value="{{$event->title ?? ''}}">
	                </div>
	            </div>
	        </div>
	        <div class="row">
	            <div class="lable-input-wrap clearfix">
	                <div class="col-sm-4">
	                    <label>Event Category *</label>
	                </div>
	                <div class="col-sm-4">
	                    <!-- <select class="form-control">
	                        <option value="">Select</option>
	                        <option value="11">
	                            Animal Sciences </option>
	                        <option value="147">
	                            &nbsp;&nbsp;»&nbsp;Veterinary Science </option>
	                        <option value="5">
	                            Business and Economics </option>
	                        <option value="68">
	                            &nbsp;&nbsp;»&nbsp;Banking and finance </option>
	                        <option value="69">
	                            &nbsp;&nbsp;»&nbsp;Business </option>
	                        <option value="70">
	                            &nbsp;&nbsp;»&nbsp;Business Ethics </option>
	                        <option value="71">
	                            &nbsp;&nbsp;»&nbsp;E-commerce </option>
	                        <option value="72">
	                            &nbsp;&nbsp;»&nbsp;Economics </option>
	                        <option value="73">
	                            &nbsp;&nbsp;»&nbsp;Human Resources </option>
	                        <option value="74">
	                            &nbsp;&nbsp;»&nbsp;Management </option>
	                        <option value="75">
	                            &nbsp;&nbsp;»&nbsp;Marketing </option>
	                        <option value="8">
	                            Education </option>
	                        <option value="118">
	                            &nbsp;&nbsp;»&nbsp;E-learning </option>
	                        <option value="119">
	                            &nbsp;&nbsp;»&nbsp;Higher Education </option>
	                        <option value="120">
	                            &nbsp;&nbsp;»&nbsp;Lifelong Learning </option>
	                        <option value="121">
	                            &nbsp;&nbsp;»&nbsp;Teaching and Learning </option>
	                        <option value="7">
	                            Engineering and Technology </option>
	                        <option value="94">
	                            &nbsp;&nbsp;»&nbsp;Architecture </option>
	                        <option value="95">
	                            &nbsp;&nbsp;»&nbsp;Artificial Intelligence </option>
	                        <option value="96">
	                            &nbsp;&nbsp;»&nbsp;Bioinformatics </option>
	                        <option value="97">
	                            &nbsp;&nbsp;»&nbsp;Biomedical Engineering </option>
	                        <option value="98">
	                            &nbsp;&nbsp;»&nbsp;Biotechnology </option>
	                        <option value="99">
	                            &nbsp;&nbsp;»&nbsp;Computer software and applications </option>
	                        <option value="100">
	                            &nbsp;&nbsp;»&nbsp;Computing </option>
	                        <option value="101">
	                            &nbsp;&nbsp;»&nbsp;Data Mining </option>
	                        <option value="102">
	                            &nbsp;&nbsp;»&nbsp;Design </option>
	                        <option value="103">
	                            &nbsp;&nbsp;»&nbsp;Energy </option>
	                        <option value="104">
	                            &nbsp;&nbsp;»&nbsp;Engineering </option>
	                        <option value="105">
	                            &nbsp;&nbsp;»&nbsp;Forestry </option>
	                        <option value="106">
	                            &nbsp;&nbsp;»&nbsp;Information Technology </option>
	                        <option value="107">
	                            &nbsp;&nbsp;»&nbsp;Internet and World Wide Web </option>
	                        <option value="108">
	                            &nbsp;&nbsp;»&nbsp;Manufacturing </option>
	                        <option value="109">
	                            &nbsp;&nbsp;»&nbsp;Military </option>
	                        <option value="110">
	                            &nbsp;&nbsp;»&nbsp;Mining </option>
	                        <option value="111">
	                            &nbsp;&nbsp;»&nbsp;Nanotechnology and Smart Materials </option>
	                        <option value="112">
	                            &nbsp;&nbsp;»&nbsp;Polymers and Plastics </option>
	                        <option value="113">
	                            &nbsp;&nbsp;»&nbsp;Renewable Energy </option>
	                        <option value="114">
	                            &nbsp;&nbsp;»&nbsp;Robotics </option>
	                        <option value="115">
	                            &nbsp;&nbsp;»&nbsp;Space Environment and Aviation Technology </option>
	                        <option value="116">
	                            &nbsp;&nbsp;»&nbsp;Systems Engineering </option>
	                        <option value="117">
	                            &nbsp;&nbsp;»&nbsp;Transport </option>
	                        <option value="10">
	                            Health and Medicine </option>
	                        <option value="123">
	                            &nbsp;&nbsp;»&nbsp;Alternative Health </option>
	                        <option value="124">
	                            &nbsp;&nbsp;»&nbsp;Cardiology </option>
	                        <option value="125">
	                            &nbsp;&nbsp;»&nbsp;Dentistry </option>
	                        <option value="126">
	                            &nbsp;&nbsp;»&nbsp;Dermatology </option>
	                        <option value="127">
	                            &nbsp;&nbsp;»&nbsp;Disability and Rehabilitation </option>
	                        <option value="128">
	                            &nbsp;&nbsp;»&nbsp;Family Medicine </option>
	                        <option value="129">
	                            &nbsp;&nbsp;»&nbsp;Food Safety </option>
	                        <option value="130">
	                            &nbsp;&nbsp;»&nbsp;Gastroenterology </option>
	                        <option value="131">
	                            &nbsp;&nbsp;»&nbsp;Gerontology </option>
	                        <option value="132">
	                            &nbsp;&nbsp;»&nbsp;Health </option>
	                        <option value="133">
	                            &nbsp;&nbsp;»&nbsp;Infectious diseases </option>
	                        <option value="134">
	                            &nbsp;&nbsp;»&nbsp;Medical ethics </option>
	                        <option value="135">
	                            &nbsp;&nbsp;»&nbsp;Medicine and Medical Science </option>
	                        <option value="136">
	                            &nbsp;&nbsp;»&nbsp;Neurology </option>
	                        <option value="137">
	                            &nbsp;&nbsp;»&nbsp;Nursing </option>
	                        <option value="138">
	                            &nbsp;&nbsp;»&nbsp;Nutrition and Dietetics </option>
	                        <option value="139">
	                            &nbsp;&nbsp;»&nbsp;Oncology </option>
	                        <option value="140">
	                            &nbsp;&nbsp;»&nbsp;Palliative Care </option>
	                        <option value="141">
	                            &nbsp;&nbsp;»&nbsp;Psychiatry </option>
	                        <option value="142">
	                            &nbsp;&nbsp;»&nbsp;Public Health </option>
	                        <option value="143">
	                            &nbsp;&nbsp;»&nbsp;Radiology </option>
	                        <option value="144">
	                            &nbsp;&nbsp;»&nbsp;Reproductive Medicine and Women's Health </option>
	                        <option value="145">
	                            &nbsp;&nbsp;»&nbsp;Social Work </option>
	                        <option value="146">
	                            &nbsp;&nbsp;»&nbsp;Surgery </option>
	                        <option value="2">
	                            Interdisciplinary </option>
	                        <option value="36">
	                            &nbsp;&nbsp;»&nbsp;Children and Youth </option>
	                        <option value="37">
	                            &nbsp;&nbsp;»&nbsp;Communications and Media </option>
	                        <option value="38">
	                            &nbsp;&nbsp;»&nbsp;Conflict resolution </option>
	                        <option value="39">
	                            &nbsp;&nbsp;»&nbsp;Creativity </option>
	                        <option value="40">
	                            &nbsp;&nbsp;»&nbsp;Culture </option>
	                        <option value="41">
	                            &nbsp;&nbsp;»&nbsp;Disaster Management </option>
	                        <option value="42">
	                            &nbsp;&nbsp;»&nbsp;Discourse </option>
	                        <option value="43">
	                            &nbsp;&nbsp;»&nbsp;Film studies </option>
	                        <option value="45">
	                            &nbsp;&nbsp;»&nbsp;Gender studies </option>
	                        <option value="44">
	                            &nbsp;&nbsp;»&nbsp;GLBT Studies </option>
	                        <option value="46">
	                            &nbsp;&nbsp;»&nbsp;Globalization </option>
	                        <option value="47">
	                            &nbsp;&nbsp;»&nbsp;HIV/AIDS </option>
	                        <option value="48">
	                            &nbsp;&nbsp;»&nbsp;Human Rights </option>
	                        <option value="49">
	                            &nbsp;&nbsp;»&nbsp;Identity </option>
	                        <option value="50">
	                            &nbsp;&nbsp;»&nbsp;Leadership </option>
	                        <option value="51">
	                            &nbsp;&nbsp;»&nbsp;Memory </option>
	                        <option value="52">
	                            &nbsp;&nbsp;»&nbsp;Poverty </option>
	                        <option value="53">
	                            &nbsp;&nbsp;»&nbsp;Public Policy </option>
	                        <option value="54">
	                            &nbsp;&nbsp;»&nbsp;Sexuality and eroticism </option>
	                        <option value="55">
	                            &nbsp;&nbsp;»&nbsp;Spirituality </option>
	                        <option value="56">
	                            &nbsp;&nbsp;»&nbsp;Sport science </option>
	                        <option value="57">
	                            &nbsp;&nbsp;»&nbsp;Sustainable development </option>
	                        <option value="58">
	                            &nbsp;&nbsp;»&nbsp;Tourism </option>
	                        <option value="59">
	                            &nbsp;&nbsp;»&nbsp;Urban studies </option>
	                        <option value="60">
	                            &nbsp;&nbsp;»&nbsp;Violence </option>
	                        <option value="61">
	                            &nbsp;&nbsp;»&nbsp;Women's studies </option>
	                        <option value="9">
	                            Law </option>
	                        <option value="122">
	                            &nbsp;&nbsp;»&nbsp;Justice and legal studies </option>
	                        <option value="4">
	                            Mathematics and statistics </option>
	                        <option value="66">
	                            &nbsp;&nbsp;»&nbsp;Mathematics </option>
	                        <option value="67">
	                            &nbsp;&nbsp;»&nbsp;Statistics </option>
	                        <option value="6">
	                            Physical and life sciences </option>
	                        <option value="76">
	                            &nbsp;&nbsp;»&nbsp;Agriculture </option>
	                        <option value="77">
	                            &nbsp;&nbsp;»&nbsp;Aquaculture </option>
	                        <option value="78">
	                            &nbsp;&nbsp;»&nbsp;Archaeology </option>
	                        <option value="79">
	                            &nbsp;&nbsp;»&nbsp;Astronomy </option>
	                        <option value="80">
	                            &nbsp;&nbsp;»&nbsp;Biodiversity </option>
	                        <option value="81">
	                            &nbsp;&nbsp;»&nbsp;Biology </option>
	                        <option value="82">
	                            &nbsp;&nbsp;»&nbsp;Chemistry </option>
	                        <option value="83">
	                            &nbsp;&nbsp;»&nbsp;Earth Sciences </option>
	                        <option value="84">
	                            &nbsp;&nbsp;»&nbsp;Ecology </option>
	                        <option value="85">
	                            &nbsp;&nbsp;»&nbsp;Environment </option>
	                        <option value="87">
	                            &nbsp;&nbsp;»&nbsp;Genetics </option>
	                        <option value="86">
	                            &nbsp;&nbsp;»&nbsp;GIS </option>
	                        <option value="88">
	                            &nbsp;&nbsp;»&nbsp;Meteorology </option>
	                        <option value="89">
	                            &nbsp;&nbsp;»&nbsp;Oceanography </option>
	                        <option value="90">
	                            &nbsp;&nbsp;»&nbsp;Physics </option>
	                        <option value="91">
	                            &nbsp;&nbsp;»&nbsp;Soil </option>
	                        <option value="92">
	                            &nbsp;&nbsp;»&nbsp;Waste Management </option>
	                        <option value="93">
	                            &nbsp;&nbsp;»&nbsp;Water </option>
	                        <option value="3">
	                            Regional Studies </option>
	                        <option value="62">
	                            &nbsp;&nbsp;»&nbsp;African Studies </option>
	                        <option value="63">
	                            &nbsp;&nbsp;»&nbsp;American Studies </option>
	                        <option value="64">
	                            &nbsp;&nbsp;»&nbsp;Asian Studies </option>
	                        <option value="65">
	                            &nbsp;&nbsp;»&nbsp;European Studies </option>
	                        <option value="1">
	                            Social Sciences </option>
	                        <option value="12">
	                            &nbsp;&nbsp;»&nbsp;Anthropology </option>
	                        <option value="13">
	                            &nbsp;&nbsp;»&nbsp;Art History </option>
	                        <option value="14">
	                            &nbsp;&nbsp;»&nbsp;Arts </option>
	                        <option value="15">
	                            &nbsp;&nbsp;»&nbsp;English </option>
	                        <option value="16">
	                            &nbsp;&nbsp;»&nbsp;History </option>
	                        <option value="17">
	                            &nbsp;&nbsp;»&nbsp;Information science </option>
	                        <option value="18">
	                            &nbsp;&nbsp;»&nbsp;Interdisciplinary studies </option>
	                        <option value="19">
	                            &nbsp;&nbsp;»&nbsp;Islamic Studies </option>
	                        <option value="20">
	                            &nbsp;&nbsp;»&nbsp;Language </option>
	                        <option value="21">
	                            &nbsp;&nbsp;»&nbsp;Linguistics </option>
	                        <option value="22">
	                            &nbsp;&nbsp;»&nbsp;Literature </option>
	                        <option value="23">
	                            &nbsp;&nbsp;»&nbsp;Local Government </option>
	                        <option value="24">
	                            &nbsp;&nbsp;»&nbsp;Multidisciplinary Studies </option>
	                        <option value="25">
	                            &nbsp;&nbsp;»&nbsp;Museums and heritage </option>
	                        <option value="26">
	                            &nbsp;&nbsp;»&nbsp;Music </option>
	                        <option value="27">
	                            &nbsp;&nbsp;»&nbsp;Occupational Science </option>
	                        <option value="28">
	                            &nbsp;&nbsp;»&nbsp;Philosophy </option>
	                        <option value="29">
	                            &nbsp;&nbsp;»&nbsp;Poetry </option>
	                        <option value="30">
	                            &nbsp;&nbsp;»&nbsp;Politics </option>
	                        <option value="31">
	                            &nbsp;&nbsp;»&nbsp;Psychology </option>
	                        <option value="32">
	                            &nbsp;&nbsp;»&nbsp;Religious studies </option>
	                        <option value="33">
	                            &nbsp;&nbsp;»&nbsp;Social Sciences </option>
	                        <option value="34">
	                            &nbsp;&nbsp;»&nbsp;Sociology </option>
	                        <option value="35">
	                            &nbsp;&nbsp;»&nbsp;Women's history </option>
	                    </select> -->
	                    <select class="select2 form-control js-example-basic-multiple" multiple="multiple"  name="category_ids[]">
                            <option value="" disabled="">Select Category</option>
                            @if(isset($categories) && $categories->count() > 0)
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}" 
                                        {{isset($category_ids) && (in_array($category->id, $category_ids)) ? "selected" : ""}} > {{$category->name}}</option>
                                @endforeach
                            @endif
                        </select>
	                </div>
	            </div>
	        </div>
	        <div class="row">
	            <div class="lable-input-wrap clearfix">
	                <div class="col-sm-4">
	                    <label>Event Type * </label>
	                </div>
	                <div class="col-sm-4">
	                    <select class="select2 form-control" name="type_id">
                            <option value="">Select Type</option>
                            @if(isset($types) && $types->count() > 0)
                                @foreach($types as $type)
                                    <option value="{{$type->id}}" {{isset($event->type_id) && $type->id == $event->type_id ? 'selected' : ''}}>{{$type->name}}</option>
                                @endforeach
                            @endif
                        </select>
	                </div>
	            </div>
	        </div>
	        <div class="row">
	            <div class="lable-input-wrap clearfix">
	                <div class="col-sm-4">
	                    <label>Country</label>
	                </div>
	                <div class="col-sm-4">
	                    <select class="select2 countries form-control" name="country_id">
                            <option value="">Select Country </option>
                            @if(isset($countries) && $countries->count() > 0)
                                @foreach($countries as $country)
                                    <option value="{{$country->id}}" {{isset($event->country_id) && $country->id == $event->country_id ? 'selected' : ''}}>{{$country->name}}</option>
                                @endforeach
                            @endif
                        </select>
	                </div>
	            </div>
	        </div>
	        <div class="row">
	            <div class="lable-input-wrap clearfix">
	                <div class="col-sm-4">
	                    <label>State</label>
	                </div>
	                <div class="col-sm-4">
	                    <select class="select2 states form-control" name="state_id">
                            <option value="">Select State</option>
                        </select>
	                </div>
	            </div>
	        </div>
	        <div class="row">
	            <div class="lable-input-wrap clearfix">
	                <div class="col-sm-4">
	                    <label>City</label>
	                </div>
	                <div class="col-sm-4">
	                    <select class="select2 cities form-control" name="city_id">
                            <option value="">Select City</option>
                        </select>
	                </div>
	            </div>
	        </div>
	        <div class="row">
	            <div class="lable-input-wrap clearfix">
	                <div class="col-sm-4">
	                    <label>Organizing society</label>
	                </div>
	                <div class="col-sm-4">
	                    <input type="input" name="organizing_society" placeholder="" class="form-control" value="{{$event->organizing_society ?? ''}}">
	                </div>
	            </div>
	        </div>
	        <div class="row">
	            <div class="lable-input-wrap clearfix">
	                <div class="col-sm-4">
	                    <label>Contact person for event *</label>
	                </div>
	                <div class="col-sm-4">
	                    <input type="text" name="contact_person" placeholder="" class="form-control" value="{{$event->contact_person ?? ''}}">
	                </div>
	            </div>
	        </div>
	        <div class="row">
	            <div class="lable-input-wrap clearfix">
	                <div class="col-sm-4">
	                    <label>Event enquiries email address *</label>
	                </div>
	                <div class="col-sm-4">
	                    <input type="text" name="enquireis_email_address" placeholder="" class="form-control" value="{{$event->enquireis_email_address ?? ''}}">
	                </div>
	            </div>
	        </div>
	        <div class="row">
	            <div class="lable-input-wrap clearfix">
	                <div class="col-sm-4">
	                    <label>Website Address *</label>
	                </div>
	                <div class="col-sm-4">
	                    <input type="text" name="website_address" placeholder="" class="form-control" value="{{$event->website_address ?? ''}}">
	                </div>
	            </div>
	        </div>
	        <div class="row">
	            <div class="lable-input-wrap clearfix">
	                <div class="col-sm-4">
	                    <label>Event start date *</label>
	                </div>
	                <div class="col-sm-4">
	                    <input type="text" name="start_date" readonly="" placeholder="" class="form-control air-datepicker" value="{{$event->start_date ?? ''}}">
	                </div>
	            </div>
	        </div>
	        <div class="row">
	            <div class="lable-input-wrap clearfix">
	                <div class="col-sm-4">
	                    <label>Event end date *</label>
	                </div>
	                <div class="col-sm-4">
	                    <input type="text" name="end_date" readonly="" placeholder="" class="form-control air-datepicker" value="{{$event->end_date ?? ''}}">
	                </div>
	            </div>
	        </div>
	        <div class="row">
	            <div class="lable-input-wrap clearfix">
	                <div class="col-sm-4">
	                    <label>Deadline for abstracts/proposals *</label>
	                </div>
	                <div class="col-sm-4">
	                    <input type="text" name="abstract" placeholder="" readonly="" class="form-control air-datepicker" value="{{$event->abstract ?? ''}}">
	                </div>
	            </div>
	        </div>
	        <div class="row">
	            <div class="lable-input-wrap clearfix">
	                <div class="col-sm-4">
	                    <label>Short description * </label>
	                </div>
	                <div class="col-sm-4">

<textarea name="short_description" id="short_description" class="form-control"  >{{$event->short_description ?? ''}}</textarea>

	                    <!-- <input type="text" name="short_description" placeholder="" id="short_description" class="form-control" value="{{$event->short_description ?? ''}}"> -->
	                </div>
	            </div>
	        </div>
	        <div class="row">
	            <div class="lable-input-wrap clearfix">
	                <div class="col-sm-4">
	                    <label>Event Keywords *</label>
	                </div>
	                <div class="col-sm-4">
	                	<textarea name="keywords" id="keywords" class="form-control"  >{{$event->keywords ?? ''}}</textarea>

	                    <!-- <input type="text" name="keywords" placeholder="" id="keywords" class="form-control" value="{{$event->keywords ?? ''}}"> -->
	                </div>
	            </div>
	        </div>
	        <div class="row">
	            <div class="lable-input-wrap clearfix">
	                <div class="col-sm-4">
	                    <label>Keynote Speakers (optional)</label>
	                </div>
	                <div class="col-sm-4">
	                	<textarea name="keynote_speakers" id="keynote_speakers" class="form-control"  >{{$event->keynote_speakers ?? ''}}</textarea>
	                   <!--  <input type="text" name="keynote_speakers" placeholder="" id="keynote_speakers" class="form-control" value="{{$event->keynote_speakers ?? ''}}"> -->
	                </div>
	            </div>
	        </div>
	        <div class="row">
	            <div class="lable-input-wrap clearfix">
	                <div class="col-sm-4">
	                    <label>Conference Highlights (optional)</label>
	                </div>
	                <div class="col-sm-4">
	                	<textarea name="conference_highlights" id="conference_highlights" class="form-control"  >{{$event->conference_highlights ?? ''}}</textarea>
	                	
	                    <!-- <input type="text" name="conference_highlights" placeholder="" id="conference_highlights" class="form-control" value="{{$event->conference_highlights ?? ''}}"> -->
	                </div>
	            </div>
	        </div>
	        <div class="row">
	            <div class="lable-input-wrap clearfix">
	                <div class="col-sm-4">
	                    <label>Venue (optional)</label>
	                </div>
	                <div class="col-sm-4">
	                    <input type="text" name="venue" placeholder="" id="autocomplete" class="form-control" value="{{$event->venue ?? ''}}">
	                </div>
	            </div>
	        </div>
	        <div class="row">
	            <div class="lable-input-wrap clearfix">
	                <div class="col-sm-4">
	                    <label>Publisher *</label>
	                </div>
	                <div class="col-sm-4">
	                    <select class="select2 publishers form-control" name="publisher_id">
                            <option value="">Select Publisher</option>
                            @if(isset($publishers) && $publishers->count() > 0)
                                @foreach($publishers as $publisher)
                                    <option value="{{$publisher->id}}" {{isset($event->publisher_id) && $publisher->id == $event->publisher_id ? 'selected' : ''}}>{{$publisher->name}}</option>
                                @endforeach
                            @endif
                            <option value="other">Other</option>
                        </select>
	                </div>
	            </div>
	        </div>
	        <div class="row hide otherField">
	            <div class="lable-input-wrap clearfix">
	                <div class="col-sm-4">
	                    <label>Other *</label>
	                </div>
	                <div class="col-sm-4">
	                    <input type="text" name="other" placeholder="" id="other" class="form-control" value="{{$event->other ?? ''}}">
	                </div>
	            </div>
	        </div>
	        <div class="row hide otherField">
	            <div class="lable-input-wrap clearfix">
	                <div class="col-sm-4">
	                    <label>Logo (optional)</label>
	                </div>
	                <div class="col-sm-4">
	                    <input type="file" name="publisher_logo" accept="image/*" class="form-control-file">
	                </div>
	            </div>
	        </div>
	    </div>
	    <div class="row">
<div class="col-md-offset-4 col-sm-12 text-center">
                                    <div class="g-recaptcha" data-sitekey="6LdrDu4UAAAAAPSCjiKNNtyi_M6DAJQ9L2A37GXC"></div>
                                     <span class="invalid-feedback" role="alert">
                                         
                                         @error('g-recaptcha-response')
                                         <strong>{{ $message }}</strong>
                                         @enderror
                                        </span>
                                        </div>
                                        <br>
                                        
	        <div class="col-sm-12 text-center">
	            <div class="common-btn">
	                <a href="javascript:void(0)" id="btnSave">Submit</a>
	            </div>
	        </div>
	    </div>
	</form>
</div>
<div class="container">
    <div class="bottom-side-ad hidden-xs hidden-sm"></div>
</div>
@stop
@section('js')
<!-- Jquery Validation Js -->
<script src="{{ asset('admin/js/jquery.validate.min.js') }}"></script>
<!-- Date Picker Js -->
<script src="{{ asset('admin/js/datepicker.min.js') }}"></script>
<script type="text/javascript">
    var countryId = {{$event->country_id ?? 0}};
    var stateId = {{$event->state_id ?? 0}};
    var cityId = {{$event->city_id ?? 0}};

    $.ajaxSetup({
		headers: {
		  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	$(document).ajaxSend(function(){
		$(".loading").removeClass('hide');
	});

	$(document).ajaxComplete(function(){
		$(".loading").addClass('hide');
	});

	$('.air-datepicker').datepicker({
        language: {
          days: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
          daysShort: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
          daysMin: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
          months: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
          monthsShort: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
          today: 'Today',
          clear: 'Clear',
          dateFormat: 'dd/mm/yyyy',
          firstDay: 0
        }
      });

      $('.air-datepicker-current').datepicker({
        minDate: new Date(),
        language: {
          days: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
          daysShort: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
          daysMin: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
          months: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
          monthsShort: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
          today: 'Today',
          clear: 'Clear',
          dateFormat: 'dd/mm/yyyy',
          firstDay: 0
        },
      });
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDU4nUHXm0Mc_d0heANHQjuwzDQmPDkX_g&libraries=places&callback=initAutocomplete"
        async defer></script>
        <script>
    window.onload = function() {
    var $recaptcha = document.querySelector('#g-recaptcha-response');

    if($recaptcha) {
        $recaptcha.setAttribute("required", "required");
    }
};
var data = []; // Programatically-generated options array with > 5 options
var placeholder = "Select Maximum four category";
$(".js-example-basic-multiple").select2({
    data: data,
    placeholder: placeholder,
    allowClear: false,
    maximumSelectionLength: 4
});
// minimumResultsForSearch: 5
</script>
<script src="{{ asset('js/event.js') }}"></script>

@stop