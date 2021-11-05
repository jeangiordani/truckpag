<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAddressRequest;
use App\Http\Requests\UpdateAddressRequest;
use App\Http\Resources\AddressResource;
use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    protected $model;

    public function __construct(Address $model)
    {
        $this->model = $model;
    }

    public function store(StoreAddressRequest $request)
    {
        $address = $request->validated();

        $result = $this->model->create([
            'number' => $address['numero'],
            'public_place' => $address['logradouro'],
            'district' => $address['bairro'],
            'city_id' => $address['city_id'],
        ]);

        return response()->json([
            'data' => $result
        ], 201);
    }

    public function index()
    {
        $address = $this->model->with('cities')->get();

        return response()->json([
            'data' => $address
        ], 200);
    }

    public function show(int $id)
    {
        $address = $this->model->with('cities')->find($id);

        if (!$address) {
            return response()->json([
                'message' => 'Cidade não encontrada'
            ], 404);
        }

        return response()->json([
            'data' => $address
        ], 200);
    }

    public function update(UpdateAddressRequest $request, int $id)
    {
        $data = $request->validated();

        $address = $this->model->find($id);

        if (!$address) {
            return response()->json([
                'message' => 'Cidade não encontrada'
            ], 404);
        }
        $data = [
            'number' => $data['numero'],
            'public_place' => $data['logradouro'],
            'district' => $data['bairro'],
            'city_id' => $data['city_id'],
        ];

        $result = $address->update($data);

        return response()->json([
            'data' => $data
        ], 200);
    }

    public function destroy(int $id)
    {
        $address = $this->model->find($id);

        if (!$address) {
            return response()->json([
                'message' => 'Cidade não encontrada'
            ], 404);
        }

        $address->delete();

        return response()->json([
            'message' => 'OK'
        ], 200);
    }
}
