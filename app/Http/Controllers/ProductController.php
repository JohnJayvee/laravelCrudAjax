<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {

            // $data = Product::orderBy('id', 'asc')->get()
            // $data = Product::latest()->get();
            $data = Product::latest()->get();

            return datatables()->of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Edit</a>';

                    $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Delete</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('product');
    }

    public function store(Request $request)
    {
        Product::updateOrCreate(
            [
                'id' => $request->product_id,
            ],
            [
                // 'id' => $request->product_id,
                'name' => $request->name,
                'detail' => $request->detail
            ]
        );

        return response()->json(['success' => 'Record saved successfully.']);
    }

    public function edit($id)
    {
        $product = Product::find($id);
        return response()->json($product);
    }


    public function destroy($id)
    {
        Product::find($id)->delete();

        return response()->json(['success' => 'Record deleted successfully.']);
    }

    public function show($id)
    {
        $product = Product::find($id);
        return response()->json($product);
    }
}