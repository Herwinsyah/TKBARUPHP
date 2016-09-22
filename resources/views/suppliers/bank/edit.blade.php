@extends('layouts.adminlte.master')

@section('title')
    @lang('supplier.index.title')
@endsection

@section('page_title')
    <span class="fa fa-umbrella fa-fw"></span>&nbsp;@lang('supplier.index.page_title')
@endsection
@section('page_title_desc')
    @lang('supplier.index.page_title_desc')
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
            <h3 class="box-title">Edit Supplier</h3>
        </div>
        {!! Form::model($supplier_bank, ['method' => 'PATCH','route' => ['db.master.supplier.bank.update', $supplier_bank->id], 'class' => 'form-horizontal']) !!}
        <div class="box-body">
            <div class="form-group {{ $errors->has('bank') ? 'has-error' : '' }}">
                <label for="inputBankName" class="col-sm-2 control-label">Bank Name</label>
                <div class="col-sm-10">
                    <select id="inputBank" name="bank_id" class="form-control">
	                    @foreach($banks as $bank)
							<option value="{{ $bank->id }}">{{ $bank->name }}</option>
	                    @endforeach
                    </select>
                    <span class="help-block">{{ $errors->has('bank') ? $errors->first('bank') : '' }}</span>
                </div>
            </div>
            <div class="form-group {{ $errors->has('account') ? 'has-error' : '' }}">
                <label for="inputAccount" class="col-sm-2 control-label">Account</label>
                <div class="col-sm-10">
                    <input id="inputAccount" class="form-control" rows="5" name="account" value="{{ $supplier_bank->account }}">
                    <span class="help-block">{{ $errors->has('account') ? $errors->first('account') : '' }}</span>
                </div>
            </div>
			<div class="form-group {{ $errors->has('remarks') ? 'has-error' : '' }}">
                <label for="inputremarks" class="col-sm-2 control-label">Remarks</label>
                <div class="col-sm-10">
                    <input id="inputRemarks" class="form-control" rows="5" name="remarks" value="{{ $supplier_bank->remarks }}">
                    <span class="help-block">{{ $errors->has('remarks') ? $errors->first('remarks') : '' }}</span>
                </div>
            </div>
            <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                <label for="inputstatus" class="col-sm-2 control-label">Status</label>
                <div class="col-sm-10">
                    <select id="inputStatus" name="status" class="form-control">
                    	@if($supplier_bank->status == 1)
                    		<option value="1" selected>Active</option>
                    		<option value="0">Inactive</option>
                    	@else
                    		<option value="1" selected>Active</option>
                    		<option value="0" selected>Inactive</option>
                    	@endif
                    </select>
                    <span class="help-block">{{ $errors->has('status') ? $errors->first('status') : '' }}</span>
                </div>
            </div>
            <div class="form-group">
                <label for="inputButton" class="col-sm-2 control-label"></label>
                <div class="col-sm-10">
                    <button class="btn btn-default" type="submit">Submit</button>
                </div>
            </div>
        </div>
		{!! Form::close() !!}
	</div>
@endsection