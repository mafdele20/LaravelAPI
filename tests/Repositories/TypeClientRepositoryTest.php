<?php namespace Tests\Repositories;

use App\Models\TypeClient;
use App\Repositories\TypeClientRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class TypeClientRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var TypeClientRepository
     */
    protected $typeClientRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->typeClientRepo = \App::make(TypeClientRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_type_client()
    {
        $typeClient = factory(TypeClient::class)->make()->toArray();

        $createdTypeClient = $this->typeClientRepo->create($typeClient);

        $createdTypeClient = $createdTypeClient->toArray();
        $this->assertArrayHasKey('id', $createdTypeClient);
        $this->assertNotNull($createdTypeClient['id'], 'Created TypeClient must have id specified');
        $this->assertNotNull(TypeClient::find($createdTypeClient['id']), 'TypeClient with given id must be in DB');
        $this->assertModelData($typeClient, $createdTypeClient);
    }

    /**
     * @test read
     */
    public function test_read_type_client()
    {
        $typeClient = factory(TypeClient::class)->create();

        $dbTypeClient = $this->typeClientRepo->find($typeClient->id);

        $dbTypeClient = $dbTypeClient->toArray();
        $this->assertModelData($typeClient->toArray(), $dbTypeClient);
    }

    /**
     * @test update
     */
    public function test_update_type_client()
    {
        $typeClient = factory(TypeClient::class)->create();
        $fakeTypeClient = factory(TypeClient::class)->make()->toArray();

        $updatedTypeClient = $this->typeClientRepo->update($fakeTypeClient, $typeClient->id);

        $this->assertModelData($fakeTypeClient, $updatedTypeClient->toArray());
        $dbTypeClient = $this->typeClientRepo->find($typeClient->id);
        $this->assertModelData($fakeTypeClient, $dbTypeClient->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_type_client()
    {
        $typeClient = factory(TypeClient::class)->create();

        $resp = $this->typeClientRepo->delete($typeClient->id);

        $this->assertTrue($resp);
        $this->assertNull(TypeClient::find($typeClient->id), 'TypeClient should not exist in DB');
    }
}
