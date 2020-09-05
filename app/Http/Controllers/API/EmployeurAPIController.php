<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateEmployeurAPIRequest;
use App\Http\Requests\API\UpdateEmployeurAPIRequest;
use App\Models\Employeur;
use App\Repositories\EmployeurRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class EmployeurController
 * @package App\Http\Controllers\API
 */

class EmployeurAPIController extends AppBaseController
{
    /** @var  EmployeurRepository */
    private $employeurRepository;

    public function __construct(EmployeurRepository $employeurRepo)
    {
        $this->employeurRepository = $employeurRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/employeurs",
     *      summary="Get a listing of the Employeurs.",
     *      tags={"Employeur"},
     *      description="Get all Employeurs",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/Employeur")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $employeurs = $this->employeurRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($employeurs->toArray(), 'Employeurs retrieved successfully');
    }

    /**
     * @param CreateEmployeurAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/employeurs",
     *      summary="Store a newly created Employeur in storage",
     *      tags={"Employeur"},
     *      description="Store Employeur",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Employeur that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Employeur")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Employeur"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateEmployeurAPIRequest $request)
    {
        $input = $request->all();

        $employeur = $this->employeurRepository->create($input);

        return $this->sendResponse($employeur->toArray(), 'Employeur saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/employeurs/{id}",
     *      summary="Display the specified Employeur",
     *      tags={"Employeur"},
     *      description="Get Employeur",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Employeur",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Employeur"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var Employeur $employeur */
        $employeur = $this->employeurRepository->find($id);

        if (empty($employeur)) {
            return $this->sendError('Employeur not found');
        }

        return $this->sendResponse($employeur->toArray(), 'Employeur retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateEmployeurAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/employeurs/{id}",
     *      summary="Update the specified Employeur in storage",
     *      tags={"Employeur"},
     *      description="Update Employeur",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Employeur",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Employeur that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Employeur")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Employeur"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateEmployeurAPIRequest $request)
    {
        $input = $request->all();

        /** @var Employeur $employeur */
        $employeur = $this->employeurRepository->find($id);

        if (empty($employeur)) {
            return $this->sendError('Employeur not found');
        }

        $employeur = $this->employeurRepository->update($input, $id);

        return $this->sendResponse($employeur->toArray(), 'Employeur updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/employeurs/{id}",
     *      summary="Remove the specified Employeur from storage",
     *      tags={"Employeur"},
     *      description="Delete Employeur",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Employeur",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var Employeur $employeur */
        $employeur = $this->employeurRepository->find($id);

        if (empty($employeur)) {
            return $this->sendError('Employeur not found');
        }

        $employeur->delete();

        return $this->sendSuccess('Employeur deleted successfully');
    }
}
