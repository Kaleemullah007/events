@extends('front.layouts.default')
@section('title', 'About Us Page')
@section('content')
<div class="inner-page-content no-padding">
    <div class="contact-us-main">
        <div class="contact-us-inner register-inner">
            <div class="container">
                <div class="row">
                	<h2 class="text-center">Contact Us</h2>
                	<p class="text-center">We'd love to talk about how we can help you.</p>
                    <div class="panel panel-primary">
                        <div class="panel-body">
                            <form method="post" name="contact">
                                <div class="form-group">
                                    <label class="control-label" for="signupName">First Name *</label>
                                    <input name="fname" size="50" value="" maxlength="50" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="signupName">Last Name *</label>
                                    <input name="lname" size="50" value="" type="text" maxlength="50" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="signupEmail">Email Address * </label>
                                    <input name="email" size="50" value="" type="email" maxlength="50" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="signupName">Subject * </label>
                                    <input name="username" size="50" id="username" value="" type="text" maxlength="50" class="form-control">
                                    <img src="images/ajax-loader.gif" style="display:none" id="loadersymbol">
                                    <span id="userexists"></span>
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="signupPassword">Contact Number</label>
                                    <input name="number" size="50" type="number" maxlength="15" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="signupPassword">Query in Details</label>
                                    <textarea class="form-control" rows="4"></textarea>
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="action" class="btn btn-info btn-block" value="Submit">
                                </div>
                                <p class="text-center">We'll get back to you in as soon as possible.</p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop