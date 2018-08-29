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
    <div style="height: 100px;"></div>
    <div id="dashboard">
        <div style="height: 50px;"></div>
        <h1>MANAGEMENT DASHBOARD</h1>

        <ul class="nav nav-tabs" id="content" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="skills-tab" data-toggle="tab" href="#skills" role="tab" aria-controls="skills" aria-selected="true">skills</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="experiences-tab" data-toggle="tab" href="#experiences" role="tab" aria-controls="experiences" aria-selected="false">experiences</a>
            </li>
        </ul>
        <div class="tab-content" id="content">
            <div class="tab-pane fade show active" id="skills" role="tab" aria-labelledby="skills-tab">
                <div style="height: 30px;"></div>
                <div class="container">
                    @foreach($skills as $skill)
                        <table class="table table-hover table-striped">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">TITLE</th>
                                <th scope="col">DURATION</th>
                                <th scope="col">STATUS</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="clickable-row" data-href="{{ url('/') }}/form/skill/{{ $skill->id }}" data-toggle="tooltip" data-placement="top" title="click to edit">
                                <th scope="row">{{ $skill->id }}</th>
                                <td>{{ $skill->title }}</td>
                                <td>{{ $skill->duration }}</td>
                                <td>{{ $skill->status }}</td>
                            </tr>
                            </tbody>
                        </table>
                    @endforeach
                    <div class="row">
                        <div class="col">
                            <a type="btn" class="btn btn-warning" href="{{ url('/') . '/form/skill' }}">add skill</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="experiences" role="tab" aria-labelledby="experiences-tab">
                <div style="height: 30px;"></div>
                <div class="container">
                    @foreach($experiences as $experience)
                        <table class="table table-hover table-striped">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">TITLE</th>
                                <th scope="col">DURATION</th>
                                <th scope="col">STATUS</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="clickable-row" data-href="{{ url('/') }}/form/experience/{{ $experience->id }}" data-toggle="tooltip" data-placement="top" title="click to edit">
                                <th scope="row">{{ $experience->id }}</th>
                                <td>{{ $experience->title }}</td>
                                <td>{{ $experience->duration }}</td>
                                <td>{{ $experience->status }}</td>
                            </tr>
                            </tbody>
                        </table>
                    @endforeach
                    <div class="row">
                        <div class="col">
                            <a type="btn" class="btn btn-warning" href="{{ url('/') . '/form/experience' }}">add experience</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="height: 100px;"></div>
@endsection

@section('footer')
    @parent
@endsection