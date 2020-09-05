<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateTypeClientAPIRequest;
use App\Http\Requests\API\UpdateTypeClientAPIRequest;
use App\Models\TypeClient;
use App\Repositories\TypeClientRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class TypeClientController
 * @package App\Http\Controllers\API
 */

class TypeClientAPIController extends AppBaseController
{
    /** @var  TypeClientRepository */
    private $typeClientRepository;

    public function __construct(TypeClientRepository $typeClientRepo)
    {
        $this->typeClientRepository = $typeClientRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/typeClients",
     *      summary="Get a listing of the TypeClients.",
     *      tags={"TypeClient"},
     *      description="Get all TypeClients",
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
     *                  @SWG\Items(ref="#/definitions/TypeClient")
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
        $typeClients = $this->typeClientRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($typeClients->toArray(), 'Type Clients retrieved successfully');
    }

    /**
     * @param CreateTypeClientAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/typeClients",
     *      summary="Store a newly created TypeClient in storage",
     *      tags={"TypeClient"},
     *      description="Store TypeClient",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="TypeClient that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/TypeClient")
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
     *                  ref="#/definitions/TypeClient"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateTypeClientAPIRequest $request)
    {
        $input = $request->all();

        $typeClient = $this->typeClientRepository->create($input);

        return $this->sendResponse($typeClient->toArray(), 'Type Client saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/typeClients/{id}",
     *      summary="Display the specified TypeClient",
     *      tags={"TypeClient"},
     *      description="Get TypeClient",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of TypeClient",
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
     *                  ref="#/definitions/TypeClient"
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
        /** @var TypeClient $typeClient */
        $typeClient = $this->typeClientRepository->find($id);

        if (empty($typeClient)) {
            return $this->sendError('Type Client not found');
        }

        return $this->sendResponse($typeClient->toArray(), 'Type Client retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateTypeClientAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/typeClients/{id}",
     *      summary="Update the specified TypeClient in storage",
     *      tags={"TypeClient"},
     *      description="Update TypeClient",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of TypeClient",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="TypeClient that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/TypeClient")
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
     *                  ref="#/definitions/TypeClient"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateTypeClientAPIRequest $request)
    {
        $input = $request->all();

        /** @var TypeClient $typeClient */
        $typeClient = $this->typeClientRepository->find($id);

        if (empty($typeClient)) {
            return $this->sendError('Type Client not found');
        }

        $typeClient = $this->typeClientRepository->update($input, $id);

        return $this->sendResponse($typeClient->toArray(), 'TypeClient updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/typeClients/{id}",
     *      summary="Remove the specified TypeClient from storage",
     *      tags={"TypeClient"},
     *      description="Delete TypeClient",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of TypeClient",
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
        /** @var TypeClient $typeClient */
        $typeClient = $this->typeClientRepository->find($id);

        if (empty($typeClient)) {
            return $this->sendError('Type Client not found');
        }

        $typeClient->delete();

        return $this->sendSuccess('Type Client deleted successfully');
    }
}
