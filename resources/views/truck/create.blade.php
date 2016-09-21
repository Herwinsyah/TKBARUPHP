@extends('layouts.adminlte.master')

@section('title')
    @lang('truck.create.title')
@endsection

@section('page_title')
    <span class="fa fa-truck fa-flip-horizontal fa-fw"></span>&nbsp;@lang('truck.create.page_title')
@endsection
@section('page_title_desc')
    @lang('truck.create.page_title_desc')
@endsection

@section('content')
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">@lang('truck.create.header.title')</h3>
        </div>
        <form class="form-horizontal" action="{{ route('db.master.truck.create') }}" method="post">
            {{ csrf_field() }}
            <div class="box-body">
                <div class="form-group {{ $errors->has('plate_number') ? 'has-error' : '' }}">
                    <label for="inputPlateNumber" class="col-sm-2 control-label">@lang('truck.plate_number')</label>
                    <div class="col-sm-10">
                        <input id="plate_number" name="plate_number" type="text" class="form-control" placeholder="@lang('truck.plate_number')">
                        <span class="help-block">{{ $errors->has('plate_number') ? $errors->first('plate_number') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('inspection_date') ? 'has-error' : '' }}">
                    <label for="inputInspectionDate" class="col-sm-2 control-label">@lang('truck.inspection_date')</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="inspection_date" name="inspection_date" placeholder="@lang('truck.inspection_date')">
                        <span class="help-block">{{ $errors->has('inspection_date') ? $errors->first('inspection_date') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('driver') ? 'has-error' : '' }}">
                    <label for="inputDriver" class="col-sm-2 control-label">@lang('truck.driver')</label>
                    <div class="col-sm-10">
                        <input id="driver" name="driver" type="text" class="form-control" placeholder="@lang('truck.driver')">
                        <span class="help-block">{{ $errors->has('driver') ? $errors->first('driver') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                    <label for="inputStatus" class="col-sm-2 control-label">@lang('truck.status')</label>
                    <div class="col-sm-10">
                        {{ Form::select('status', $statusDDL, null, array('class' => 'form-control', 'placeholder' => 'Please Select')) }}
                        <span class="help-block">{{ $errors->has('status') ? $errors->first('status') : '' }}</span>
                    </div>
                </div>
                <div class="form-group {{ $errors->has('remarks') ? 'has-error' : '' }}">
                    <label for="inputRemarks" class="col-sm-2 control-label">@lang('truck.remarks')</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="remarks" name="remarks" placeholder="@lang('truck.remarks')">
                        <span class="help-block">{{ $errors->has('remarks') ? $errors->first('remarks') : '' }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputButton" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                        <a href="{{ route('db.master.truck') }}" class="btn btn-default">@lang('buttons.create.cancel')</a>
                        <button class="btn btn-default" type="submit">@lang('buttons.create.save')</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection