@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">{{$title}}
        &nbsp; &nbsp;<a href="{{url('/admin/kids')}}" class="btn btn-primary">Rodyti mano treniruojamų vaikų sąrašą</a></h3>

    @can('kid_create')
        <p>
            <a href="{{ route('admin.kids.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>

        </p>
    @endcan

    @can('kid_delete')
        <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.kids.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('quickadmin.qa_all')</a></li>
            |
            <li><a href="{{ route('admin.kids.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('quickadmin.qa_trash')</a></li>
        </ul>
        </p>
    @endcan


    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($allKids) > 0 ? 'datatable' : '' }} @can('kid_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                <tr>
                    @can('kid_delete')
                        @if ( request('show_deleted') != 1 )
                            <th style="text-align:center;"><input type="checkbox" id="select-all"/></th>@endif
                    @endcan

                    <th>@lang('quickadmin.kids.fields.first-name')</th>
                    <th>@lang('quickadmin.kids.fields.last-name')</th>
                    <th>@lang('quickadmin.kids.fields.year')</th>
                    <th>@lang('quickadmin.kids.fields.sex')</th>
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
                @if (count($allKids) > 0)
                    @foreach ($allKids as $kid)
                        <tr data-entry-id="{{ $kid->id }}">
                            @can('kid_delete')
                                @if ( request('show_deleted') != 1 )
                                    <td></td>@endif
                            @endcan

                            <td field-key='first_name'>{{ $kid->first_name }}</td>
                            <td field-key='last_name'>{{ $kid->last_name }}</td>
                            <td field-key='year'>{{ $kid->year }}</td>
                            <td field-key='sex'>
                                @if ($kid->sex == 'girl')
                                    M
                                @elseif ($kid->sex == 'boy')
                                    V
                                @endif </td>
                            <td field-key='licence'>{{ Form::checkbox("licence", 1, $kid->licence == 1 ? true : false, ["disabled"]) }}</td>
                            <td field-key='user'>{{ $kid->user->name or '' }}</td>
                            <td field-key='club'>{{ $kid->club->title or '' }}</td>
                            @if( request('show_deleted') == 1 )
                                <td>
                                    @can('kid_delete')
                                        {!! Form::open(array(
        'style' => 'display: inline-block;',
        'method' => 'POST',
        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
        'route' => ['admin.kids.restore', $kid->id])) !!}
                                        {!! Form::submit(trans('quickadmin.qa_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                        {!! Form::close() !!}
                                    @endcan
                                    @can('kid_delete')
                                        {!! Form::open(array(
        'style' => 'display: inline-block;',
        'method' => 'DELETE',
        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
        'route' => ['admin.kids.perma_del', $kid->id])) !!}
                                        {!! Form::submit(trans('quickadmin.qa_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                    @endcan
                                </td>
                            @else
                                <td>
                                    @can('kid_view')
                                        <a href="{{ route('admin.kids.show',[$kid->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('kid_edit')
                                        <a href="{{ route('admin.kids.edit',[$kid->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('kid_delete')
                                        {!! Form::open(array(
                                                                                'style' => 'display: inline-block;',
                                                                                'method' => 'DELETE',
                                                                                'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                                                                'route' => ['admin.kids.destroy', $kid->id])) !!}
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
@stop

@section('javascript')
    <script>
        @can('kid_delete')
                @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.kids.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection