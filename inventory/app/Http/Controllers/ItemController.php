<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(!isset($request['order'])){
            if($request['order']!='desc')
            $request['order']='desc';
        
        }

        if(!isset($request['search'])){
            if($request['search']!='%%')
            $request['search']='%%';
        
        }else{
          $request['search']='%'.$request['search'].'%';
        }

        if(!isset($request['filter'])){

            $request['filter'] = [];
        
        }

        if(!isset($request['sort'])){
            if($request['sort']!='id')
            $request['sort']='id';
        
        }

        $rows = \App\Models\Item::where(function($query) use($request){
                      
                $query->orwhere('id','like',$request['search'])
                ->orwhere('quantity','like',$request['search'])
                ->orwhere('warehous_id','like',$request['search'])
                ->orwhere('product_id','like',$request['search'])
                ->orwhere('note','like',$request['search']);

            })->orderBy($request['sort'],$request['order'])
            ->skip($request['offset'])
            ->take($request['limit'])
            ->get();

       

        $total = \App\Models\Item::where(function($query) use($request){

                      $query->orwhere('id','like',$request['search'])
                      ->orwhere('quantity','like',$request['search'])
                      ->orwhere('warehous_id','like',$request['search'])
                      ->orwhere('product_id','like',$request['search'])
                      ->orwhere('note','like',$request['search']);

                  })->count();

        return ['rows'=>$rows,'total'=>$total];
    }

    public function get_product(Request $request)
    {

        if(!isset($request['order'])){
            if($request['order']!='desc')
            $request['order']='desc';
        
        }

        if(!isset($request['warehouse_id'])){
            if($request['warehouse_id']!='%%')
            $request['warehouse_id']='%%';
        
        }else{
          $request['warehouse_id']='%'.$request['warehouse_id'].'%';
        }

        if(!isset($request['filter'])){

            $request['filter'] = [];
        
        }

        if(!isset($request['sort'])){
            if($request['sort']!='id')
            $request['sort']='id';
        
        }

        $rows = \App\Models\Item::where('warehous_id','like',$request['warehouse_id'])
          ->select('items.*')
          ->join('products','items.product_id','=','products.id')
          ->select('products.id','products.code','products.sku','products.description','products.part_number','items.quantity')
          ->get();

       # print_r($rows);
       # exit;

        $total = \App\Models\Item::where(function($query) use($request){

                      $query->orwhere('id','like',$request['search'])
                      ->orwhere('quantity','like',$request['search'])
                      ->orwhere('warehous_id','like',$request['search'])
                      ->orwhere('product_id','like',$request['search'])
                      ->orwhere('note','like',$request['search']);

                  })->count();

        return ['rows'=>$rows,'total'=>$total];
    }


    public function view()
    {
        return view('item.view');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('item.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            
            \App\Models\Item::create($request->all());

            $messageType = 1;
            $message = "Item created successfully !";

        } catch(\Illuminate\Database\QueryException $ex){  
            $messageType = 2;
            $message = "Item creation failed !";            
        }

        return redirect(url("/item/view"))->with('messageType',$messageType)->with('message',$message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd($id);
    }


 /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function audit(Request $request)
    {
    
        $warehouse_details = \App\Models\Warehouse::pluck('warehouse_name','id');

        $warehouse_id = $request['warehouse_id'];

        $item_details = \App\Models\Item::where('warehous_id',$warehouse_id)->get();


        return view('item.audit')->with('warehouse_details',$warehouse_details)->with('item_details',$item_details);
    }



    public function auditproduct(Request $request)
    {

      $measure_id = $request['measure_id'];
      $uom_id = $request['uom_id'];
      $stock_value = $request['value'];

      $symbol = \App\Models\UnitOfMeasuresMaster::where('uom_id',$uom_id)->with('');

      foreach ($request['value'] as $rkey => $rval) {
        
        if(isset($request['stock_name'])){
          $request['stock_name'] = $request['stock_name'].' x '.$rval.$symbol[$rkey];  
        }else{
          $request['stock_name'] = $rval.$symbol[$rkey];  
        }

      }

      $stock_units = array();

      unset($request['measure_id'],$request['uom_id'],$request['value']);

        try {
            
            
            $stock = \App\Models\StockDetail::create($request->all());

            // \App\Models\StockAvail::create(['stock_id'=>$stock->stock_id,'stock_name'=>$stock->stock_name]);

            foreach ($measure_id as $key => $value) {

              $stock_units[$key]['stock_id'] = $stock->stock_id;
              $stock_units[$key]['category_id'] = $stock->category_id;
              $stock_units[$key]['measure_id'] = $value;
              $stock_units[$key]['uom_id'] = $uom_id[$key];
              $stock_units[$key]['value'] = $stock_value[$key];
              $stock_units[$key]['created_at'] = \Carbon\Carbon::now();

            }

            $stock_units_detail = \App\Models\StockUnitsDetail::insert($stock_units);

            $messageType = 1;
            $message = "Stock created successfully !";

        } catch(\Illuminate\Database\QueryException $ex){  
            $messageType = 2;
            $message = "Stock creation failed !";            
        }

        return redirect(url("/stock/view"))->with('messageType',$messageType)->with('message',$message);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item_details = \App\Models\Item::where('id',$id)->get();

        // dd($item_details[0]->toarray());

        return view('item.edit')->with('item_details',$item_details[0]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {

            $brand = \App\Models\Item::find($id);

            $brand->update($request->all());

            $messageType = 1;
            $message = "Item details updated successfully !";

        } catch(\Illuminate\Database\QueryException $ex){  
            $messageType = 2;
            $message = "Item updation failed !";
        }

        return redirect(url("/item/view"))->with('messageType',$messageType)->with('message',$message);
    }

    public function view_availability()
    {   
        return view('item.available');
    }
}
