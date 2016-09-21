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
        <div role="tabpanel">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab-1" data-toggle="tab">Supplier Data</a></li>
                <li><a href="#tab-2" data-toggle="tab">Person In Charge</a></li>
                <li><a href="#tab-3" data-toggle="tab">Bank Account</a></li>
                <li><a href="#tab-4" data-toggle="tab">Product List</a></li>
                <li><a href="#tab-5" data-toggle="tab">Settings</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab-1">
                    {!! Form::model($supplier, ['method' => 'PATCH','route' => ['db.master.supplier.edit', $supplier->id], 'class' => 'form-horizontal']) !!}
                        <div class="box-body">
                            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                <label for="inputSupplierName" class="col-sm-2 control-label">Supplier Name</label>
                                <div class="col-sm-10">
                                    <input id="inputSupplierName" name="name" type="text" class="form-control" value="{{ $supplier->supplier_name }}" placeholder="Supplier Name">
                                    <span class="help-block">{{ $errors->has('name') ? $errors->first('name') : '' }}</span>
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                                <label for="inputAddress" class="col-sm-2 control-label">Address</label>
                                <div class="col-sm-10">
                                    <textarea id="inputAddress" class="form-control" rows="5" name="address">{{ $supplier->supplier_address }}</textarea>
                                    <span class="help-block">{{ $errors->has('address') ? $errors->first('address') : '' }}</span>
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('city') ? 'has-error' : '' }}">
                                <label for="inputCity" class="col-sm-2 control-label">City</label>
                                <div class="col-sm-10">
                                    <textarea id="inputCity" class="form-control" rows="5" name="city">{{ $supplier->supplier_city }}</textarea>
                                    <span class="help-block">{{ $errors->has('city') ? $errors->first('city') : '' }}</span>
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('phone_number') ? 'has-error' : '' }}">
                                <label for="inputPhone" class="col-sm-2 control-label">Phone</label>
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
                                <label for="inputTax" class="col-sm-2 control-label">Tax ID</label>
                                <div class="col-sm-10">
                                    <input id="inputTax" name="tax_id" type="text" class="form-control" value="{{ $supplier->tax_id }}" placeholder="Tax ID">
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
                                <label for="inputStatus" class="col-sm-2 control-label">Status</label>
                                <div class="col-sm-10">
                                @if($supplier->status == 1)
                                    <input type="radio" name="status" value="1" checked> Available<br>
                                    <input type="radio" name="status" value="0"> Unavailable
                                @else
                                    <input type="radio" name="status" value="1"> Available<br>
                                    <input type="radio" name="status" value="0" checked> Unavailable
                                @endif
                                    <span class="help-block">{{ $errors->has('status') ? $errors->first('status') : '' }}</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputRemarks" class="col-sm-2 control-label">Remarks</label>
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
                            <button class="btn btn-primary" data-toggle="modal" href='#form-modal'><i class="fa fa-plus"></i> Add</button>
                            <div class="modal fade" id="form-modal">
                                <div class="modal-dialog fixed-footer modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="text-left">Add PIC</h4>
                                        </div>
                                        <div class="modal-body scroller">
                                            <form class="form-horizontal" action="{{ route('db.master.supplier.pic.store') }}" method="post">
                                                {{ csrf_field() }}
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">First Name</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" name="first_name" class="form-control" placeholder="first name">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">Last Name</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" name="last_name" class="form-control" placeholder="last name">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">Address</label>
                                                            <div class="col-sm-9">
                                                                <textarea id="inputAddress" class="form-control" rows="5" name="address"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">Email</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" name="email" class="form-control" placeholder="Email">
                                                            </div>
                                                        </div>
                                                        <input type="hidden" name="id" value="{{ $supplier->id }}">
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary btn-flat">Send</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                                                            <label for="inputName" class="col-sm-2 control-label">First Name</label>
                                                            <div class="col-sm-10">
                                                                <label id="inputId" class="control-label">
                                                                    <span class="control-label-normal">{{ $pic->first_name }}</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputName" class="col-sm-2 control-label">Last Name</label>
                                                            <div class="col-sm-10">
                                                                <label id="inputId" class="control-label">
                                                                    <span class="control-label-normal">{{ $pic->last_name }}</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputName" class="col-sm-2 control-label">Address</label>
                                                            <div class="col-sm-10">
                                                                <label id="inputId" class="control-label">
                                                                    <span class="control-label-normal">{{ $pic->address }}</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputName" class="col-sm-2 control-label">Email</label>
                                                            <div class="col-sm-10">
                                                                <label id="inputId" class="control-label">
                                                                    <span class="control-label-normal">{{ $pic->email }}</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputName" class="col-sm-2 control-label">Phone List</label>
                                                            <div class="col-sm-10">
                                                                <table class="table datatable-basic table-striped table-bordered">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Provider</th>
                                                                            <th>Number</th>
                                                                            <th>Status</th>
                                                                            <th>Remarks</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <th>19/20/2004</th>
                                                                            <th>Dr. Jumadi</th>
                                                                            <th></th>
                                                                            <th></th>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                                <button class="btn btn-primary" data-toggle="modal" href='#phone-modal'><i class="fa fa-plus"></i> Add</button>
                                                                <div class="modal fade" id="phone-modal">
                                                                    <div class="modal-dialog fixed-footer modal-lg">
                                                                        <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                            <h4 class="text-left">Add Phone List</h4>
                                                                        </div>
                                                                        <div class="modal-body scroller">
                                                                        <form class="form-horizontal" action="{{ route('db.master.supplier.pic.store') }}" method="post">
                                                                            {{ csrf_field() }}
                                                                            <div class="row">
                                                                                <div class="col-sm-12">
                                                                                    <div class="form-group">
                                                                                        <label class="col-sm-2 control-label">Phone</label>
                                                                                        <div class="col-sm-9">
                                                                                            <input type="text" name="first_name" class="form-control" placeholder="first name">
                                                                                        </div>
                                                                                    </div>
                                                                                    <input type="hidden" name="id" value="{{ $supplier->id }}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="text-right">
                                                                            <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                                                                            <button type="submit" class="btn btn-primary btn-flat">Send</button>
                                                                            </div>
                                                                        </form>
                                                                        </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
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
                        <table class="table datatable-basic table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Dokter</th>
                                    <th>Tindakan</th>
                                    <th>Data</th>
                                    <th>Jenis Rawat</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>19/20/2004</th>
                                    <th>Dr. Jumadi</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </tbody>
                        </table>
                        <hr>

                        <div class="pull-left">
                            <button class="btn btn-primary"> Selesai <i class="fa fa-times"></i></button>
                        </div>
                        <div class="pull-right"></div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="tab-pane" id="tab-4">
                    <div class="tab-pane active" id="tab-1">
                        <table class="table datatable-basic table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Type</th>
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>Base Unit</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $products as $product)
                                <tr>
                                    <th>$product->type</th>
                                    <th>$product->code</th>
                                    <th>$product->name</th>
                                    <th>$product->base_unit</th>
                                    <th>$product->description</th>
                                    <th>$product->status</th>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <hr>
                        <div class="pull-right"></div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <div class="tab-pane" id="tab-5">
                    <div class="tab-pane active" id="tab-1">
                        <table class="table datatable-basic table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Type</th>
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>Base Unit</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach( $products as $product)
                                <tr>
                                    <th>$product->type</th>
                                    <th>$product->code</th>
                                    <th>$product->name</th>
                                    <th>$product->base_unit</th>
                                    <th>$product->description</th>
                                    <th>$product->status</th>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <hr>

                        <div class="pull-left">
                            <button class="btn btn-primary"> Selesai <i class="fa fa-times"></i></button>
                        </div>
                        <div class="pull-right"></div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection