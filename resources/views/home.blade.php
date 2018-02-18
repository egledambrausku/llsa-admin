@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">{{$title}}</div>

                <div class="panel-body table-responsive">
                    <table class="table table-bordered table-striped ajaxTable">
                        <thead>
                        <tr>

                            <th> @lang('quickadmin.kids.fields.first-name')</th>
                            <th> @lang('quickadmin.kids.fields.last-name')</th>
                            <th> @lang('quickadmin.kids.fields.year')</th>
                            <th> @lang('quickadmin.kids.fields.licence')</th>
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        @foreach($kids as $kid)
                            <tr>

                                <td>{{ $kid->first_name }} </td>
                                <td>{{ $kid->last_name }} </td>
                                <td>{{ $kid->year }} </td>
                                <td>
                                    @if ($kid->licence == 0)
                                        Ne
                                    @elseif ($kid->licence == 1)
                                        Taip
                                    @endif
                                </td>
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
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Artimiausios varžybos</div>

                <div class="panel-body table-responsive">
                    <table class="table table-bordered table-striped ajaxTable">
                        <thead>
                        <tr>

                            <th> @lang('quickadmin.competitions.fields.title')</th>
                            <th> @lang('quickadmin.competitions.fields.date')</th>
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        @foreach($competitions as $competition)
                            <tr>

                                <td>{{ $competition->title }} </td>
                                <td>{{ $competition->date }} </td>
                                <td>
                                        <a href="{{ url('/admin/competitions/' . $competition->id . '/register') }}" class="btn btn-xs btn-success">Registruoti</a>
                                    @can('competition_view')
                                        <a href="{{ route('admin.competitions.show',[$competition->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan

                                    @can('competition_edit')
                                        <a href="{{ route('admin.competitions.edit',[$competition->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan

                                    @can('competition_delete')
                                        {!! Form::open(array(
                                                                                'style' => 'display: inline-block;',
                                                                                'method' => 'DELETE',
                                                                                'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                                                                'route' => ['admin.competitions.destroy', $competition->id])) !!}
                                        {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                    @endcan

                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>


    </div>
@endsection

