@extends('layouts.adminlte.master')

@section('title')
    @lang('supplier.edit.title')
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
            <h3 class="box-title">@lang('supplier.edit.page')</h3>
        </div>
        <div role="tabpanel">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab-1" data-toggle="tab">@lang('supplier.edit.page.tab-data')</a></li>
                <li><a href="#tab-2" data-toggle="tab">@lang('supplier.edit.page.tab-pic')</a></li>
                <li><a href="#tab-3" data-toggle="tab">@lang('supplier.edit.page.tab-account')</a></li>
                <li><a href="#tab-4" data-toggle="tab">@lang('supplier.edit.page.tab-product')</a></li>
                <li><a href="#tab-5" data-toggle="tab">@lang('supplier.edit.page.tab-setting')</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab-1">
                    {!! Form::model($supplier, ['method' => 'PATCH','route' => ['db.master.supplier.edit', $supplier->id], 'class' => 'form-horizontal']) !!}
                        <div class="box-body">
                            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                <label for="inputSupplierName" class="col-sm-2 control-label">@lang('supplier.edit.label.name')</label>
                                <div class="col-sm-10">
                                    <input id="inputSupplierName" name="name" type="text" class="form-control" value="{{ $supplier->supplier_name }}" placeholder="Supplier Name">
                                    <span class="help-block">{{ $errors->has('name') ? $errors->first('name') : '' }}</span>
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                                <label for="inputAddress" class="col-sm-2 control-label">@lang('supplier.edit.label.address')</label>
                                <div class="col-sm-10">
                                    <textarea id="inputAddress" class="form-control" rows="5" name="address">{{ $supplier->supplier_address }}</textarea>
                                    <span class="help-block">{{ $errors->has('address') ? $errors->first('address') : '' }}</span>
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('city') ? 'has-error' : '' }}">
                                <label for="inputCity" class="col-sm-2 control-label">@lang('supplier.edit.label.city')</label>
                                <div class="col-sm-10">
                                    <textarea id="inputCity" class="form-control" rows="5" name="city">{{ $supplier->supplier_city }}</textarea>
                                    <span class="help-block">{{ $errors->has('city') ? $errors->first('city') : '' }}</span>
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('phone_number') ? 'has-error' : '' }}">
                                <label for="inputPhone" class="col-sm-2 control-label">@lang('supplier.edit.label.phone')</label>
                                <div class="col-sm-10">
                                    <input id="inputPhone" name="phone_number" type="text" class="form-control" value="{{ $supplier->phone_number }}" placeholder="Phone Number">
                                    <span class="help-block">{{ $errors->has('phone_number') ? $errors->first('phone_number') : '' }}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputFax" class="col-sm-2 control-label">Fax</label>
                                <div class="col-sm-10">
                                    <input id="inputFax" name="fax_num" type="text" class="form-control" value="{{ $supplier->fax_num }}" placeholder="Fax">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputTax" class="col-sm-2 control-label">@lang('supplier.edit.label.tax')</label>
                                <div class="col-sm-10">
                                    <input id="inputTax" name="tax_id" type="text" class="form-control" value="{{ $supplier->tax_id }}" placeholder="Tax ID">
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                                <label for="inputStatus" class="col-sm-2 control-label">Status</label>
                                <div class="col-sm-10">
                                {{ Form::select('status', $statusDDL, null, array('class' => 'form-control', 'placeholder' => 'Please Select')) }}
                                    <span class="help-block">{{ $errors->has('status') ? $errors->first('status') : '' }}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputRemarks" class="col-sm-2 control-label">@lang('supplier.edit.label.remarks')</label>
                                <div class="col-sm-10">
                                    <input id="inputRemarks" name="remarks" type="text" class="form-control" value="{{ $supplier->remarks }}" placeholder="Remarks">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputButton" class="col-sm-2 control-label"></label>
                                <div class="col-sm-10">
                                    <a href="{{ route('db.master.supplier') }}" class="btn btn-default">Cancel</a>
                                    <button class="btn btn-default" type="submit">Submit</button>
                                </div>
                            </div>
                        </div>
                    {!! Form::close() !!}
                    <div class="pull-right"></div>
                    <div class="clearfix"></div>
                </div>
                <div class="tab-pane" id="tab-2">
                    <div class="tab-pane active" id="tab-1">
                        <div class="panel-heading text-right">
                            <button class="btn btn-primary" data-toggle="modal" href='#form-modal'><i class="fa fa-plus"></i> @lang('supplier.edit.button.add')</button>
                        </div>
                        <div class="panel">
                            <div class="panel-body">
                                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                    <div class="panel panel-default">
                                        @foreach($pics as $key => $pic)
                                        <div class="panel-heading" role="tab" id="heading{{$pic->id}}">
                                              <h4 class="panel-title">
                                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$pic->id}}" aria-expanded="true" aria-controls="collapse{{$pic->id}}">
                                                        PIC {{ ++$key }} - {{$pic->first_name}} {{$pic->last_name}}
                                                    </a>
                                              </h4>
                                        </div><br>
                                        <div id="collapse{{$pic->id}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                                              <div class="panel-body">
                                                <div class="col-sm-12">
                                                    <div class="box-body">
                                                        <div class="form-group">
                                                            <label for="inputName" class="col-sm-2 control-label">@lang('supplier.edit.label.pic.first-name')</label>
                                                            <div class="col-sm-10">
                                                                <label id="inputId" class="control-label">
                                                                    <span class="control-label-normal">{{ $pic->first_name }}</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputName" class="col-sm-2 control-label">@lang('supplier.edit.label.pic.last-name')</label>
                                                            <div class="col-sm-10">
                                                                <label id="inputId" class="control-label">
                                                                    <span class="control-label-normal">{{ $pic->last_name }}</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputName" class="col-sm-2 control-label">@lang('supplier.edit.label.pic.address')</label>
                                                            <div class="col-sm-10">
                                                                <label id="inputId" class="control-label">
                                                                    <span class="control-label-normal">{{ $pic->address }}</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputName" class="col-sm-2 control-label">@lang('supplier.edit.label.pic.email')</label>
                                                            <div class="col-sm-10">
                                                                <label id="inputId" class="control-label">
                                                                    <span class="control-label-normal">{{ $pic->email }}</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputName" class="col-sm-2 control-label">@lang('supplier.edit.label.pic.phone-list')</label>
                                                            <div class="col-sm-10">
                                                                <a href="{{ route('db.master.supplier.pic.phone.create', $pic->id) }}">
                                                                    <button class="btn btn-primary"><i class="fa fa-plus"></i> @lang('supplier.edit.button.add')</button></a>
                                                                <table class="table datatable-basic table-striped table-bordered">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Provider</th>
                                                                            <th>Number</th>
                                                                            <th>Status</th>
                                                                            <th>Remarks</th>
                                                                            <th>Action</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach($phones as $phone)
                                                                        <tr>
                                                                            @foreach($phone->phone as $item)
                                                                                <tr>
                                                                            <th>{{ $item->provider->name }}</th>
                                                                            <th>{{ $item->number }}</th>
                                                                            <th class="text-center">@lang('lookup.' . $item->status)</th>
                                                                            <th>{{ $item->remarks }}</th>
                                                                            <th class="text-center">
                                                                            <a class="btn btn-xs btn-primary" href=""><span class="fa fa-pencil fa-fw"></span></a>
                                                                            {!! Form::open(['method' => 'DELETE', 'route' => ['db.master.supplier', ], 'style'=>'display:inline'])  !!}
                                                                                <button type="submit" class="btn btn-xs btn-danger"><span class="fa fa-close fa-fw"></span></button>
                                                                            {!! Form::close() !!}
                                                                        </th>
                                                                            <tr>
                                                                            @endforeach
                                                                            </tr>
                                                                            @endforeach
                                                                        
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                              </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pull-right"></div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="tab-pane" id="tab-3">
                    <div class="tab-pane active" id="tab-1">
                        <div class="panel-heading text-right">
                            <button class="btn btn-primary" data-toggle="modal" href='#bank-modal'><i class="fa fa-plus"></i> @lang('supplier.edit.button.add')</button>
                        </div>
                        <div class="panel">
                            <div class="panel-body">
                                <table class="table datatable-basic table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Bank</th>
                                            <th>@lang('supplier.edit.label.bank.account')</th>
                                            <th>@lang('supplier.edit.label.bank.remarks')</th>
                                            <th>Status</th>
                                            <th>@lang('supplier.edit.label.bank.action')</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach( $bank_account as $bank)
                                        <tr>
                                            <th>{{ $bank->bank->name }}</th>
                                            <th>{{ $bank->account_number }}</th>
                                            <th>{{ $bank->remarks }}</th>
                                            @if($bank->status == 1)
                                            <th>Active</th>
                                            @else
                                            <th>Inactive</th>
                                            @endif
                                            <th class="text-center">
                                                <a class="btn btn-xs btn-primary" href="{{ route('db.master.supplier.bank.edit', $bank->id) }}"><span class="fa fa-pencil fa-fw"></span></a>
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['db.master.supplier.bank.delete', $bank->id], 'style'=>'display:inline'])  !!}
                                                    <button type="submit" class="btn btn-xs btn-danger"><span class="fa fa-close fa-fw"></span></button>
                                                {!! Form::close() !!}
                                            </th>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
                <div class="tab-pane" id="tab-4">
                    <div class="tab-pane active" id="tab-1">
                        <div class="panel">
                            <div class="panel-body">
                                <table class="table datatable-basic table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>@lang('supplier.edit.label.product.type')</th>
                                            <th>@lang('supplier.edit.label.product.code')</th>
                                            <th>@lang('supplier.edit.label.product.name')</th>
                                            <th>@lang('supplier.edit.label.product.description')</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach( $products as $product)
                                        <tr>
                                            <th>{{$product->type}}</th>
                                            <th>{{$product->short_code}}</th>
                                            <th>{{$product->name}}</th>
                                            <th>{{$product->description}}</th>
                                            <th class="text-center">@lang('lookup.' . $product->status)</th>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr>
                        <div class="pull-right"></div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="tab-pane" id="tab-5">
                    <div class="tab-pane active" id="tab-1">
                        <div class="panel">
                            <div class="panel-body">
                                <form class="form-horizontal" action="{{ route('db.master.supplier.setting.store')}}" method="post">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="inputDueDay" class="col-sm-2 text-right">@lang('supplier.edit.label.setting.due-day')</label>
                                        <div class="col-sm-9">
                                            <input type="number" name="due_day" class="form-control">
                                            <input type="hidden" class="form-control" name="supplier_id" value="{{ $supplier->id }}">
                                        </div>
                                    </div>
                                    <div class="form-group text-center">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    {{-- modal-list --}}
    <div class="modal fade" id="form-modal">
        <div class="modal-dialog fixed-footer modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="text-left">@lang('supplier.edit.modal.pic.heading')</h4>
                </div>
                <div class="modal-body scroller">
                    <form class="form-horizontal" action="{{ route('db.master.supplier.pic.store', $supplier->id) }}" method="post">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">@lang('supplier.edit.label.pic.first-name')</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="first_name" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">@lang('supplier.edit.label.pic.last-name')</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="last_name" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">@lang('supplier.edit.label.pic.address')</label>
                                    <div class="col-sm-9">
                                        <textarea id="inputAddress" class="form-control" rows="5" name="address"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">@lang('supplier.edit.label.pic.email')</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="email" class="form-control" placeholder="Email">
                                    </div>
                                </div>
                                <input type="hidden" name="id" value="{{ $supplier->id }}">
                                <div class="pull-right">
                                    <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary btn-flat">Send</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="bank-modal">
        <div class="modal-dialog fixed-footer modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="text-left">Add Bank Account</h4>
                </div>
                <div class="modal-body scroller">
                    <form class="form-horizontal" action="{{ route('db.master.supplier.bank.store') }}" method="post">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">@lang('supplier.edit.label.bank.name')</label>
                                    <div class="col-sm-9">
                                        <select name="bank_id" class="form-control">
                                            @foreach($banks as $bank)
                                            <option value="{{$bank->id}}">{{ $bank->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">@lang('supplier.edit.label.bank.account')</label>
                                    <div class="col-sm-9">
                                        <input type="number" name="account" class="form-control" placeholder="Bank Account Number">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">@lang('supplier.edit.label.bank.remarks')</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="remarks" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Status</label>
                                    <div class="col-sm-9">
                                        <select name="status" class="form-control">
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="supplier_id" value="{{ $supplier->id }}">
                        </div>
                        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-flat">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    
@endsection