@extends('layouts.app')

@section('head')
    @parent
@endsection

@section('navigation')
    @parent
@endsection

@section('content')
    <div style="height: 100px"></div>
    @if(isset($skills) && $skills->count() > 0)
        <div id="skill">
        @foreach($skills as $skill)
            <div id="skill_{{ $skill->id }}" class="skill">
                <div class="row">
                    <div class="col">
                        <img src="{{ $skill->img_path }}" class="skill-img">
                    </div>
                    <div class="col">
                        <h3 class="text-center">{{ strtoupper($skill->title) }}</h3>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col">
                        <ul>
                            @foreach($skill->tasks as $key => $task)
                                <li>{{ $task }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col">
                        <span class="skill-duration">
                            <img src="{{ asset('img/icon/calendar.png') }}">
                            <h6>{{ $skill->duration }} years</h6>
                        </span>

                    </div>
                </div>
                @if($skill->status == 'inactive')
                    <h4><b>status: {{ $skill->status }}</b></h4>
                @endif
            </div>
        @endforeach
        </div>
    @endif
    <div style="height: 100px;"></div>
    <div id="education">
        <h2>Education</h2>
        <hr>
        <div class="row">
            <div class="col">
                <h4>Green River College</h4>
                <h6>From 2015 to 2018</h6>
                <p>Bachelor of Applied Science (B.A.S.)<br>Computer Software Engineering - GPA 3.61</p>
            </div>
            <div class="w-100 d-xs-block d-sm-none"></div>
            <div class="col">
                <h4>Sanford Brown College</h4>
                <h6>From 2014 to 2015</h6>
                <p>Associate of Arts and Sciences (A.A.S.)<br>Web Page, Digital / Multimedia and Information Resources Design - GPA 4.0</p>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <h4>Renton Technical College</h4>
                <h6>From 1997 to 1998</h6>
                <p>Certificate of Completion<br>AutoCAD / Drafting Training Course - GPA 3.8</p>
            </div>
        </div>
    </div>
    <div id="accomplishments">
        <h2>Accomplishments</h2>
        <hr>
        <div class="row">
            <div class="col">
                <h4>Phi Theta Kappa - Honor Society</h4>
                <h6>Membership Began - June 2017</h6>
                <p>Awarded membership due to my honor status with a G.P.A. of 3.61</p>
            </div>
            <div class="w-100 d-xs-block d-sm-none"></div>
            <div class="col">
                <h4>Scholarship Recipient</h4>
                <h6>Beneficiary - 2016 through 2017</h6>
                <p>S.T.E.M. - National Science Foundation Technology</p>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <h4>High Honors</h4>
                <h6>Awarded by Director of Education - July 2014 & 2015</h6>
                <p>Achieved the Highest Scholastic Standard @ Sanford Brown College Seattle, WA</p>
            </div>
            <div class="w-100 d-xs-block d-sm-none"></div>
            <div class="col">
                <h4>Perfect Attendance</h4>
                <h6>Awarded by Director of Education - July 2014 & 2015</h6>
                <p>Achieved perfect attendance @ Sanford Brown College Seattle, WA.</p>
            </div>
        </div>
    </div>
    <div style="height: 100px;"></div>
@endsection

@section('footer')
    @parent
@endsection