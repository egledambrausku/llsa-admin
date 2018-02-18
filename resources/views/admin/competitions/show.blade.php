@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.competitions.title')</h3>
    @if ($user->role_id == 1)
        <p>
            <a href="{{url('/admin/competitions/' . $competition->id . '/allkids' )}}" class="btn btn-primary">Rodyti visus užregistruotus vaikus</a>
        </p>
    @endif
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
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            Užregistruoti mano treniruojami vaikai:
        </div>

        <div class="panel-body table-responsive">

            <table class="table table-bordered table-striped ">
                <thead>
                <tr>
                    <th>@lang('quickadmin.kids.fields.first-name')</th>
                    <th>@lang('quickadmin.kids.fields.last-name')</th>
                    <th>@lang('quickadmin.kids.fields.licence')</th>
                    <th>Grupė</th>
                    <th></th>
                </tr>
                </thead>

                <tbody>
                @if (count($kids) > 0)
                    @foreach ($kids as $kid)
                        <tr data-entry-id="{{ $kid->id }}">
                            <td field-key='first_name'>{{ $kid->first_name }}</td>
                            <td field-key='last_name'>{{ $kid->last_name }}</td>
                            <td field-key='licence'>{{ Form::checkbox("licence", 1, $kid->licence == 1 ? true : false, ["disabled"]) }}</td>

                            <td field-key='group'>
                                @foreach($groups as $group)
                                    @if($kid->year >= $group->year_from && $kid->year <= $group->year_to)
                                        {{$group->title}}
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                @can('kid_edit')
                                    <button id="myBtn" class="btn btn-xs btn-info">Keisti grupę</button>
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
    @if (count($kids) > 0)
        <a href="{{url('/admin/competitions/' . $competition->id . '/register')}}" class="btn btn-success">Registruoti daugiau vaikų</a>
    @else
        <a href="{{url('/admin/competitions/' . $competition->id . '/register')}}" class="btn btn-success">Registruoti vaikus</a>

    @endif
    <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <p>Pasirinkite grupę:</p>
            {{--{!! Form::open(['method' => 'POST', 'action' => url('admin/competitions/register')]) !!}--}}
            {!! Form::label('group_id', trans('Grupė').'', ['class' => 'control-label']) !!}
            {!! Form::select('group_id', $myGroups, old('group_id'), ['class' => 'form-control select2']) !!}
            {!! Form::submit(trans('Išsaugoti'), ['class' => 'btn btn-success']) !!}
            {!! Form::close() !!}
        </div>

    </div>

@stop

@section('javascript')
    <script>
                @can('kid_edit')

        var btn = document.getElementById('myBtn');
        var modal = document.getElementById('myModal');
        var span = document.getElementsByClassName("close")[0];
        btn.onclick = function () {
            modal.style.display = "block";
        };

        span.onclick = function () {
            modal.style.display = "none";
        };

        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        };


        @endcan

    </script>
@endsection
