@extends('layouts.app')

@section('head')
    @parent
@endsection

@section('navigation')
    @parent
@endsection

@section('content')
    <div style="height: 100px"></div>
    @if(isset($experiences) && $experiences->count() > 0)
        <div id="experience">
            @foreach($experiences as $experience)
                @if(strtotime($experience->end_dt) < strtotime('-7 years'))
                    <div id="experience_{{ $experience->id }}" class="experience">
                        <div class="row">
                            <div class="col">
                                <img src="{{ $experience->img_path }}" class="company-logo">
                                <h1>{{ $experience->title }}</h1>
                                <h2>{{ $experience->company_name }}</h2>
                                <h4>{{ $experience->city }}, {{ $experience->state }}</h4>
                                <span class="duration">{{ date('Y', strtotime($experience->start_date)) }} to {{ date('Y', strtotime($experience->end_date)) }}</span>
                                <hr>
                                experience:
                                <ul class="tasks">
                                    @foreach($experience->tasks as $key => $task)
                                        <li>{{ $task }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @if($experience->status == 'inactive')
                            <h4>status: {{ $experience->status }}</h4>
                        @endif
                    </div>
                @endif
            @endforeach
        </div>
    @endif
    <div style="height: 100px;"></div>
    <div id="recommendations">
        <h2>References</h2>
        <hr>
        <div class="row">
            <div class="col">
                <h4>Jason Zeringue</h4>
                <h6>Instructor - Sanford Brown College</h6>
                <p>September 18, 2015</p>
                <p>Kevin Smith has been a student of mind at Sanford Brown College, I have been teaching and producing web content in the industry for more than 10 years, Kevin has shown initiative and drive while attending school here at Sanford Brown. His use of best practices involving HTML, CSS and other web technologies have grown considerably. I recommend Kevin for any organization due to his drive and willingness to learn, engage and get the job completed with a high degree of quality.</p>
                <p>Jason Zerinque</p>
                <a href="{{ asset('pdf/j_zeringue_recommendation.pdf') }}" target="_blank"><img src="{{ asset('img/icon/pdf.svg') }}" style="width: 50px;"></a>
            </div>
            <div class="w-100 d-xs-block d-sm-none"></div>
            <div class="col">
                <h4>Kevin Gabbert</h4>
                <h6>Instructor - Sanford Brown College</h6>
                <p>To whom it may concern,</p>
                <p>Kevin Smith, solves difficult problems and finds solutions that are efficent as well as easty to expand upon and modify. When faced with a situation where he has little information and needs to solve a difficult problem he immerses himself in research and testing until he finds a solution, then goes back and improves upon that solution unti it meets his high standars. I have no doubt that Kevin will be a valuable asset to any organization he works with.</p>
                <p>Sincerely</p>
                <p>Kevin Gabbert</p>
                <a href="{{ asset('pdf/kgabbert_reference.pdf') }}" target="_blank"><img src="{{ asset('img/icon/pdf.svg') }}" style="width: 50px;"></a>
            </div>
        </div>
    </div>
    <div style="height: 100px;"></div>
@endsection

@section('footer')
    @parent
@endsection