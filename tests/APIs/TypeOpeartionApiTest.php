<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\TypeOpeartion;

class TypeOpeartionApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_type_opeartion()
    {
        $typeOpeartion = factory(TypeOpeartion::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/type_opeartions', $typeOpeartion
        );

        $this->assertApiResponse($typeOpeartion);
    }

    /**
     * @test
     */
    public function test_read_type_opeartion()
    {
        $typeOpeartion = factory(TypeOpeartion::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/type_opeartions/'.$typeOpeartion->id
        );

        $this->assertApiResponse($typeOpeartion->toArray());
    }

    /**
     * @test
     */
    public function test_update_type_opeartion()
    {
        $typeOpeartion = factory(TypeOpeartion::class)->create();
        $editedTypeOpeartion = factory(TypeOpeartion::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/type_opeartions/'.$typeOpeartion->id,
            $editedTypeOpeartion
        );

        $this->assertApiResponse($editedTypeOpeartion);
    }

    /**
     * @test
     */
    public function test_delete_type_opeartion()
    {
        $typeOpeartion = factory(TypeOpeartion::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/type_opeartions/'.$typeOpeartion->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/type_opeartions/'.$typeOpeartion->id
        );

        $this->response->assertStatus(404);
    }
}
