<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCompteAPIRequest;
use App\Http\Requests\API\UpdateCompteAPIRequest;
use App\Models\Compte;
use App\Repositories\CompteRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class CompteController
 * @package App\Http\Controllers\API
 */

class CompteAPIController extends AppBaseController
{
    /** @var  CompteRepository */
    private $compteRepository;

    public function __construct(CompteRepository $compteRepo)
    {
        $this->compteRepository = $compteRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/comptes",
     *      summary="Get a listing of the Comptes.",
     *      tags={"Compte"},
     *      description="Get all Comptes",
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
     *                  @SWG\Items(ref="#/definitions/Compte")
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
        $comptes = $this->compteRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($comptes->toArray(), 'Comptes retrieved successfully');
    }

    /**
     * @param CreateCompteAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/comptes",
     *      summary="Store a newly created Compte in storage",
     *      tags={"Compte"},
     *      description="Store Compte",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Compte that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Compte")
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
     *                  ref="#/definitions/Compte"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateCompteAPIRequest $request)
    {
        $input = $request->all();

        $compte = $this->compteRepository->create($input);

        return $this->sendResponse($compte->toArray(), 'Compte saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/comptes/{id}",
     *      summary="Display the specified Compte",
     *      tags={"Compte"},
     *      description="Get Compte",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Compte",
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
     *                  ref="#/definitions/Compte"
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
        /** @var Compte $compte */
        $compte = $this->compteRepository->find($id);

        if (empty($compte)) {
            return $this->sendError('Compte not found');
        }

        return $this->sendResponse($compte->toArray(), 'Compte retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateCompteAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/comptes/{id}",
     *      summary="Update the specified Compte in storage",
     *      tags={"Compte"},
     *      description="Update Compte",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Compte",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Compte that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Compte")
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
     *                  ref="#/definitions/Compte"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateCompteAPIRequest $request)
    {
        $input = $request->all();

        /** @var Compte $compte */
        $compte = $this->compteRepository->find($id);

        if (empty($compte)) {
            return $this->sendError('Compte not found');
        }

        $compte = $this->compteRepository->update($input, $id);

        return $this->sendResponse($compte->toArray(), 'Compte updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/comptes/{id}",
     *      summary="Remove the specified Compte from storage",
     *      tags={"Compte"},
     *      description="Delete Compte",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Compte",
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
        /** @var Compte $compte */
        $compte = $this->compteRepository->find($id);

        if (empty($compte)) {
            return $this->sendError('Compte not found');
        }

        $compte->delete();

        return $this->sendSuccess('Compte deleted successfully');
    }
}
