<?php namespace Tests\Repositories;

use App\Models\TypeOperation;
use App\Repositories\TypeOperationRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class TypeOperationRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var TypeOperationRepository
     */
    protected $typeOperationRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->typeOperationRepo = \App::make(TypeOperationRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_type_operation()
    {
        $typeOperation = factory(TypeOperation::class)->make()->toArray();

        $createdTypeOperation = $this->typeOperationRepo->create($typeOperation);

        $createdTypeOperation = $createdTypeOperation->toArray();
        $this->assertArrayHasKey('id', $createdTypeOperation);
        $this->assertNotNull($createdTypeOperation['id'], 'Created TypeOperation must have id specified');
        $this->assertNotNull(TypeOperation::find($createdTypeOperation['id']), 'TypeOperation with given id must be in DB');
        $this->assertModelData($typeOperation, $createdTypeOperation);
    }

    /**
     * @test read
     */
    public function test_read_type_operation()
    {
        $typeOperation = factory(TypeOperation::class)->create();

        $dbTypeOperation = $this->typeOperationRepo->find($typeOperation->id);

        $dbTypeOperation = $dbTypeOperation->toArray();
        $this->assertModelData($typeOperation->toArray(), $dbTypeOperation);
    }

    /**
     * @test update
     */
    public function test_update_type_operation()
    {
        $typeOperation = factory(TypeOperation::class)->create();
        $fakeTypeOperation = factory(TypeOperation::class)->make()->toArray();

        $updatedTypeOperation = $this->typeOperationRepo->update($fakeTypeOperation, $typeOperation->id);

        $this->assertModelData($fakeTypeOperation, $updatedTypeOperation->toArray());
        $dbTypeOperation = $this->typeOperationRepo->find($typeOperation->id);
        $this->assertModelData($fakeTypeOperation, $dbTypeOperation->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_type_operation()
    {
        $typeOperation = factory(TypeOperation::class)->create();

        $resp = $this->typeOperationRepo->delete($typeOperation->id);

        $this->assertTrue($resp);
        $this->assertNull(TypeOperation::find($typeOperation->id), 'TypeOperation should not exist in DB');
    }
}
