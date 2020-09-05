<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateOperationAPIRequest;
use App\Http\Requests\API\UpdateOperationAPIRequest;
use App\Models\Operation;
use App\Repositories\OperationRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class OperationController
 * @package App\Http\Controllers\API
 */

class OperationAPIController extends AppBaseController
{
    /** @var  OperationRepository */
    private $operationRepository;

    public function __construct(OperationRepository $operationRepo)
    {
        $this->operationRepository = $operationRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/operations",
     *      summary="Get a listing of the Operations.",
     *      tags={"Operation"},
     *      description="Get all Operations",
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
     *                  @SWG\Items(ref="#/definitions/Operation")
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
        $operations = $this->operationRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($operations->toArray(), 'Operations retrieved successfully');
    }

    /**
     * @param CreateOperationAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/operations",
     *      summary="Store a newly created Operation in storage",
     *      tags={"Operation"},
     *      description="Store Operation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Operation that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Operation")
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
     *                  ref="#/definitions/Operation"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateOperationAPIRequest $request)
    {
        $input = $request->all();

        $operation = $this->operationRepository->create($input);

        return $this->sendResponse($operation->toArray(), 'Operation saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/operations/{id}",
     *      summary="Display the specified Operation",
     *      tags={"Operation"},
     *      description="Get Operation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Operation",
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
     *                  ref="#/definitions/Operation"
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
        /** @var Operation $operation */
        $operation = $this->operationRepository->find($id);

        if (empty($operation)) {
            return $this->sendError('Operation not found');
        }

        return $this->sendResponse($operation->toArray(), 'Operation retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateOperationAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/operations/{id}",
     *      summary="Update the specified Operation in storage",
     *      tags={"Operation"},
     *      description="Update Operation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Operation",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Operation that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Operation")
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
     *                  ref="#/definitions/Operation"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateOperationAPIRequest $request)
    {
        $input = $request->all();

        /** @var Operation $operation */
        $operation = $this->operationRepository->find($id);

        if (empty($operation)) {
            return $this->sendError('Operation not found');
        }

        $operation = $this->operationRepository->update($input, $id);

        return $this->sendResponse($operation->toArray(), 'Operation updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/operations/{id}",
     *      summary="Remove the specified Operation from storage",
     *      tags={"Operation"},
     *      description="Delete Operation",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Operation",
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
        /** @var Operation $operation */
        $operation = $this->operationRepository->find($id);

        if (empty($operation)) {
            return $this->sendError('Operation not found');
        }

        $operation->delete();

        return $this->sendSuccess('Operation deleted successfully');
    }
}
