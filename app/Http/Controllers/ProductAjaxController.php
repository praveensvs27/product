<?php
           
namespace App\Http\Controllers;
            
use App\Models\Product;
use App\Models\Unit;
use App\Models\Category;
use Illuminate\Http\Request;
use DataTables;
          
class ProductAjaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
     
        if ($request->ajax()) {
  
            $data = Product::latest()->get();
  
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
   
                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Edit</a>';
   
                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Delete</a>';
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        
        return view('productAjax');
    }
       
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		
		$validatedData = $request->validate([
    'title' => ['required',  'max:255'],
    'body' => ['required'],
		]);
		//exit;
		//dd($request);
        $res = Product::updateOrCreate([
                    'id' => $request->product_id
                ],
                [
                    'name' => $request->name, 
                    'detail' => $request->detail,
					'unit_id' => $request->unit_type,
					'price' => $request->price,
					'discount_percentage' => $request->discount_percentage,
					'discount_amount' => $request->discount_amount,
					'tax_percentage' => $request->tax_percentage,
					'tax_amount' => $request->tax_amount,
                ]);        
         //dd($res);
        return response()->json(['success'=>'Product saved successfully.']);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return response()->json($product);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::find($id)->delete();
      
        return response()->json(['success'=>'Product deleted successfully.']);
    }
	
	public function unit_view()
    {
		$data = Unit::latest()->get();
     
        
		return response()->json($data);
	}
	public function category_view()
    {
		$data = Category::latest()->get();
     
        
		return response()->json($data);
	}
}
