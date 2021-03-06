@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.groups.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.groups.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('title', trans('quickadmin.groups.fields.title').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('title'))
                        <p class="help-block">
                            {{ $errors->first('title') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('year_from', trans('Gimimo metai nuo: ').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('year_from', old('year_from'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('year_from'))
                        <p class="help-block">
                            {{ $errors->first('year_from') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('year_to', trans('Gimimo metai iki: ').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('year_to', old('year_to'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('year_to'))
                        <p class="help-block">
                            {{ $errors->first('year_to') }}
                        </p>
                    @endif
                </div>
            </div>

            
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

