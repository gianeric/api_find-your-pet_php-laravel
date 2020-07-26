<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pet;
use App\Http\Requests\PetRequest;
use Exception;
use App\Http\Resources\Pet as PetResource;
use App\Http\Resources\PetCollection;

class PetController extends Controller
{
    protected $model;
    /**
     * @var use App\Models\Pet
     */

    public function __construct(Pet $pet)
    {
        $this->model = $pet;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Pet $pet)
    {
        //$pets = $this->model->all();
        try {
            $pets = $pet->all();
            $petsCollection = new PetCollection($pets);
            return response()->json($petsCollection, 200);
        } catch (\Exception $erro) {
            return response()->json([
                'title' => 'Erro',
                'msg' => 'Erro interno no servidor'
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\PetRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PetRequest $request)
    {
        try {
            $pets = new Pet();
            $pets->fill($request->all());
            $pets->save();
            $petResource = new PetResource($pets);

            return response()->json($petResource, 201);
        } catch (Exception $e) {
            return response()->json([
                'title' => 'Erro',
                'msg' => 'Erro interno do servidor'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $pets = $this->model->findOrFail($id);
            $petResource = new PetResource($pets);
            return response()->json($petResource);
        } catch (Exception $e) {
            return response()->json([
                'title' => 'Erro',
                'msg' => 'Erro interno do servidor'
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\PetRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PetRequest $request, $id)
    {
        try {
            $pets = $this->model->findOrFail($id);
            $pets->fill($request->all());

            $pets->save();
            return response()->json($pets, 200);
        } catch (Exception $e) {
            return response()->json([
                'title' => 'Erro',
                'msg' => 'Erro interno do servidor'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $pets = $this->model->find($id);

            if ($pets === null) {
                return response()->Json([
                    'title' => 'Aviso',
                    'msg' => 'Pet não encontrado.'
                ], 404);
            } else {
                $pets->delete();
                return response()->Json([
                    'title' => 'Mensagem',
                    'msg' => 'Pet deletado com sucesso.'
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json([
                'title' => 'Erro',
                'msg' => 'Erro interno do servidor'
            ], 500);
        }
    }
}
