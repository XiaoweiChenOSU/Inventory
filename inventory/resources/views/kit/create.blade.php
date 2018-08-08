@extends('layouts.home')

@section('content')

<section class="content-header">
  <h1>
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Add Kit</li>
  </ol>
</section>

<!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-sm-12">
          <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Add Kit</h3>

            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="box-body">
            <form class="form-horizontal create_kit" role="form" method="POST" action="{{ url('/kit/store') }}">
      
                    {{ csrf_field() }}

                    <div class="box-body">

                      <div class="box box-default">
                        <div class="box-body">
                          <div class="row">
                            <div class="col-sm-3">
                              <div class="form-group">
                                  <label>Kit Code</label><br>
                                  <input type="text" class="form-control" name="kit_code" placeholder="Leave blank to auto-generate">
                              </div>
                            </div>

                            <div class="col-sm-3">
                              <div class="form-group">
                                <label>Kit SKU</label><br>
                                <input type="text" class="form-control search_kit_sku" name="kit_sku" autocomplete="off">
                              </div>
                            </div>

                            <div class="col-sm-2">
                              <div class="form-group">
                                <label>Title</label><br>
                                <input type="text" class="form-control search_kit_title" name="kit_title" autocomplete="off">
                              </div>
                            </div>

                            <div class="col-sm-2">
                              <div class="form-group kit_sync">
                                <label>Quantity Sync</label><br>
                                <input type="checkbox" name="quantity_sync" class="quantity_sync" checked>
                              </div>
                            </div>
        
                            <div class="col-sm-2">
                              <div class="form-group">
                                <label>Statuses</label>
                                <select class="form-control change_status_name" name="status_id">
                                            <option selected="" disabled="" value=""> Select </option>
                                            @foreach($status_details as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                            @endforeach
                                </select>
                                <input type="hidden" name="status_name" class="status_name">
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>


                      <div class="box-header with-border">
                        <h3 class="box-title">Add Product to Kit</h3>
                      </div>
  
                      <div class="box box-default">

                        <div class="box-body">

                          <table class="table table-striped">
                            <thead>
                              <tr>
                                <th>Product Sku</th>
                                <th>Name</th>
                                <th>Qty</th>
                              </tr>
                            </thead>
                            <tbody class="product_container">
                              <tr>
                              
                                <td>
                                  <input type="text" class="form-control search_product_sku" placeholder="Type here ..." name="product_sku[]" autocomplete="off">
                                  <span class="help-block search_product_sku_empty" style="display: none;">No Results Found ...</span>
                                  <input type="hidden" class="search_product_id" name="product_id[]">
                                </td>

                                <td width="250px">
                                  <input type="text" class="form-control search_product_name" placeholder="Type here ..." name="product_name[]" autocomplete="off">
                                  <span></span>
                                </td>
                                
                                <td width="150px">
                                  <input type="text" class="form-control change_product_quantity" name="product_quantity[]" min="0" autocomplete="off">
                                </td>
                                
                                <td><button type="button" class="btn btn-danger remove_tr">&times;</button></td>
                              </tr>
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

                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                      <button type="reset" class="btn btn-danger pull-left">Reset</button>
                      <button type="submit" class="btn btn-primary pull-right form_submit"><i class="fa fa-plus"></i> Add</button>
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
