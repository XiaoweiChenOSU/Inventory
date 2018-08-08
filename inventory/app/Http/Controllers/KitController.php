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
        if (!isset($request['order'])) {
            if ($request['order'] != 'desc')
                $request['order'] = 'desc';
        }
        if (!isset($request['search'])) {
            if ($request['search'] != '%%')
                $request['search'] = '%%';
        }else {
            $request['search'] = '%' . $request['search'] . '%';
        }
        if (!isset($request['filter'])) {

            $request['filter'] = [];
        }

        if (!isset($request['sort'])) {
            if ($request['sort'] != 'id')
                $request['sort'] = 'id';
        }
        
        $rows = \App\Models\Kit::where(function($query) use($request){
            $query->orwhere('id','like',$request['search'])
            ->orwhere('kit_sku','like',$request['search'])
            ->orwhere('kit_code','like',$request['search'])
            ->orwhere('kit_title','like',$request['search']);
        })->orderBy($request['sort'],$request['order'])
          ->skip($request['offset'])
          ->take($request['limit'])
          ->get();


        $total = \App\Models\Kit::where(function($query) use($request){
            $query->orwhere('id','like',$request['search'])
            ->orwhere('kit_sku','like',$request['search']);
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
        
        $product_details = \App\Models\Product::pluck('description','sku','id');

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

        $kit_product = array();

        unset($request['product_id[]'],$request['product_sku[]'],$request['product_name[]'],$request['product_quantity[]']);
     

        $KitDetail = \App\Models\Kit::create($request->all());



        foreach ($data['product_id'] as $key => $value) {
            
            $kit_product[$key]['kit_id'] = $KitDetail->id;
            $kit_product[$key]['product_id'] = $value;
            $kit_product[$key]['product_sku'] = $data['product_sku'][$key];
            $kit_product[$key]['product_name'] = $data['product_name'][$key];
            $kit_product[$key]['product_quantity'] = $data['product_quantity'][$key];
            $kit_product[$key]['created_at'] = \Carbon\Carbon::now();
            $kit_product[$key]['updated_at'] = \Carbon\Carbon::now();
        }


        try {
            \App\Models\KitProducts::insert($kit_product);
            $messageType = 1;
            $message = "Kit created successfully !"; 
        } catch(\Illuminate\Database\QueryException $ex){  
            $messageType = 2;
            $message = "Kit creation failed !";            
        }

        print_r($messageType);
        print_r($message);

        return redirect(url("/kit/view"))->with('messageType',$messageType)->with('message',$message);
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
        $kits_details = \App\Models\Kit::find($id);

        $kit_id = $kits_details->id;

        $status_id = $kits_details->status_id;

        $status_old = \App\Models\Status::find($status_id);

        $status_details = \App\Models\Status::pluck('status_name', 'id');

        $kit_products_details = \App\Models\KitProducts::where('kit_id', $kit_id)->get();

        $product_details = \App\Models\Product::pluck('description','sku','id');

        return view('kit.edit')->with('kits_details',$kits_details)->with('kit_products_details',$kit_products_details)->with('status_old',$status_old)->with('status_details',$status_details)->with('product_details', $product_details);
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

            $data = $request->all();

            print_r($data['product_id']);
            if($data['product_id'][0]==null){
                print_r("test1");
            } 
            else{
                print_r("test2");
            }
            exit();

            $kit = \App\Models\Kit::find($id);

            $kit_product = array();

            $kit->update($data);

            $kit_id = $kit->id;

            $kit_products_details = \App\Models\KitProducts::where('kit_id', $kit_id)->get();


            foreach ($data['product_id'] as $key => $value) {
                if ($data['product_id'][$key] != null){
                    $kit_product[$key]['product_id'] = $kit_products_details->product_id;       
                }
                else{
                    $kit_product[$key]['product_id'] = $kit_products_details->product_id;
                }
                $kit_product[$key]['kit_id'] = $KitDetail->id;
                $kit_product[$key]['product_id'] = $value;
                $kit_product[$key]['product_sku'] = $data['product_sku'][$key];
                $kit_product[$key]['product_name'] = $data['product_name'][$key];
                $kit_product[$key]['product_quantity'] = $data['product_quantity'][$key];
                $kit_product[$key]['created_at'] = \Carbon\Carbon::now();
                $kit_product[$key]['updated_at'] = \Carbon\Carbon::now();
            }
          
            //foreach($kit_products_details as $value){
            //    $value->update($request->all());
            //}

            $messageType = 1;
            $message = "Kit ".$kit->kit_title." details updated successfully !";

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
            
            $kit = \App\Models\kit::find($id);
  
            $kit_id = $kit->id;

            $kit_products_details = \App\Models\KitProducts::where('kit_id', $kit_id)->get();

            foreach($kit_products_details as $value){
                $value->delete();
            }

            $kit->delete();  

            $messageType = 1;
            $message = "Kit ".$kit->kit_title." details deleted successfully !";

        } catch(\Illuminate\Database\QueryException $ex){  
            $messageType = 2;
            $message = "Kit deletion failed !";
        }
        
        return redirect(url("/kit/view"))->with('messageType',$messageType)->with('message',$message);
    } 

}

