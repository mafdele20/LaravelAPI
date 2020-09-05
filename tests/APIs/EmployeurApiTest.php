<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Employeur;

class EmployeurApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_employeur()
    {
        $employeur = factory(Employeur::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/employeurs', $employeur
        );

        $this->assertApiResponse($employeur);
    }

    /**
     * @test
     */
    public function test_read_employeur()
    {
        $employeur = factory(Employeur::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/employeurs/'.$employeur->id
        );

        $this->assertApiResponse($employeur->toArray());
    }

    /**
     * @test
     */
    public function test_update_employeur()
    {
        $employeur = factory(Employeur::class)->create();
        $editedEmployeur = factory(Employeur::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/employeurs/'.$employeur->id,
            $editedEmployeur
        );

        $this->assertApiResponse($editedEmployeur);
    }

    /**
     * @test
     */
    public function test_delete_employeur()
    {
        $employeur = factory(Employeur::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/employeurs/'.$employeur->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/employeurs/'.$employeur->id
        );

        $this->response->assertStatus(404);
    }
}
