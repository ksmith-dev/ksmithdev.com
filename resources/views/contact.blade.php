@extends('layouts.app')

@section('head')
    @parent
    <!-- jQuery Validate CDN -->
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/additional-methods.min.js" type="text/javascript"></script>
@endsection

@section('navigation')
    @parent
@endsection

@section('content')
    <div class="spacer-20"></div>
    <div id="contact">
        <div class="contact">
            <h1>Request Information</h1>
            <form id="form" method="post" action="{{ url('contact') }}" novalidate>
                @csrf
                <div class="form-group">
                    <label for="first_name">First Name:</label>
                    @if(isset($input_errors['first_name']))
                        <input id="first_name" type="text" class="form-control is-invalid" name="first_name" placeholder="Please Enter First Name" required>
                        <div class="invalid-feedback">{{ $input_errors['first_name']->message }}</div>
                    @else
                        <input id="first_name" type="text" class="form-control" name="first_name" placeholder="Please Enter First Name" required>
                    @endif
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name:</label>
                    @if(isset($input_errors['last_name']))
                        <input id="last_name" type="text" class="form-control is-invalid" name="last_name" placeholder="Please Enter Last Name" required>
                        <div class="invalid-feedback">{{ $input_errors['last_name']->message }}</div>
                    @else
                        <input id="last_name" type="text" class="form-control" name="last_name" placeholder="Please Enter Last Name" required>
                    @endif
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    @if(isset($input_errors['email']))
                        <input id="email" type="text" class="form-control is-invalid" name="email" placeholder="Please Enter Email" required>
                        <div class="invalid-feedback">{{ $input_errors['email']->heading }} {{ $input_errors['email']->message }}</div>
                    @else
                        <input id="email" type="text" class="form-control" name="email" placeholder="Please Enter Email" required>
                    @endif
                </div>
                <div class="form-group">
                    <label for="message">Message:</label>
                    @if(isset($input_errors['message']))
                        <textarea id="message" type="textarea" class="form-control is-invalid" name="message" placeholder="Please Enter A Message" rows="5"></textarea>
                        <div class="invalid-feedback">{{ $input_errors['message']->heading }} {{ $input_errors['message']->message }}</div>
                    @else
                        <textarea id="message" type="textarea" class="form-control" name="message" placeholder="Please Enter A Message" rows="5" style="padding: 10px;"></textarea>
                    @endif
                </div>
                <div class="row">
                    <div class="col-2">
                        <button type="submit" class="btn btn-warning">Submit</button>
                    </div>
                    <div class="col"></div>
                </div>
            </form>
        </div>
        <div style="height: 50px;"></div>
        <div id="contact-info">
            <h3 class="text-center" style="margin-bottom: 50px;">Connect Online @ Sites Below</h3>
            <hr>
            <div style="height: 20px;"></div>
            <div class="row">
                <div class="col">
                    <a href="https://github.com/ksmith-dev" target="_blank"><img src="{{ asset('img/icon/github.svg') }}"><span class="social-text">GitHub</span></a>
                </div>
                <div class="col">
                    <a href="https://www.linkedin.com/in/kjsmith-dev" target="_blank"><img src="{{ asset('img/icon/linkedin.svg') }}"><span class="social-text">LinkedIn</span></a>
                </div>
            </div>
            <hr>
            <p>please contact me if you have any questions, professional or otherwise...</p>
        </div>
    </div>
    <div style="height: 100px;"></div>

@endsection

@section('footer')
    @parent
    <script src="{{ asset('js/validation.js') }}" type="text/javascript"></script>
@endsection