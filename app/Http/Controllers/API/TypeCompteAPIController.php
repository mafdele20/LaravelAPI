<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateTypeCompteAPIRequest;
use App\Http\Requests\API\UpdateTypeCompteAPIRequest;
use App\Models\TypeCompte;
use App\Repositories\TypeCompteRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class TypeCompteController
 * @package App\Http\Controllers\API
 */

class TypeCompteAPIController extends AppBaseController
{
    /** @var  TypeCompteRepository */
    private $typeCompteRepository;

    public function __construct(TypeCompteRepository $typeCompteRepo)
    {
        $this->typeCompteRepository = $typeCompteRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/typeComptes",
     *      summary="Get a listing of the TypeComptes.",
     *      tags={"TypeCompte"},
     *      description="Get all TypeComptes",
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
     *                  @SWG\Items(ref="#/definitions/TypeCompte")
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
        $typeComptes = $this->typeCompteRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($typeComptes->toArray(), 'Type Comptes retrieved successfully');
    }

    /**
     * @param CreateTypeCompteAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/typeComptes",
     *      summary="Store a newly created TypeCompte in storage",
     *      tags={"TypeCompte"},
     *      description="Store TypeCompte",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="TypeCompte that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/TypeCompte")
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
     *                  ref="#/definitions/TypeCompte"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateTypeCompteAPIRequest $request)
    {
        $input = $request->all();

        $typeCompte = $this->typeCompteRepository->create($input);

        return $this->sendResponse($typeCompte->toArray(), 'Type Compte saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/typeComptes/{id}",
     *      summary="Display the specified TypeCompte",
     *      tags={"TypeCompte"},
     *      description="Get TypeCompte",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of TypeCompte",
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
     *                  ref="#/definitions/TypeCompte"
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
        /** @var TypeCompte $typeCompte */
        $typeCompte = $this->typeCompteRepository->find($id);

        if (empty($typeCompte)) {
            return $this->sendError('Type Compte not found');
        }

        return $this->sendResponse($typeCompte->toArray(), 'Type Compte retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateTypeCompteAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/typeComptes/{id}",
     *      summary="Update the specified TypeCompte in storage",
     *      tags={"TypeCompte"},
     *      description="Update TypeCompte",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of TypeCompte",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="TypeCompte that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/TypeCompte")
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
     *                  ref="#/definitions/TypeCompte"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateTypeCompteAPIRequest $request)
    {
        $input = $request->all();

        /** @var TypeCompte $typeCompte */
        $typeCompte = $this->typeCompteRepository->find($id);

        if (empty($typeCompte)) {
            return $this->sendError('Type Compte not found');
        }

        $typeCompte = $this->typeCompteRepository->update($input, $id);

        return $this->sendResponse($typeCompte->toArray(), 'TypeCompte updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/typeComptes/{id}",
     *      summary="Remove the specified TypeCompte from storage",
     *      tags={"TypeCompte"},
     *      description="Delete TypeCompte",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of TypeCompte",
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
        /** @var TypeCompte $typeCompte */
        $typeCompte = $this->typeCompteRepository->find($id);

        if (empty($typeCompte)) {
            return $this->sendError('Type Compte not found');
        }

        $typeCompte->delete();

        return $this->sendSuccess('Type Compte deleted successfully');
    }
}
