@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.competitions.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">

        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.competitions.fields.title')</th>
                            <td field-key='title'>{{ $competition->title }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.competitions.fields.date')</th>
                            <td field-key='date'>{{ $competition->date }}</td>
                        </tr>
                        {{--<tr>--}}
                        {{--<th rowspan = {{$groupsCount}}>Grupės</th>--}}
                        {{--</tr>--}}
                        {{--@foreach($competition->groups as $group)--}}
                        {{--<tr>--}}

                        {{--<td field-key='groups'>--}}

                        {{--{{$group->title}}</td>--}}

                        {{--</tr>--}}
                        {{--@endforeach--}}
                    </table>
                </div>
            </div>
        </div>
    </div>

        <p>
            <a href="{{url('/admin/competitions/' . $competition->id )}}" class="btn btn-primary">Rodyti tik mano užregistruotus vaikus</a>
            <a href="#" class="btn btn-success">Parsisiųsti Excel failą</a>
        </p>

    <div class="panel panel-default">
        <div class="panel-heading">
            Visi vaikai:
        </div>

        <div class="panel-body table-responsive">

            <table class="table table-bordered table-striped ">
                <thead>
                <tr>
                    <th>@lang('quickadmin.kids.fields.first-name')</th>
                    <th>@lang('quickadmin.kids.fields.last-name')</th>
                    <th>@lang('quickadmin.kids.fields.licence')</th>
                    <th> </th>
                    <th></th>
                </tr>
                </thead>

                <tbody>
                @if (count($kids) > 0)
                    @foreach($groups as $group)
                        <tr>
                            <td colspan="4" style="text-align:center; background-color: lightgrey">{{$group->title}}</td>
                        </tr>
                        @foreach ($kids as $kid)
                            @if ($kid->group == $group)
                                <tr data-entry-id="{{ $kid->id }}">
                                    <td field-key='first_name'>{{ $kid->first_name }}</td>
                                    <td field-key='last_name'>{{ $kid->last_name }}</td>
                                    <td field-key='licence'>{{ Form::checkbox("licence", 1, $kid->licence == 1 ? true : false, ["disabled"]) }}</td>
                                    <td>
                                        @can('kid_edit')
                                            <a href="{{ route('admin.kids.edit',[$kid->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                        @endcan
                                        @can('kid_delete')
                                            {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                            'url' => 'admin/competitions/' . $competition->id . '/destroyregistration/' . $kid->id )) !!}
                                            {!! Form::submit(trans('Išregistruoti'), array('class' => 'btn btn-xs btn-danger')) !!}
                                            {!! Form::close() !!}
                                        @endcan
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    @endforeach
                @else
                    <tr>
                        <td colspan="13">Kol kas užregistruotų vaikų nėra.</td>
                    </tr>
                @endif

                </tbody>
            </table>
        </div>

        <p>&nbsp;</p>
    </div>
    <a href="{{ route('admin.competitions.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a> &nbsp;


@stop
