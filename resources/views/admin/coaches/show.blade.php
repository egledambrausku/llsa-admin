@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.coaches.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.coaches.fields.name')</th>
                            <td field-key='name'>{{ $coach->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.coaches.fields.club')</th>
                            <td field-key='club'>{{ $coach->club->title or '' }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#kids" aria-controls="kids" role="tab" data-toggle="tab">Vaikai</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="kids">
<table class="table table-bordered table-striped {{ count($kids) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('quickadmin.kids.fields.first-name')</th>
                        <th>@lang('quickadmin.kids.fields.last-name')</th>
                        <th>@lang('quickadmin.kids.fields.year')</th>
                        <th>@lang('quickadmin.kids.fields.sex')</th>
                        <th>@lang('quickadmin.kids.fields.group')</th>
                        <th>@lang('quickadmin.kids.fields.licence')</th>
                        <th>@lang('quickadmin.kids.fields.coach')</th>
                        <th>@lang('quickadmin.kids.fields.club')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($kids) > 0)
            @foreach ($kids as $kid)
                <tr data-entry-id="{{ $kid->id }}">
                    <td field-key='first_name'>{{ $kid->first_name }}</td>
                                <td field-key='last_name'>{{ $kid->last_name }}</td>
                                <td field-key='year'>{{ $kid->year }}</td>
                                <td field-key='sex'>{{ $kid->sex }}</td>
                                <td field-key='group'>{{ $kid->group->title or '' }}</td>
                                <td field-key='licence'>{{ Form::checkbox("licence", 1, $kid->licence == 1 ? true : false, ["disabled"]) }}</td>
                                <td field-key='coach'>{{ $kid->coach->name or '' }}</td>
                                <td field-key='club'>{{ $kid->club->title or '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    @can('delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['kids.restore', $kid->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                    @can('delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['kids.perma_del', $kid->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                </td>
                                @else
                                <td>
                                    @can('view')
                                    <a href="{{ route('kids.show',[$kid->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('edit')
                                    <a href="{{ route('kids.edit',[$kid->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['kids.destroy', $kid->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="13">@lang('quickadmin.qa_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.coaches.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop
