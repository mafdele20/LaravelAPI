<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateTypeOpeartionAPIRequest;
use App\Http\Requests\API\UpdateTypeOpeartionAPIRequest;
use App\Models\TypeOpeartion;
use App\Repositories\TypeOpeartionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class TypeOpeartionController
 * @package App\Http\Controllers\API
 */

class TypeOpeartionAPIController extends AppBaseController
{
    /** @var  TypeOpeartionRepository */
    private $typeOpeartionRepository;

    public function __construct(TypeOpeartionRepository $typeOpeartionRepo)
    {
        $this->typeOpeartionRepository = $typeOpeartionRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/typeOpeartions",
     *      summary="Get a listing of the TypeOpeartions.",
     *      tags={"TypeOpeartion"},
     *      description="Get all TypeOpeartions",
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
     *                  @SWG\Items(ref="#/definitions/TypeOpeartion")
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
        $typeOpeartions = $this->typeOpeartionRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($typeOpeartions->toArray(), 'Type Opeartions retrieved successfully');
    }

    /**
     * @param CreateTypeOpeartionAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/typeOpeartions",
     *      summary="Store a newly created TypeOpeartion in storage",
     *      tags={"TypeOpeartion"},
     *      description="Store TypeOpeartion",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="TypeOpeartion that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/TypeOpeartion")
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
     *                  ref="#/definitions/TypeOpeartion"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateTypeOpeartionAPIRequest $request)
    {
        $input = $request->all();

        $typeOpeartion = $this->typeOpeartionRepository->create($input);

        return $this->sendResponse($typeOpeartion->toArray(), 'Type Opeartion saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/typeOpeartions/{id}",
     *      summary="Display the specified TypeOpeartion",
     *      tags={"TypeOpeartion"},
     *      description="Get TypeOpeartion",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of TypeOpeartion",
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
     *                  ref="#/definitions/TypeOpeartion"
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
        /** @var TypeOpeartion $typeOpeartion */
        $typeOpeartion = $this->typeOpeartionRepository->find($id);

        if (empty($typeOpeartion)) {
            return $this->sendError('Type Opeartion not found');
        }

        return $this->sendResponse($typeOpeartion->toArray(), 'Type Opeartion retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateTypeOpeartionAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/typeOpeartions/{id}",
     *      summary="Update the specified TypeOpeartion in storage",
     *      tags={"TypeOpeartion"},
     *      description="Update TypeOpeartion",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of TypeOpeartion",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="TypeOpeartion that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/TypeOpeartion")
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
     *                  ref="#/definitions/TypeOpeartion"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateTypeOpeartionAPIRequest $request)
    {
        $input = $request->all();

        /** @var TypeOpeartion $typeOpeartion */
        $typeOpeartion = $this->typeOpeartionRepository->find($id);

        if (empty($typeOpeartion)) {
            return $this->sendError('Type Opeartion not found');
        }

        $typeOpeartion = $this->typeOpeartionRepository->update($input, $id);

        return $this->sendResponse($typeOpeartion->toArray(), 'TypeOpeartion updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/typeOpeartions/{id}",
     *      summary="Remove the specified TypeOpeartion from storage",
     *      tags={"TypeOpeartion"},
     *      description="Delete TypeOpeartion",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of TypeOpeartion",
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
        /** @var TypeOpeartion $typeOpeartion */
        $typeOpeartion = $this->typeOpeartionRepository->find($id);

        if (empty($typeOpeartion)) {
            return $this->sendError('Type Opeartion not found');
        }

        $typeOpeartion->delete();

        return $this->sendSuccess('Type Opeartion deleted successfully');
    }
}
