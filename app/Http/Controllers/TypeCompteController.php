<?php

namespace App\Http\Controllers;

use App\DataTables\TypeCompteDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateTypeCompteRequest;
use App\Http\Requests\UpdateTypeCompteRequest;
use App\Repositories\TypeCompteRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class TypeCompteController extends AppBaseController
{
    /** @var  TypeCompteRepository */
    private $typeCompteRepository;

    public function __construct(TypeCompteRepository $typeCompteRepo)
    {
        $this->typeCompteRepository = $typeCompteRepo;
    }

    /**
     * Display a listing of the TypeCompte.
     *
     * @param TypeCompteDataTable $typeCompteDataTable
     * @return Response
     */
    public function index(TypeCompteDataTable $typeCompteDataTable)
    {
        return $typeCompteDataTable->render('type_comptes.index');
    }

    /**
     * Show the form for creating a new TypeCompte.
     *
     * @return Response
     */
    public function create()
    {
        return view('type_comptes.create');
    }

    /**
     * Store a newly created TypeCompte in storage.
     *
     * @param CreateTypeCompteRequest $request
     *
     * @return Response
     */
    public function store(CreateTypeCompteRequest $request)
    {
        $input = $request->all();

        $typeCompte = $this->typeCompteRepository->create($input);

        Flash::success('Type Compte saved successfully.');

        return redirect(route('typeComptes.index'));
    }

    /**
     * Display the specified TypeCompte.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $typeCompte = $this->typeCompteRepository->find($id);

        if (empty($typeCompte)) {
            Flash::error('Type Compte not found');

            return redirect(route('typeComptes.index'));
        }

        return view('type_comptes.show')->with('typeCompte', $typeCompte);
    }

    /**
     * Show the form for editing the specified TypeCompte.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $typeCompte = $this->typeCompteRepository->find($id);

        if (empty($typeCompte)) {
            Flash::error('Type Compte not found');

            return redirect(route('typeComptes.index'));
        }

        return view('type_comptes.edit')->with('typeCompte', $typeCompte);
    }

    /**
     * Update the specified TypeCompte in storage.
     *
     * @param  int              $id
     * @param UpdateTypeCompteRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTypeCompteRequest $request)
    {
        $typeCompte = $this->typeCompteRepository->find($id);

        if (empty($typeCompte)) {
            Flash::error('Type Compte not found');

            return redirect(route('typeComptes.index'));
        }

        $typeCompte = $this->typeCompteRepository->update($request->all(), $id);

        Flash::success('Type Compte updated successfully.');

        return redirect(route('typeComptes.index'));
    }

    /**
     * Remove the specified TypeCompte from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $typeCompte = $this->typeCompteRepository->find($id);

        if (empty($typeCompte)) {
            Flash::error('Type Compte not found');

            return redirect(route('typeComptes.index'));
        }

        $this->typeCompteRepository->delete($id);

        Flash::success('Type Compte deleted successfully.');

        return redirect(route('typeComptes.index'));
    }
}
