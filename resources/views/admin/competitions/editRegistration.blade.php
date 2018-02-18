@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">Registracija į varžybas</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            Pasirinkite vaikus iš sąrašo
        </div>
        <form id="registration" action="{{url('admin/competitions/register')}}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="comp_id" value="{{$competition->id}}">

            <div class="panel-body table-responsive">
                <table class="table table-bordered table-striped ">
                    <thead>
                    <tr>
                        <th></th>
                        <th>@lang('quickadmin.kids.fields.first-name')</th>
                        <th>@lang('quickadmin.kids.fields.last-name')</th>
                        <th>@lang('quickadmin.kids.fields.licence')</th>
                    </tr>
                    </thead>

                    <tbody>
                    @if (count($kids) > 0)
                        @foreach ($kids as $kid)
                            @if (!in_array($kid->id, $kidIds))
                                <tr data-entry-id="{{ $kid->id }}">
                                    <td style="text-align:center;">
                                        <input type="checkbox" id="select-id" name="kids[]" value="{{$kid->id}}"/></td>
                                    <td field-key='first_name'>{{ $kid->first_name }}</td>
                                    <td field-key='last_name'>{{ $kid->last_name }}</td>
                                    <td field-key='licence'>{{ Form::checkbox("licence", 1, $kid->licence == 1 ? true : false, ["disabled"]) }}</td>
                                </tr>
                            @endif
                        @endforeach
                    @else
                        <tr>
                            <td colspan="13">Pirmiausia pridėkite savo treniruojamus vaikus meniu skyriuje "Vaikai"</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
                <button type="submit" class="btn btn-success">Registruoti</button>
            </div>
        </form>
    </div>
@stop

@section('javascript')
    <script>
        @can('kid_delete')
                @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.kids.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection