<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateTypeOperationAPIRequest;
use App\Http\Requests\API\UpdateTypeOperationAPIRequest;
use App\Models\TypeOperation;
use App\Repositories\TypeOperationRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class TypeOperationController
 * @package App\Http\Controllers\API
 */

class TypeOperationAPIController extends AppBaseController
{
    /** @var  TypeOperationRepository */
    private $typeOperationRepository;

    public function __construct(TypeOperationRepository $typeOperationRepo)
    {
        $this->typeOperationRepository = $typeOperationRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/typeOperations",
     *      summary="Get a listing of the TypeOperations.",
     *      tags={"TypeOperation"},
     *      description="Get all TypeOperations",
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
     *                  @SWG\Items(ref="#/definitions/TypeOperation")
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
        $typeOperations = $this->typeOperationRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($typeOperations->toArray(), 'Type Operations retrieved successfully');
    }

    /**
     * @param CreateTypeOperationAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/typeOperations",
     *      summary="Store a newly created TypeOperation in storage",
     *      tags={"TypeOperation"},
     *      description="Store TypeOperation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="TypeOperation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/TypeOperation")
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
     *                  ref="#/definitions/TypeOperation"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateTypeOperationAPIRequest $request)
    {
        $input = $request->all();

        $typeOperation = $this->typeOperationRepository->create($input);

        return $this->sendResponse($typeOperation->toArray(), 'Type Operation saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/typeOperations/{id}",
     *      summary="Display the specified TypeOperation",
     *      tags={"TypeOperation"},
     *      description="Get TypeOperation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of TypeOperation",
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
     *                  ref="#/definitions/TypeOperation"
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
        /** @var TypeOperation $typeOperation */
        $typeOperation = $this->typeOperationRepository->find($id);

        if (empty($typeOperation)) {
            return $this->sendError('Type Operation not found');
        }

        return $this->sendResponse($typeOperation->toArray(), 'Type Operation retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateTypeOperationAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/typeOperations/{id}",
     *      summary="Update the specified TypeOperation in storage",
     *      tags={"TypeOperation"},
     *      description="Update TypeOperation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of TypeOperation",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="TypeOperation that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/TypeOperation")
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
     *                  ref="#/definitions/TypeOperation"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateTypeOperationAPIRequest $request)
    {
        $input = $request->all();

        /** @var TypeOperation $typeOperation */
        $typeOperation = $this->typeOperationRepository->find($id);

        if (empty($typeOperation)) {
            return $this->sendError('Type Operation not found');
        }

        $typeOperation = $this->typeOperationRepository->update($input, $id);

        return $this->sendResponse($typeOperation->toArray(), 'TypeOperation updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/typeOperations/{id}",
     *      summary="Remove the specified TypeOperation from storage",
     *      tags={"TypeOperation"},
     *      description="Delete TypeOperation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of TypeOperation",
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
        /** @var TypeOperation $typeOperation */
        $typeOperation = $this->typeOperationRepository->find($id);

        if (empty($typeOperation)) {
            return $this->sendError('Type Operation not found');
        }

        $typeOperation->delete();

        return $this->sendSuccess('Type Operation deleted successfully');
    }
}
