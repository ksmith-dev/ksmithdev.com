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
    <div style="height: 50px"></div>
    <div id="form-div">
        <div class="row">
            <div class="col">
                @if(isset($model))
                    <form id="form" method="post" action="{{ url( 'form/' . $inputs[0]->table . '/' . $model->id ) }}" novalidate>
                @else
                    <form id="form" method="post" action="{{ url( 'form/' . $inputs[0]->table ) }}" novalidate>
                @endif
                    {{ csrf_field() }}
                    @foreach($inputs as $input)
                        @if($input->protected == 0)
                            <div class="form-group">
                                <label for="{{ str_replace('_', ' ', $input->column) }}">{{ __( preg_replace('/[0-9]+/', '', str_replace('_', ' ', $input->column)) ) }}</label><br>
                                @switch($input->type)
                                    @case('textarea')
                                    <textarea
                                            id="{{ $input->column }}"
                                            type="{{ $input->type }}"
                                            class="form-control{{ $errors->has( $input->column ) ? ' is-invalid' : '' }}"
                                            name="{{ $input->column }}"
                                    @if (isset($attributes[$input->column]))
                                        @foreach ($attributes[$input->column] as $key => $value)
                                            @if (empty($value))
                                                {{ $key }}
                                            @else
                                                {{ $key }}="{{ $value }}"
                                            @endif
                                        @endforeach
                                    @endif
                                    >@if (isset($input->value) || old($input->column)){{ $input->value or old($input->column) }}@endif</textarea>
                                    @break

                                    @case('select')
                                    @if(isset($options[$input->column]))
                                        <select
                                                id="{{ $input->column }}"
                                                type="{{ $input->type }}"
                                                class="form-control"
                                                name="{{ $input->column }}">
                                            @if(!isset($input->value) || !old($input->column))
                                                <option selected disabled>Choose...</option>
                                            @endif
                                            @foreach($options[$input->column] as $key => $value)
                                                @if(is_array($value))
                                                    @foreach($value[0] as $inner_key => $inner_value)
                                                        @if(isset($input->value) && $inner_key === $input->value || $inner_key === old($input->column) )
                                                            <option value="{{ $key }}_{{ $inner_key }}" selected>{{ $inner_value }}</option>
                                                        @else
                                                            <option value="{{ $key }}_{{ $inner_key }}">{{ $inner_value }}</option>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    @if(isset($input->value) && $key === $input->value || $key === old($input->column) )
                                                        <option value="{{ $key }}" selected>{{ $value }}</option>
                                                    @else
                                                        <option value="{{ $key }}">{{ $value }}</option>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </select>
                                    @endif
                                    @if(isset($input->detail_type))
                                        <input type="hidden" id="type" name="type" value="{{ $input->detail_type }}">
                                    @endif
                                    @break

                                    @case('radio')
                                    @if(isset($options[$input->column]))
                                        @foreach($options[$input->column] as $key => $value)
                                            @if(isset($input->value) && $key === $input->value || $key === old($input->column))
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label">
                                                        <input
                                                                id="{{ $key }}"
                                                                type="{{ $input->type }}"
                                                                class="form-check-input"
                                                                name="{{ $input->column }}"
                                                                value="{{ $key }}"
                                                                checked>
                                                        {{ $value }}
                                                    </label>
                                                </div>
                                            @else
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label">
                                                        <input
                                                                id="{{ $key }}"
                                                                type="{{ $input->type }}"
                                                                class="form-check-input"
                                                                name="{{ $input->column }}"
                                                                value="{{ $key }}">
                                                        {{ $value }}
                                                    </label>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                    @break

                                    @case('checkbox')
                                    @if(isset($options[$input->column]))
                                        @foreach($options[$input->column] as $key => $value)
                                            @if(isset($input->value) && $key === $input->value || $key === old($input->column))
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label">
                                                        <input
                                                                id="{{ $key }}"
                                                                type="{{ $input->type }}"
                                                                class="form-check-input"
                                                                name="{{ $input->column }}[{{$key}}]"
                                                                value="{{ $value }}"
                                                                checked>
                                                        {{ $value }}
                                                    </label>
                                                </div>
                                            @else
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input
                                                                id="{{ $key }}"
                                                                type="{{ $input->type }}"
                                                                class="form-check-input"
                                                                name="{{ $input->column }}[{{$key}}]"
                                                                value="{{ $value }}">
                                                        {{ $value }}
                                                    </label>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                    @break

                                    @default
                                    <input
                                            id="{{ $input->column }}"
                                            type="{{ $input->type }}"
                                            class="form-control" name="{{ $input->column }}"
                                            @if (isset($input->aria_described_by))
                                                aria-describedby="{{ $input->aria_described_by }}"
                                            @endif
                                            @if (isset($input->value) || old($input->column))
                                                value="{{ $input->value or old($input->column) }}"
                                            @endif
                                            @if (isset($attributes[$input->column]))
                                                @foreach ($attributes[$input->column] as $key => $value)
                                                    @if (empty($value))
                                                        {{ $key }}
                                                    @else
                                                        {{ $key }} ="{{ $value }}"
                                                    @endif
                                                @endforeach
                                            @endif >
                                    @break
                                @endswitch
                            </div>
                        @endif
                    @endforeach
                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-warning">Submit</button>
                        </div>
                        <div class="col">
                            <a class="btn btn-warning" href="{{ URL::previous() }}" role="button">Cancel</a>
                        </div>
                        <div class="col"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div style="height: 50px"></div>
@endsection

@section('footer')
    @parent
        <script src="{{ asset('js/validation.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/form.js') }}" type="text/javascript"></script>
@endsection