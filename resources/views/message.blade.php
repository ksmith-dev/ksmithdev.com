@extends('layouts.app')

@section('head')
    @parent
@endsection

@section('navigation')
    @parent
@endsection

@section('content')
    <div style="height: 100px;"></div>
    <div id="message">
        <div style="height: 50px;"></div>
        <div class="row">
            <div class="col">
                <h2>{{ $message['title'] }}</h2>
                <hr>
                <h5>{{ $message['heading'] }}</h5>
                <p>{{ $message['message'] }}</p>
                <h5>{{ $message['closing'] }}<br><i>{{ $message['from'] }}</i></h5>
            </div>
        </div>
        <div style="height: 50px;"></div>
    </div>
    <div style="height: 100px;"></div>
@endsection

@section('footer')
    @parent
@endsection