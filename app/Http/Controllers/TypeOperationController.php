<?php

namespace App\Http\Controllers;

use App\DataTables\TypeOperationDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateTypeOperationRequest;
use App\Http\Requests\UpdateTypeOperationRequest;
use App\Repositories\TypeOperationRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class TypeOperationController extends AppBaseController
{
    /** @var  TypeOperationRepository */
    private $typeOperationRepository;

    public function __construct(TypeOperationRepository $typeOperationRepo)
    {
        $this->typeOperationRepository = $typeOperationRepo;
    }

    /**
     * Display a listing of the TypeOperation.
     *
     * @param TypeOperationDataTable $typeOperationDataTable
     * @return Response
     */
    public function index(TypeOperationDataTable $typeOperationDataTable)
    {
        return $typeOperationDataTable->render('type_operations.index');
    }

    /**
     * Show the form for creating a new TypeOperation.
     *
     * @return Response
     */
    public function create()
    {
        return view('type_operations.create');
    }

    /**
     * Store a newly created TypeOperation in storage.
     *
     * @param CreateTypeOperationRequest $request
     *
     * @return Response
     */
    public function store(CreateTypeOperationRequest $request)
    {
        $input = $request->all();

        $typeOperation = $this->typeOperationRepository->create($input);

        Flash::success('Type Operation saved successfully.');

        return redirect(route('typeOperations.index'));
    }

    /**
     * Display the specified TypeOperation.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $typeOperation = $this->typeOperationRepository->find($id);

        if (empty($typeOperation)) {
            Flash::error('Type Operation not found');

            return redirect(route('typeOperations.index'));
        }

        return view('type_operations.show')->with('typeOperation', $typeOperation);
    }

    /**
     * Show the form for editing the specified TypeOperation.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $typeOperation = $this->typeOperationRepository->find($id);

        if (empty($typeOperation)) {
            Flash::error('Type Operation not found');

            return redirect(route('typeOperations.index'));
        }

        return view('type_operations.edit')->with('typeOperation', $typeOperation);
    }

    /**
     * Update the specified TypeOperation in storage.
     *
     * @param  int              $id
     * @param UpdateTypeOperationRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTypeOperationRequest $request)
    {
        $typeOperation = $this->typeOperationRepository->find($id);

        if (empty($typeOperation)) {
            Flash::error('Type Operation not found');

            return redirect(route('typeOperations.index'));
        }

        $typeOperation = $this->typeOperationRepository->update($request->all(), $id);

        Flash::success('Type Operation updated successfully.');

        return redirect(route('typeOperations.index'));
    }

    /**
     * Remove the specified TypeOperation from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $typeOperation = $this->typeOperationRepository->find($id);

        if (empty($typeOperation)) {
            Flash::error('Type Operation not found');

            return redirect(route('typeOperations.index'));
        }

        $this->typeOperationRepository->delete($id);

        Flash::success('Type Operation deleted successfully.');

        return redirect(route('typeOperations.index'));
    }
}
