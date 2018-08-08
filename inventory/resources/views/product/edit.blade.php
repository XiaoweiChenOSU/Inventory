@extends('layouts.home')

@section('content')

<section class="content-header">
    <h1>
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Product</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Edit Product</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                            <i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                            <i class="fa fa-times"></i></button>
                    </div>
                </div>
                <div class="box-body">
                    <form class="form-horizontal create_product" role="form" method="POST" action="{{ url('/product/update/'.$product_details->id) }}">

                        {{ csrf_field() }}

                        <div class="box-body">

                            <div class="row">

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Code</label><br>
                                        <input type="text" class="form-control" name="code" placeholder="Product Code" value="{{ $product_details->code }}">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Cost</label>
                                        <input type="text" class="form-control" name="cost" placeholder="0.00" value="{{ $product_details->cost }}">
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>SKU</label><br>
                                        <input type="text" class="form-control" name="sku" placeholder="Product SKU" value="{{ $product_details->sku }}">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Retail Price</label>
                                        <input type="text" class="form-control" name="retail_price" placeholder="0.00" value="{{ $product_details->retail_price }}">
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Part Number</label><br>
                                        <input type="text" class="form-control" name="part_number" placeholder="Part Number" value="{{ $product_details->part_number }}">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Sale Price</label>
                                        <input type="text" class="form-control" name="sale_price" placeholder="0.00" value="">
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Attribute Name</label><br>
                                        <select class="form-control change_attribute_name" name="attribute_id">
                                            <option selected="" disabled="" value="">- Select - </option>

                                            @if($product_details->attribute_id == 0)
                                            <option value="0" selected="">- No attributes -</option>
                                            @else
                                            <option value="0">- No attributes -</option>    
                                            @endif 

                                            @foreach($attribute_details as $key1 => $value1)

                                            @if($product_details->attribute_id == $key1)
                                            <option value="{{ $key1 }}" selected="">{{ $value1 }}</option>
                                            @else  
                                            <option value="{{ $key1 }}">{{ $value1 }}</option>
                                            @endif

                                            @endforeach

                                        </select>
                                        <input type="hidden" name="attribute_name" class="attribute_name">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Selling Price</label>
                                        <input type="text" class="form-control" name="selling_price" placeholder="0.00" value="{{ $product_details->selling_price }}">
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Title</label><br>
                                        <input type="text" class="form-control" name="description" placeholder="Product Title" value="{{ $product_details->description }}">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Weight</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="weight" placeholder="Weight" value="{{ $product_details->weight }}">
                                            <span class="input-group-addon">
                                                <select class="" name="weight_unit">
                                                    <option selected="" disabled="" value=""> Select </option>
                                                    <option value="1">kgs</option>
                                                    <option value="2">lbs</option>
                                                    <option value="3">oz</option>
                                                    <option value="4">g</option>
                                                </select>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Brand Name</label><br>
                                        <select class="form-control change_brand_name" name="brand_id">
                                            <option selected="" disabled="" value="">- Select - </option>

                                            @if($product_details->brand_id == 0)
                                            <option value="0" selected="">- No brands -</option>
                                            @else
                                            <option value="0">- No brands -</option>    
                                            @endif 

                                            @foreach($brand_details as $key1 => $value1)

                                            @if($product_details->brand_id == $key1)
                                            <option value="{{ $key1 }}" selected="">{{ $value1 }}</option>
                                            @else  
                                            <option value="{{ $key1 }}">{{ $value1 }}</option>
                                            @endif

                                            @endforeach

                                        </select>
                                        <input type="hidden" name="brand_name" class="brand_name">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Maximum Quantity</label>
                                        <input type="text" class="form-control" name="max_qnty" placeholder="Maximum Quantity" value="{{ $product_details->max_qnty }}">
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Classification Name</label><br>
                                        <select class="form-control change_classification_name" name="classification_id">
                                            <option selected="" disabled="" value="">- Select - </option>

                                            @if($product_details->classification_id == 0)
                                            <option value="0" selected="">- No Classification -</option>
                                            @else
                                            <option value="0">- No Classification -</option>    
                                            @endif 

                                            @foreach($classification_details as $key1 => $value1)

                                            @if($product_details->classification_id == $key1)
                                            <option value="{{ $key1 }}" selected="">{{ $value1 }}</option>
                                            @else  
                                            <option value="{{ $key1 }}">{{ $value1 }}</option>
                                            @endif

                                            @endforeach

                                        </select>
                                        <input type="hidden" name="supplier_name" class="supplier_name">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Minimum Quantity</label>
                                        <input type="text" class="form-control" name="min_qnty" placeholder="Minimum Quantity" value="{{ $product_details->min_qnty }}">
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Supplier Name</label><br>
                                        <select class="form-control change_supplier_name" name="supplier_id">
                                            <option selected="" disabled="" value="">- Select - </option>

                                            @if($product_details->supplier_id == 0)
                                            <option value="0" selected="">- Multiple suppliers -</option>
                                            @else
                                            <option value="0">- Multiple suppliers -</option>    
                                            @endif 

                                            @foreach($supplier_details as $key1 => $value1)

                                            @if($product_details->supplier_id == $key1)
                                            <option value="{{ $key1 }}" selected="">{{ $value1 }}</option>
                                            @else  
                                            <option value="{{ $key1 }}">{{ $value1 }}</option>
                                            @endif

                                            @endforeach

                                        </select>
                                        <input type="hidden" name="supplier_name" class="supplier_name">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Reorder Point</label>
                                        <input type="text" class="form-control" name="reorder_point" placeholder="0" value="{{ $product_details->reorder_point }}">
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Status Name</label><br>
                                        <select class="form-control change_status_name" name="status_id">
                                            <option selected="" disabled="" value="">- Select - </option>

                                            @if($product_details->status_id == 0)
                                            <option value="0" selected="">- No Status -</option>
                                            @else
                                            <option value="0">- No Status -</option>    
                                            @endif 

                                            @foreach($status_details as $key1 => $value1)

                                            @if($product_details->status_id == $key1)
                                            <option value="{{ $key1 }}" selected="">{{ $value1 }}</option>
                                            @else  
                                            <option value="{{ $key1 }}">{{ $value1 }}</option>
                                            @endif

                                            @endforeach

                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Note</label>
                                        <textarea class="form-control" rows="3" name="note" placeholder="Enter ...">{{ $product_details->note }}</textarea>
                                    </div>
                                </div>

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
