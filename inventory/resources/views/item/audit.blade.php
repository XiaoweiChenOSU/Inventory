@extends('layouts.home')

@section('content')



<section class="content-header">
  <h1>
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Item Audit</li>
  </ol>
</section>

<!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-sm-12">
          <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Stock Audit</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="box-body">
            <form class="form-horizontal create_audit" role="form" method="POST" action="{{ url('/item/get_product') }}">
      
                    {{ csrf_field() }}

                    <div class="box-body">

                      <div class="box box-default">
                        <div class="box-body">
                          <div class="row">

                            <div class="col-sm-3">
                              <div class="form-group">
                                <label>Warehouse</label>
                                <select class="form-control change_warehouse_name" name="warehouse_id" >
                                      <option selected="" disabled="" value=""> Select </option>
                                      @foreach($warehouse_details as $key => $value)
                                      <option value="{{ $key }}">{{ $value }}</option>
                                      @endforeach
                                </select>
                                <input type="hidden" name="status_name" class="status_name">
                              </div>
                            </div>
  
                            <div class="col-sm-3">
                              <div class="form-group">
                                <label>Product</label>
                                <div class="help-tip">
                                  <p>Product Code, SKU, MPN, or product title</p>
                                </div><br>
                                <input type="text" class="form-control" name="product" autocomplete="off">
                              </div>
                            </div>

                            <div class="col-sm-3">
                              <div class="form-group">
                                <label>&nbsp;</label>
                                <button type="submit" class="btn btn-block btn-default ">Show Items</button>
                              </div>
                            </div>
                          </div>
                          
                        </div>
                      </div>


                      <div class="box-header with-border">
                        <div class="col-sm-3">
                          <div class="form-group">
                            <button type="button" class="btn btn-block btn-default">Scan to Move</button>
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-group">
                            <button type="button" class="btn btn-block btn-default">Print Warehouse Label</button>
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-group">
                            <button type="button" class="btn btn-block btn-default">Add Note</button>
                          </div>
                        </div>
                      </div>
  


                      <div class="box-body">

                        <div class="row" style="width:99%;margin-left:5px">
                                  <div class="col-xs-12 ">
                                    <table id="table" class="table table-responsive" 
                                          data-toggle="table"
                                          data-url="{{ url('/item/get_product') }}"
                                          data-pagination="true"
                                          data-side-pagination="server"
                                          data-page-list="[10, 20, 30 , 40 , 50, 100, 200]"
                                          data-search="true"
                                          data-show-refresh="true"
                                          data-show-toggle="true"
                                          data-sort-name="id"
                                          data-sort-order="desc">
                                        <thead>
                                        <tr>                    
                                            <th data-field="code" data-align="center" data-sortable="true">Product Code</th>  
                                            <th data-field="sku" data-align="center" data-sortable="true">Product Sku</th>
                                            <th data-field="description" data-align="center" data-sortable="true">Product Title</th>
                                            <th data-field="part_number" data-align="center" data-sortable="true">Part Number</th>
                                            <th data-field="quantity" data-align="center" data-sortable="true">Quantity</th>
                                            <th data-align="center" data-formatter="actionFormatter" data-events="actionEvents" width="200px">Action</th>                                   
                                        </tr>
                                        </thead>
                                    </table>
                                  </div>
                        </div>

                        </div> 
                        </div>
                        <!-- /.box-body -->
                        </div>
        </div>  
      </div>  
    </section>
    <!-- /.content -->
@endsection
