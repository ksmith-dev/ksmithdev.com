@extends('layouts.app')

@section('head')
    @parent
@endsection

@section('navigation')
    @parent
@endsection

@section('content')
    <div style="height: 100px;"></div>
    <div id="search">
        <h1>Search Results</h1>
        <div style="height: 30px;"></div>
        @if($skills->count() > 0)
            <h4>SKILLS - RESULTS</h4>
            <table class="table table-hover">
                <thead>
                <tr>
                    @foreach($skill_columns as $column)
                        @if(!in_array($column, $protected))
                            @if($column == 'title')
                                <th scope="col">{{ $column }}</th>
                            @else
                                <th scope="col" class="text-center">{{ $column }}</th>
                            @endif
                        @endif
                    @endforeach
                </tr>
                </thead>
                <tbody>
                @foreach($skills as $skill)
                    @if($skill->status == 'active')
                        <tr class="clickable-row" data-href="skill/#skill_{{ $skill->id }}" data-toggle="tooltip" data-placement="top" title="click to view">
                    @else
                        <tr class="clickable-row" data-href="/skill/inactive/#skill_{{ $skill->id }}" data-toggle="tooltip" data-placement="top" title="click to view">
                    @endif
                        @foreach($skill_columns as $column)
                            @if(!in_array($column, $protected))
                                @if($column == 'title')
                                    <td>{{ $skill->$column }}</td>
                                @elseif ($column == 'tasks')
                                    <td>
                                        <ul style="list-style: none;">
                                            @foreach($skill->$column as $key => $task)
                                                <li>{{ $task }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                @else
                                    <td class="text-center">{{ $skill->$column }}</td>
                                @endif
                            @endif
                        @endforeach
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <h6>no skill - results where found, try a different search term...</h6>
            <br>
        @endif

        @if($experiences->count() > 0)
            <div style="height: 30px;"></div>
            <h4>EXPERIENCE - RESULTS</h4>
            <table class="table table-hover">
                <thead>
                <tr>
                    @foreach($experience_columns as $column)
                        @if(!in_array($column, $protected))
                            @if($column == 'title' || $column == 'company_name' || $column == 'city')
                                <th scope="col">{{ str_replace('_', ' ', $column) }}</th>
                            @elseif ($column == 'tasks')
                            @else
                                <th scope="col" class="text-center">{{ str_replace('_', ' ', $column) }}</th>
                            @endif
                        @endif
                    @endforeach
                </tr>
                </thead>
                <tbody>
                @foreach($experiences as $experience)
                    @if(strtotime($experience->end_date) > strtotime('-7 years'))
                        <tr class="clickable-row" data-href="/experience/#experience_{{ $experience->id }}" data-toggle="tooltip" data-placement="top" title="click to view">
                    @else
                        <tr class="clickable-row" data-href="/experience/inactive/#experience_{{ $experience->id }}" data-toggle="tooltip" data-placement="top" title="click to view">
                    @endif
                        @foreach($experience_columns as $column)
                            @if(!in_array($column, $protected))
                                @if($column == 'title' || $column == 'company_name' || $column == 'city')
                                    <td>{{ $experience->$column }}</td>
                                @elseif ($column == 'tasks')
                                @else
                                    <td class="text-center">{{ $experience->$column }}</td>
                                @endif
                            @endif
                        @endforeach
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <h6>no experience - results where found, try a different search term...</h6>
            <br>
        @endif
        <div style="height: 30px;"></div>
    </div>
    <div style="height: 100px;"></div>
    <script>
        $(".clickable-row").click(function() {
            window.location = $(this).data("href");
        });
    </script>
@endsection

@section('footer')
    @parent
@endsection