<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    /**
     * Display all products in JSON.
     */
    public function index() {
        $products = Product::all();
        return response()->json($products, 201);
    }

    /**
     * Shows the specificed $id product in JSON
     *
     * @return $id
     */
    public function show($id) {
        $products = Product::find($id);
        if(is_null($products)) {
            return response()->json(['message' => 'Oops! Client not found.'], 404);
        } else {
            return response()->json(Product::find($id), 200);
        }
    }

    /**
     * Creates new product via POST
     *
     * @return /Illuminate/Http/Request
     */
    public function store(Request $request) {
        $request->validate([
            'title' => 'required|min:3|max:90|'.Rule::unique('products'),
            'type' => 'required|numeric',
            'description' => 'alpha_num|nullable',
            'capacity' => 'required|numeric'
        ]);

        $products = Product::create($request->all());
        return response($products, 201);

    }

    /**
     * Updates product with $id via POST
     *
     * @return /Illuminate/Http/Request
     */
    public function update(Request $request, $id) {
        $products = Product::find($id);

        if(is_null($products)) {
            return response()->json(['message' => 'Oops! Client is not found!'], 404);
        } else {
            $request->validate([
                'title' => 'required|min:3|max:90|'.Rule::unique('products')->ignore($products->id),
                'type' => 'required|numeric',
                'description' => 'alpha_num',
                'capacity' => 'required|numeric'
            ]);

            $products->update($request->all());
            return response($request, 200);
        }
    }

    /**
     * Deletes/Destros product with $id.
     *
     * @return /Illuminate/Http/Request
     */
    public function destroy(Product $request, $id) {
        $products = Product::find($id);
        if(is_null($products)) {
            return response()->json(['message' => 'Oops, product is not found!']);
        } else {
            $products->delete();
            return response()->json(['message' => "Product '". $products->title ."' is successfully deleted."], 200);
        }
    }
}
