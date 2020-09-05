<?php namespace Tests\Repositories;

use App\Models\TypeOpeartion;
use App\Repositories\TypeOpeartionRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class TypeOpeartionRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var TypeOpeartionRepository
     */
    protected $typeOpeartionRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->typeOpeartionRepo = \App::make(TypeOpeartionRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_type_opeartion()
    {
        $typeOpeartion = factory(TypeOpeartion::class)->make()->toArray();

        $createdTypeOpeartion = $this->typeOpeartionRepo->create($typeOpeartion);

        $createdTypeOpeartion = $createdTypeOpeartion->toArray();
        $this->assertArrayHasKey('id', $createdTypeOpeartion);
        $this->assertNotNull($createdTypeOpeartion['id'], 'Created TypeOpeartion must have id specified');
        $this->assertNotNull(TypeOpeartion::find($createdTypeOpeartion['id']), 'TypeOpeartion with given id must be in DB');
        $this->assertModelData($typeOpeartion, $createdTypeOpeartion);
    }

    /**
     * @test read
     */
    public function test_read_type_opeartion()
    {
        $typeOpeartion = factory(TypeOpeartion::class)->create();

        $dbTypeOpeartion = $this->typeOpeartionRepo->find($typeOpeartion->id);

        $dbTypeOpeartion = $dbTypeOpeartion->toArray();
        $this->assertModelData($typeOpeartion->toArray(), $dbTypeOpeartion);
    }

    /**
     * @test update
     */
    public function test_update_type_opeartion()
    {
        $typeOpeartion = factory(TypeOpeartion::class)->create();
        $fakeTypeOpeartion = factory(TypeOpeartion::class)->make()->toArray();

        $updatedTypeOpeartion = $this->typeOpeartionRepo->update($fakeTypeOpeartion, $typeOpeartion->id);

        $this->assertModelData($fakeTypeOpeartion, $updatedTypeOpeartion->toArray());
        $dbTypeOpeartion = $this->typeOpeartionRepo->find($typeOpeartion->id);
        $this->assertModelData($fakeTypeOpeartion, $dbTypeOpeartion->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_type_opeartion()
    {
        $typeOpeartion = factory(TypeOpeartion::class)->create();

        $resp = $this->typeOpeartionRepo->delete($typeOpeartion->id);

        $this->assertTrue($resp);
        $this->assertNull(TypeOpeartion::find($typeOpeartion->id), 'TypeOpeartion should not exist in DB');
    }
}
