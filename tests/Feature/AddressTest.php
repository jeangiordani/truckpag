<?php

namespace Tests\Feature;

use App\Models\Address;
use App\Models\City;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AddressTest extends TestCase
{
    use DatabaseMigrations;

    public function test_it_should_return_all_addresses()
    {

        $addresses = Address::factory()->count(5)->create();

        $response = $this->getJson('api/address');

        $response->assertOk()->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'public_place',
                    'number',
                    'district',
                    'created_at',
                    'updated_at',
                    'city_id',
                    'cities' => [
                        'id',
                        'name',
                        'created_at',
                        'updated_at'
                    ]
                ]


            ]
        ])->assertJsonCount(5, 'data.*.id');
    }

    public function test_it_should_return_one_address()
    {
        $addresses = Address::factory()->count(5)->create();

        $response = $this->getJson('api/address/' . $addresses->first()->id);

        $response->assertOk();
        $this->assertEquals($addresses->first()->public_place, $response->json()['data']['public_place']);
    }

    public function test_it_should_not_return_address_with_invalid_id()
    {
        $addresses = Address::factory()->count(5)->create();

        $response = $this->getJson('api/address/' . random_int($addresses->last()->id, 9999999));

        $response->assertStatus(404)->assertExactJson([
            'message' => 'Endereço não encontrado'
        ]);
    }

    public function test_it_should_create_an_address()
    {
        $city = City::factory()->create();

        $payload = [
            'logradouro' => 'Praça',
            'numero' => '3399',
            'bairro' => 'Bairro Aparecida',
            'city_id' => $city->id
        ];

        $response = $this->postJson('api/address/', $payload);

        $response->assertStatus(201);

        $this->assertEquals($payload['numero'], $response->json()['data']['number']);
        $this->assertDatabaseHas('address', [
            'number' => $payload['numero'],
            'public_place' => $payload['logradouro'],
            'district' => $payload['bairro'],
            'city_id' => $payload['city_id'],
        ]);
    }

    public function test_it_should_not_create_an_address_with_invalid_payload()
    {
        $city = City::factory()->create();

        $payload = [
            'logradouro' => 'Praça',
            'numero' => '',
            'bairro' => 'Bairro Aparecida',
            'city_id' => $city->id
        ];

        $response = $this->postJson('api/address/', $payload);

        $response->assertStatus(422);

        $this->assertDatabaseMissing('address', [
            'number' => $payload['numero'],
            'public_place' => $payload['logradouro'],
            'district' => $payload['bairro'],
            'city_id' => $payload['city_id'],
        ]);
    }

    public function test_it_should_update_an_already_existing_address()
    {
        $address = Address::factory()->create();

        $payload = [
            'logradouro' => 'Hospital',
            'numero' => '34234',
            'bairro' => 'Bairro Lucas',
            'city_id' => $address->city_id
        ];

        $response = $this->putJson('api/address/' .  $address->id, $payload);

        $response->assertStatus(200);

        $this->assertDatabaseHas('address', [
            'number' => $payload['numero'],
            'public_place' => $payload['logradouro'],
            'district' => $payload['bairro'],
            'city_id' => $payload['city_id'],
        ]);
    }

    public function test_it_should_not_update_an_address_with_invalid_id()
    {
        $address = Address::factory()->create();

        $payload = [
            'logradouro' => 'Hospital',
            'numero' => '34234',
            'bairro' => 'Bairro Lucas',
            'city_id' => $address->city_id
        ];

        $response = $this->putJson('api/address/' .  random_int($address->id + 1, 9999999), $payload);

        $response->assertStatus(404);

        $this->assertDatabaseHas('address', [
            'number' => $address->number,
            'public_place' => $address->public_place,
            'district' => $address->district,
            'city_id' => $address->city_id,
        ]);
    }

    public function test_it_should_delete_an_address()
    {
        $address = Address::factory()->count(5)->create();

        $response = $this->deleteJson('api/address/' .  $address->first()->id);

        $response->assertStatus(200);

        $address = Address::all();

        $this->assertCount(4, $address);
    }
}
