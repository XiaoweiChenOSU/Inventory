@extends('layouts.home')

@section('content')

<section class="content-header">
    <h1>
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Kit</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Edit Kit</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                            <i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <form class="form-horizontal create_kit" role="form" method="POST" action="{{ url('/kit/update/'.$kits_details->id) }}">

                        {{ csrf_field() }}

                        <div class="box-body">

                            <div class="row">

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Kit Code</label><br>
                                        <input type="text" class="form-control" name="kit_code" placeholder="Kit Code" value="{{ $kits_details->kit_code }}">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Kit SKU</label><br>
                                        <input type="text" class="form-control" name="kit_sku" placeholder="Kit SKU" value="{{ $kits_details->kit_sku }}">
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Kit Title</label><br>
                                        <input type="text" class="form-control" name="kit_title" placeholder="Kit Title" value="{{ $kits_details->kit_title }}">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Quantity Sync</label><br>
                                        @if($kits_details->quantity_sync == "on")
                                        <input type="checkbox" name="status_id"  value="{{ $kits_details->quantity_sync }}" checked>
                                        @else
                                        <input type="checkbox" name="status_id"  value="{{ $kits_details->quantity_sync }}">
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Statuses</label>
                                        <select class="form-control change_status_name" name="status_id">
                                            <option selected="" disabled="" value="">- Select - </option>

                                            @if($kits_details->status_id == 0)
                                            <option value="0" selected="">- No attributes -</option>
                                            @else
                                            <option value="0">- No attributes -</option>    
                                            @endif 

                                            @foreach($status_details as $key1 => $value1)

                                            @if($kits_details->status_id == $key1)
                                            <option value="{{ $key1 }}" selected="">{{ $value1 }}</option>
                                            @else  
                                            <option value="{{ $key1 }}">{{ $value1 }}</option>
                                            @endif

                                            @endforeach

                                        </select>
                                        <input type="hidden" name="status_name" class="status_name">                              
                                    </div>
                                </div>
                            </div>

                            <div class="box-header with-border">
                                <h3 class="box-title">Product Info</h3>
                            </div>

                            <div class="box box-default">

                            <div class="box-body">

                            <table class="table table-striped ">
                                <thead>
                                <tr>
                                    <th>Product Sku</th>
                                    <th>Product Name</th>
                                    <th>Qty</th>
                                </tr>
                                </thead>
                                <tbody class="product_container">
                                @foreach($kit_products_details as $value)
                                <tr>  
                                    <td width="250px">
                                    <input type="text" class="form-control search_product_sku" name="product_sku[]" value="{{ $value->product_sku }}">
                                    <span class="help-block search_product_sku_empty" style="display: none;">No Results Found ...</span>
                                    <input type="hidden" class="search_product_id" name="product_id[]">
                                    </td>

                                    <td width="250px">
                                    <input type="text" class="form-control" name="product_name[]" value="{{ $value->product_name }}">
                                    <span></span>
                                    </td>
                                    
                                    <td width="90px">
                                    <input type="text" class="form-control" name="product_quantity[]" value="{{ $value->product_quantity }}">
                                    </td>
                                    
                                    <td><button type="button" class="btn btn-danger remove_tr">&times;</button></td>
                                </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="3">
                                    <button type="button" class="btn btn-primary add_kit_product"><i class="fa fa-plus"></i> Add More</button>
                                    </td>
                                    <td></td>
                                </tr>
                                </tfoot>
                            </table>

                            </div>
                            </div>




                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="reset" class="btn btn-danger pull-left">Reset</button>
                            <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-edit"></i> Update</button>
                        </div>
                    </form>
                </div>
                <!-- /.box-body -->
            </div>
        </div>  
    </div>  
</section>
<!-- /.content -->
@endsection
