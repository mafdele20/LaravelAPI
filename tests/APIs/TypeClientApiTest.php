<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\TypeClient;

class TypeClientApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_type_client()
    {
        $typeClient = factory(TypeClient::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/type_clients', $typeClient
        );

        $this->assertApiResponse($typeClient);
    }

    /**
     * @test
     */
    public function test_read_type_client()
    {
        $typeClient = factory(TypeClient::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/type_clients/'.$typeClient->id
        );

        $this->assertApiResponse($typeClient->toArray());
    }

    /**
     * @test
     */
    public function test_update_type_client()
    {
        $typeClient = factory(TypeClient::class)->create();
        $editedTypeClient = factory(TypeClient::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/type_clients/'.$typeClient->id,
            $editedTypeClient
        );

        $this->assertApiResponse($editedTypeClient);
    }

    /**
     * @test
     */
    public function test_delete_type_client()
    {
        $typeClient = factory(TypeClient::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/type_clients/'.$typeClient->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/type_clients/'.$typeClient->id
        );

        $this->response->assertStatus(404);
    }
}
