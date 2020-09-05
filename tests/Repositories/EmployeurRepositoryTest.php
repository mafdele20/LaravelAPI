<?php namespace Tests\Repositories;

use App\Models\Employeur;
use App\Repositories\EmployeurRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class EmployeurRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var EmployeurRepository
     */
    protected $employeurRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->employeurRepo = \App::make(EmployeurRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_employeur()
    {
        $employeur = factory(Employeur::class)->make()->toArray();

        $createdEmployeur = $this->employeurRepo->create($employeur);

        $createdEmployeur = $createdEmployeur->toArray();
        $this->assertArrayHasKey('id', $createdEmployeur);
        $this->assertNotNull($createdEmployeur['id'], 'Created Employeur must have id specified');
        $this->assertNotNull(Employeur::find($createdEmployeur['id']), 'Employeur with given id must be in DB');
        $this->assertModelData($employeur, $createdEmployeur);
    }

    /**
     * @test read
     */
    public function test_read_employeur()
    {
        $employeur = factory(Employeur::class)->create();

        $dbEmployeur = $this->employeurRepo->find($employeur->id);

        $dbEmployeur = $dbEmployeur->toArray();
        $this->assertModelData($employeur->toArray(), $dbEmployeur);
    }

    /**
     * @test update
     */
    public function test_update_employeur()
    {
        $employeur = factory(Employeur::class)->create();
        $fakeEmployeur = factory(Employeur::class)->make()->toArray();

        $updatedEmployeur = $this->employeurRepo->update($fakeEmployeur, $employeur->id);

        $this->assertModelData($fakeEmployeur, $updatedEmployeur->toArray());
        $dbEmployeur = $this->employeurRepo->find($employeur->id);
        $this->assertModelData($fakeEmployeur, $dbEmployeur->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_employeur()
    {
        $employeur = factory(Employeur::class)->create();

        $resp = $this->employeurRepo->delete($employeur->id);

        $this->assertTrue($resp);
        $this->assertNull(Employeur::find($employeur->id), 'Employeur should not exist in DB');
    }
}
