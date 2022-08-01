<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Client;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookingController extends Controller
{
    /**
     * Display all bookings in JSON.
     */
    public function index() {
        $products = Booking::all();
        return response()->json($products, 201);
    }

    /**
     * Shows the specificed bookings for the Client's $id in JSON
     *
     * @return $id
     */
    public function show($id) {

    }

    /**
     * Creates new booking via POST
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse /Illuminate/Http/Request
     */
    public function store(Request $request) {
        $request->validate([
            'client_id' => 'required|numeric',
            'product_id' => 'required|numeric'
        ]);

        if(!Product::find($request->product_id)) {
            return response()->json(['message' => 'Product is not available to book for this client.'],201);
        } else {
            $capacity = Product::find($request->product_id)->capacity;
        }
        $totalTaken = Booking::where('product_id', $request->product_id)->count();

        if(!Client::find($request->client_id)) {
            return response()->json(['message' => 'Client is not available to book for this product.'],201);
        }

        if($totalTaken < $capacity) {
            $booking = Booking::create($request->all());
            return response($booking, 201);
        } else {
            return response()->json(['message' => 'No more capacity available for this product.'],201);
        }
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
                'client_id' => 'required|numeric',
                'product_id' => 'required|numeric'
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
