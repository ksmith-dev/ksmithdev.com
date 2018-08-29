@extends('layouts.app')

@section('head')
    @parent
@endsection

@section('navigation')
    @parent
@endsection

@section('content')
    <div style="height: 50px"></div>
    <div id="story">
        <div class="row">
            <div class="col">
                <h1 class="text-center">Kevin Smith</h1>
                <img id="kevin-smith-img" src="{{ asset('img/brand/kevin_smith.png') }}">
                <hr>
                <div style="height: 40px;"></div>
                <h3 class="text-center">Software Engineer | Scrum Certified | Front/Backend Developer</h3>
                <div style="height: 40px;"></div>
                <p>After working 15+ years as a technical illustrator I decided it was time to switch my career path. I knew my current profession did not allow me a great ability to create value past the capability of the AutoCad software I was trained to use. I also knew I enjoyed creating value creating lean process improvements for myself and co-worker and took ever opportunity I could to work on these projects. I knew all the cool things we can do with computers helped to speed things up and completed tasks with minimal errors and I thought of all the things I could build if I only knew how. I did not pursue this career mostly because I had a good job at a good company. Until the company decided to let go of my group and to outsource the work. At this point it was decision time, I was not prepared for the reality of losing my job but that is how the cookie crumbled. So it was then I had to make up my mind, I decided to learn how to become a web developer.</p>
                <h6>I started my journey at Sanford Brown College in their web developer program. I completed this program with an associates of applied science degree. During my time there I worked on a number of web projects where I was exposed to MODX a content management system for web developers. I also had an opportunity to developer a mobile application using PhoneGap Build that I published it to the Google Play Store.</h6>
                <h6>After I completed the associated degree program at Sanford Brown College I decided to continue my development career by signing up for Green River College Software Development program. During this program I had a lot of great opportunities to learn full stack development. It was this program that exposed programing fundamentals such as data structures and algorithms. Agile / Extreme programing methods practiced for all development projects and taught throughout the program.</h6>
            </div>
        </div>
    </div>
    <div style="height: 100px;"></div>
    <div id="banner">
        <span id="banner_01"><img src="{{ asset('img/background/banner-01.png') }}" class="banner-img"><span class="banner-text">TEST</span></span>
        <span id="banner_02"><img src="{{ asset('img/background/banner-02.png') }}" class="banner-img"><span class="banner-text">DRIVEN</span></span>
        <span id="banner_03"><img src="{{ asset('img/background/banner-03.png') }}" class="banner-img"><span class="banner-text">DEVELOPMENT</span></span>
    </div>
    <div id="testing">
        <img src="{{ asset('img/icon/flask.svg') }}" style="width: 150px; transform: rotate(45deg);">
        <h3 class="testing-title"><b>TEST</b></h3>
        <div style="height: 40px;"></div>
        <h3>Unit</h3>
        <hr>
        <p><b>PHP Unit/J Unit</b> - verify logic and proper return values for applications. This is accomplished by testing methods, components and modules.</p>
        <p>using PHP Unit/J Unit to create effective unit tests ensure that your application passed basic functionality parameters defined by project requirements. Unit testing is implemented to save time during the development process.</p>
        <h3>Integration</h3>
        <hr>
        <p><b>Mock Services</b> - ensure modules or services used by your application function and continue to work. Such as the a test that ensures the database and microservices can communicate and run smoothly.</p>
        <p>testing this functionality can be accomplished by creating mock services that return a predefined value defined by the project requirements.</p>
        <h3>Functional</h3>
        <hr>
        <p><b>Selenium</b> - tests that focus on the business requirements of an application defined in the project requirements.</p>
        <p>Selenium can be used for integration testing verifies that a query to the database will return a specific value from the database as defined by the product requirements.</p>
        <h3>Acceptance</h3>
        <hr>
        <p><b>Selenium</b> - test application under significant load to discover choke points or portions of the application that could use reduction in processing requirements. tests are created with reliability, stability, and availability in mind.</p>
        <p>Selenium can be used to facilitate acceptance testing, this may or may not meet the requirements for meeting standards set forth according to project requirements.</p>
    </div>
    <div style="height: 200px"></div>
@endsection

@section('footer')
    @parent
@endsection