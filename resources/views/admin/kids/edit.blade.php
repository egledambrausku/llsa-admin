@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.kids.title')</h3>
    
    {!! Form::model($kid, ['method' => 'PUT', 'route' => ['admin.kids.update', $kid->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('first_name', trans('quickadmin.kids.fields.first-name').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('first_name', old('first_name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('first_name'))
                        <p class="help-block">
                            {{ $errors->first('first_name') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('last_name', trans('quickadmin.kids.fields.last-name').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('last_name', old('last_name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('last_name'))
                        <p class="help-block">
                            {{ $errors->first('last_name') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('year', trans('quickadmin.kids.fields.year').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('year', old('year'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('year'))
                        <p class="help-block">
                            {{ $errors->first('year') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('sex', trans('quickadmin.kids.fields.sex').'*', ['class' => 'control-label']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('sex'))
                        <p class="help-block">
                            {{ $errors->first('sex') }}
                        </p>
                    @endif
                    <div>
                        <label>
                            {!! Form::radio('sex', 'girl', false, ['required' => '']) !!}
                            Mergaitė/mergina
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('sex', 'boy', false, ['required' => '']) !!}
                            Berniukas/vaikinas
                        </label>
                    </div>
                    
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('licence', trans('quickadmin.kids.fields.licence').'*', ['class' => 'control-label']) !!}
                    {!! Form::hidden('licence', 0) !!}
                    {!! Form::checkbox('licence', 1, old('licence'), ['required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('licence'))
                        <p class="help-block">
                            {{ $errors->first('licence') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('ifsc_licence', trans('Turi IFSC licenciją').'*', ['class' => 'control-label']) !!}
                    {!! Form::hidden('ifsc_licence', 0) !!}
                    {!! Form::checkbox('ifsc_licence', 1, old('ifsc_licence')) !!}
                    <p class="help-block"></p>
                    @if($errors->has('ifsc_licence'))
                        <p class="help-block">
                            {{ $errors->first('ifsc_licence') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

