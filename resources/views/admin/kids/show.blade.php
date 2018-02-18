@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.kids.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.kids.fields.first-name')</th>
                            <td field-key='first_name'>{{ $kid->first_name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.kids.fields.last-name')</th>
                            <td field-key='last_name'>{{ $kid->last_name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.kids.fields.year')</th>
                            <td field-key='year'>{{ $kid->year }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.kids.fields.sex')</th>
                            <td field-key='sex'>{{ $kid->sex }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.kids.fields.group')</th>
                            <td field-key='group'>{{ $kid->group->title or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.kids.fields.licence')</th>
                            <td field-key='licence'>{{ Form::checkbox("licence", 1, $kid->licence == 1 ? true : false, ["disabled"]) }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.kids.fields.coach')</th>
                            <td field-key='coach'>{{ $kid->coach->name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.kids.fields.club')</th>
                            <td field-key='club'>{{ $kid->club->title or '' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.kids.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop
