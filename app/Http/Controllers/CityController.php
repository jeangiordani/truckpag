<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Services\IBGEService;
use Illuminate\Http\Request;

class CityController extends Controller
{
    protected $service;
    protected $model;
    //
    public function __construct(IBGEService $service, City $model)
    {
        $this->service = $service;
        $this->model = $model;
    }

    public function loadCities(string $state)
    {
        $initials = [
            'AC', 'AL', 'AP', 'AM', 'BA', 'CE', 'ES', 'GO', 'MA', 'MT', 'MS', 'MG', 'PA', 'PB', 'PR', 'PE', 'PI', 'RJ', 'RN', 'RS', 'RO', 'RR', 'SC', 'SP ', 'SE', 'TO ', 'DF'
        ];

        if (!in_array($state, $initials)) {
            return response()->json(['message' => 'Estado não encontrado']);
        }
        $rawResult = collect($this->service->getCitiesByState($state))->all();

        if ($rawResult != null) {
            for ($x = 0; $x < sizeof($rawResult); $x++) {
                $this->model->firstOrNew(
                    ['id' => $rawResult[$x]['id']],
                    ['name' => $rawResult[$x]['nome']],
                );
            }
        }


        return response()->json($this->model->orderBy('name', 'asc')->get());
    }
}
