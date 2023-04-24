@extends('user.layout.master')
@section('content')





    <!-- Contact Start -->
    <div class="container-fluid">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Contact Us</span></h2>
        <div class="row px-xl-5">
            <div class="col-lg-7 mb-5">
                <div class="contact-form bg-light p-30">
                    <div id="success"></div>
                    <form action="{{route('contact#create',Auth::user()->id)}}" method="post">
                        @csrf
                        <div class="control-group">
                            <input type="text" class="form-control" id="name" placeholder="Your Name"
                              name="name" value="{{Auth::user()->name }}" disabled  required="required" data-validation-required-message="Please enter your name" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="email" class="form-control" id="email" placeholder="Your Email"
                            name="email" value="{{Auth::user()->email }}" disabled  required="required" data-validation-required-message="Please enter your email" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <textarea class="form-control" rows="8" id="message" placeholder="Message"
                               name="message" required="required"
                                data-validation-required-message="Please enter your message"></textarea>
                            <p class="help-block text-danger"></p>
                        </div>
                        <div>
                            <button class="btn btn-primary py-2 px-4" type="submit" id="sendMessageButton">Send
                                Message</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-5 mb-5">

                <div class="bg-light p-30 mb-3">
                    <p class="mb-2">admin<i class="fa fa-map-marker-alt text-primary mr-3"></i> {{$user->address}} </p>
                    <p class="mb-2">admin<i class="fa fa-envelope text-primary mr-3"></i> {{$user->email}} </p>
                    <p class="mb-2">admin<i class="fa fa-phone-alt text-primary mr-3"></i> {{$user->phone}} </p>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->


  @endsection
