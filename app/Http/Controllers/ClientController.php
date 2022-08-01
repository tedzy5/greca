<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ClientController extends Controller
{
    /**
     * Display all clients in JSON.
     */
    public function index() {
        $clients = Client::all();
        return response()->json($clients, 201);
    }

    /**
     * Shows the specificed $id client in JSON
     *
     * @return $id
     */
    public function show($id) {
        $client = Client::find($id);
        if(is_null($client)) {
            return response()->json(['message' => 'Oops! Client not found.'], 404);
        } else {
            return response()->json(Client::find($id), 200);
        }
    }

    /**
     * Creates new client via POST
     *
     * @return /Illuminate/Http/Request
     */
    public function store(Request $request) {
        $request->validate([
            'first_name' => 'required|min:5|max:30',
            'last_name' => 'required|min:10',
            'email' => 'required|email|'.Rule::unique('clients'),
            'passport_num' => 'min:7',
            'gender' => 'required'
        ]);

        $client = Client::create($request->all());
        return response($client, 201);

    }

    /**
     * Updates client with $id via POST
     *
     * @return /Illuminate/Http/Request
     */
    public function update(Request $request, $id) {
        $client = Client::find($id);

        if(is_null($client)) {
            return response()->json(['message' => 'Oops! Client is not found!'], 404);
        } else {
            $request->validate([
                'first_name' => 'min:5|max:30',
                'last_name' => 'min:10',
                'email' => 'min:10|email|'.Rule::unique('clients')->ignore($client->id),
                'passport_num' => 'min:7',
                'gender' => 'min:1'
            ]);

            $client->update($request->all());
            return response($request, 200);
        }
    }

    /**
     * Deletes/Destros Client with $id.
     *
     * @return /Illuminate/Http/Request
     */
    public function destroy(Request $request, $id) {
        $client = Client::find($id);
        if(is_null($client)) {
            return response()->json(['message' => 'Oops, client is not found!']);
        } else {
            $client->delete();
            return response()->json(['message' => 'Client successfully deleted.'], 200);
        }
    }

    /**
     * Shows the specificed bookings for the Client's $id in JSON
     *
     * @return $id
     */
    public function bookings($id) {
        $bookings = Client::find($id)->bookings()->get();
        return $bookings;
    }
}
