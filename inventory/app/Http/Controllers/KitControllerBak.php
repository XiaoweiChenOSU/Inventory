<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KitController extends Controller
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


        $rows = \App\Models\Kit::where(function($query) use($request){
                      $query->orwhere('id','like',$request['search'])
                      ->orwhere('code','like',$request['search'])
                      ->orwhere('sku','like',$request['search'])
                      ->orwhere('description','like',$request['search']);
                  })->with('product')->orderBy($request['sort'],$request['order'])
                    ->skip($request['offset'])
                    ->take($request['limit'])
                    ->get();

        $total = \App\Models\Kit::where(function($query) use($request){
                      $query->orwhere('id','like',$request['search'])
                      ->orwhere('sku','like',$request['search'])
                      ->orwhere('description','like',$request['search']);
                  })->count();

        return ['rows'=>$rows,'total'=>$total];
    }

    public function view()
    {
        return view('kit.view');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $status_details = \App\Models\Status::pluck('status_name', 'id');
        
        $product_details = \App\Models\Product::pluck('description','sku', 'code','id');

        return view('kit.create')->with('product_details', $product_details)->with('status_details', $status_details);
 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = $request->all();


        unset($request['product_name'],$request['product_id'],$request['product_sku'],$request['product_code']);

        $KitDetail = \App\Models\Kit::create($request->all());

        foreach ($data['id'] as $key => $value) {
            
            $kit_product[$key]['product_id'] = $Purchase->id;
            $kit_product[$key]['id'] = $value;
            $kit_product[$key]['product_name'] = $data['description'][$key];
            $kit_product[$key]['product_sku'] = $data['product_sku'][$key];
        }

        $SalesProduct = \App\Models\KitProductList::insert($kit_product);

    //    foreach ($purchase_product as $key => $value) {
         
      //   \App\Models\StockDetail::where('stock_id',$value['stock_id'])->update(['stock_quantity'=>$value['closing_stock']]);   
      //  }

     
            $messageType = 1;
            $message = "Kit created successfully !";
        try {
            
            

        } catch(\Illuminate\Database\QueryException $ex){  
            $messageType = 2;
            $message = "Kit creation failed !";            
        }

        return redirect(url("/purchase/view"))->with('messageType',$messageType)->with('message',$message);
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kit_details = \App\Models\Kit::find($id);

        $product_details = \App\Models\Product::pluck('description','sku');

        return view('kit.edit')->with('kit_details',$kit_details)->with('product_details',$product_details);
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

            $kit = \App\Models\Kit::find($id);

            $kit->update($request->all());

            $messageType = 1;
            $message = "Kit ".$purchase->purchase_name." kit updated successfully !";

        } catch(\Illuminate\Database\QueryException $ex){  
            $messageType = 2;
            $message = "Kit updation failed !";
        }

        return redirect(url("/kit/view"))->with('messageType',$messageType)->with('message',$message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            
            $kit = \App\Models\Kit::find($id);

            $kit->delete();    

            $messageType = 1;
            $message = "Kit ".$kit->title." kit deleted successfully !";

        } catch(\Illuminate\Database\QueryException $ex){  
            $messageType = 2;
            $message = "Kit deletion failed !";
        }
        
        return redirect(url("/purchase/view"))->with('messageType',$messageType)->with('message',$message);
    } 
}