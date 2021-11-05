<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class IBGEService
{

    public function getCitiesByState(string $state)
    {

        $cities = Http::get('http://servicodados.ibge.gov.br/api/v1/localidades/estados/' . $state . '/distritos')->json();
        if ($cities != null) {
            return $cities;
        }

        return null;
    }
}
