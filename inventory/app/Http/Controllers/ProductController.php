<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
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

        $rows = \App\Models\Product::where(function($query) use($request) {
                    $query->orwhere('id', 'like', $request['search'])
                    ->orwhere('description', 'like', $request['search'])
                    ->orwhere('code', 'like', $request['search'])
                    ->orwhere('sku', 'like', $request['search'])
                    ->orwhere('classification_id', 'like', $request['search'])
                    ->orwhere('supplier_id', 'like', $request['search'])
                    ->orwhere('selling_price', 'like', $request['search']);
                })->orderBy($request['sort'], $request['order'])
                ->skip($request['offset'])
                ->take($request['limit'])
                ->get();
        $total = \App\Models\Product::where(function($query) use($request) {
                    $query->orwhere('id', 'like', $request['search'])
                            ->orwhere('description', 'like', $request['search'])
                            ->orwhere('code', 'like', $request['search'])
                            ->orwhere('sku', 'like', $request['search'])
                            ->orwhere('classification_id', 'like', $request['search'])
                            ->orwhere('supplier_id', 'like', $request['search'])
                            ->orwhere('selling_price', 'like', $request['search']);
                })->count();

        return ['rows' => $rows, 'total' => $total];
    }

    public function view() {
        return view('product.view');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        $attribute_details = \App\Models\Attribute::pluck('attribute_name', 'id');

        $brand_details = \App\Models\Brand::pluck('brand_name', 'id');

        $category_details = \App\Models\CategoryDetail::pluck('category_name', 'id');

        $classification_details = \App\Models\Classification::pluck('classification_name', 'id');

        $status_details = \App\Models\Status::pluck('status_name', 'id');

        $supplier_details = \App\Models\SupplierDetail::pluck('supplier_name', 'id');

        return view('product.create')->with('category_details', $category_details)->with('supplier_details', $supplier_details)->with('brand_details', $brand_details)->with('classification_details', $classification_details)->with('status_details', $status_details)->with('attribute_details', $attribute_details);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        try {
            \App\Models\Product::create($request->all());
            
            $messageType = 1;
            $message = "Product created successfully !";
            return redirect(url("/product/view"))->with('messageType', $messageType)->with('message', $message);
        } catch (\Illuminate\Database\QueryException $ex) {
            $messageType = 2;
            $message = "Product creation failed !";
            return redirect(url("/product/view"))->with('messageType', $messageType)->with('message', $message);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        dd($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $product_details = \App\Models\Product::where('id', $id)->get();

        // dd($product_details[0]->toarray());

        $attribute_details = \App\Models\Attribute::pluck('attribute_name', 'id');
        $brand_details = \App\Models\Brand::pluck('brand_name', 'id');
        $classification_details = \App\Models\Classification::pluck('classification_name', 'id');
        $status_details = \App\Models\Status::pluck('status_name', 'id');
        $supplier_details = \App\Models\SupplierDetail::pluck('supplier_name', 'id');

        return view('product.edit')->with('product_details', $product_details[0])->with('attribute_details', $attribute_details)->with('brand_details', $brand_details)->with('classification_details', $classification_details)->with('status_details', $status_details)->with('supplier_details', $supplier_details);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        try {

            $product = \App\Models\Product::find($id);

            $product->update($request->all());

            // dd($product->toarray());

            $messageType = 1;
            $message = "Product " . $product->description . " details updated successfully !";
        } catch (\Illuminate\Database\QueryException $ex) {
            $messageType = 2;
            $message = "Product updation failed !";
        }

        return redirect(url("/product/view"))->with('messageType', $messageType)->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        try {

            $product = \App\Models\Product::find($id);
            $product->delete();

            $messageType = 1;
            $message = "Product " . $product->product_name . " details deleted successfully !";
        } catch (\Illuminate\Database\QueryException $ex) {
            $messageType = 2;
            $message = "Product deletion failed !";
        }

        return redirect(url("/product/view"))->with('messageType', $messageType)->with('message', $message);
    }

    public function view_availability() {
        return view('product.available');
    }

    public function get_product_count() {

        $product = \App\Models\Product::get();

        $backgroundColor = ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)', 'rgba(75, 192, 192, 0.2)', 'rgba(153, 102, 255, 0.2)', 'rgba(255, 159, 64, 0.2)'];

        $borderColor = ['rgba(255,99,132,1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)', 'rgba(255, 159, 64, 1)'];

        foreach ($product as $skey => $svalue) {

            $data['labels'][] = $svalue->product_name;

            $data['product'][] = $svalue->product_quantity;

            $data['backgroundColor'][] = $backgroundColor[($skey + 1) % 6];

            $data['borderColor'][] = $borderColor[($skey + 1) % 6];
        }

        return $data;
    }

    public function get_availability(Request $request) {
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

        // dd($request->all());

        $rows = \App\Models\Product::with('product')->where(function($query) use($request) {
                    $query->orwhere('id', 'like', $request['search']);
                })->orderBy($request['sort'], $request['order'])
                ->skip($request['offset'])
                ->take($request['limit'])
                ->get(['id']);

        // dd($rows->toarray());

        $total = \App\Models\Product::where(function($query) use($request) {
                    $query->orwhere('id', 'like', $request['search'])
                            ->orwhere('sku', 'like', $request['search'])
                            ->orwhere('code', 'like', $request['search']);
                })->count();

        return ['rows' => $rows, 'total' => $total];
    }

}
