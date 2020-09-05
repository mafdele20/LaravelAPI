<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\TypeCompte;

class TypeCompteApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_type_compte()
    {
        $typeCompte = factory(TypeCompte::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/type_comptes', $typeCompte
        );

        $this->assertApiResponse($typeCompte);
    }

    /**
     * @test
     */
    public function test_read_type_compte()
    {
        $typeCompte = factory(TypeCompte::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/type_comptes/'.$typeCompte->id
        );

        $this->assertApiResponse($typeCompte->toArray());
    }

    /**
     * @test
     */
    public function test_update_type_compte()
    {
        $typeCompte = factory(TypeCompte::class)->create();
        $editedTypeCompte = factory(TypeCompte::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/type_comptes/'.$typeCompte->id,
            $editedTypeCompte
        );

        $this->assertApiResponse($editedTypeCompte);
    }

    /**
     * @test
     */
    public function test_delete_type_compte()
    {
        $typeCompte = factory(TypeCompte::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/type_comptes/'.$typeCompte->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/type_comptes/'.$typeCompte->id
        );

        $this->response->assertStatus(404);
    }
}
