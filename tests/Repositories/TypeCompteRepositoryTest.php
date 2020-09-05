<?php namespace Tests\Repositories;

use App\Models\TypeCompte;
use App\Repositories\TypeCompteRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class TypeCompteRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var TypeCompteRepository
     */
    protected $typeCompteRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->typeCompteRepo = \App::make(TypeCompteRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_type_compte()
    {
        $typeCompte = factory(TypeCompte::class)->make()->toArray();

        $createdTypeCompte = $this->typeCompteRepo->create($typeCompte);

        $createdTypeCompte = $createdTypeCompte->toArray();
        $this->assertArrayHasKey('id', $createdTypeCompte);
        $this->assertNotNull($createdTypeCompte['id'], 'Created TypeCompte must have id specified');
        $this->assertNotNull(TypeCompte::find($createdTypeCompte['id']), 'TypeCompte with given id must be in DB');
        $this->assertModelData($typeCompte, $createdTypeCompte);
    }

    /**
     * @test read
     */
    public function test_read_type_compte()
    {
        $typeCompte = factory(TypeCompte::class)->create();

        $dbTypeCompte = $this->typeCompteRepo->find($typeCompte->id);

        $dbTypeCompte = $dbTypeCompte->toArray();
        $this->assertModelData($typeCompte->toArray(), $dbTypeCompte);
    }

    /**
     * @test update
     */
    public function test_update_type_compte()
    {
        $typeCompte = factory(TypeCompte::class)->create();
        $fakeTypeCompte = factory(TypeCompte::class)->make()->toArray();

        $updatedTypeCompte = $this->typeCompteRepo->update($fakeTypeCompte, $typeCompte->id);

        $this->assertModelData($fakeTypeCompte, $updatedTypeCompte->toArray());
        $dbTypeCompte = $this->typeCompteRepo->find($typeCompte->id);
        $this->assertModelData($fakeTypeCompte, $dbTypeCompte->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_type_compte()
    {
        $typeCompte = factory(TypeCompte::class)->create();

        $resp = $this->typeCompteRepo->delete($typeCompte->id);

        $this->assertTrue($resp);
        $this->assertNull(TypeCompte::find($typeCompte->id), 'TypeCompte should not exist in DB');
    }
}
