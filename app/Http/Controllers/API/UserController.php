<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use Illuminate\Database\Console\Migrations\StatusCommand;
use Correios;
use App\Http\Resources\UserCollection;

class UserController extends Controller
{

    protected $model;
    /**
     * @var use App\Models\User
     */

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->model->all();
        $usersCollection = new UserCollection($users);
        return response()->json($usersCollection, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        try {
            $address = \Correios::cep($request->cep);

            if (empty($address)) {
                return response()->Json([
                    'title' => 'Aviso',
                    'msg' => 'Cep não encontrado.'
                ], 404);
            } else {
                $user = new User();
                $user->fill($request->all());        
                $user->save();
                return response()->json($user, 201);
            }
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
            $users = $this->model->findOrFail($id);
            return response()->json($users);
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        try {
            $address = \Correios::cep($request->cep);

            if (empty($address)) {
                return response()->Json([
                    'title' => 'Aviso',
                    'msg' => 'Cep não encontrado.'
                ], 404);
            } else {
                $user = $this->model->find($id);
                $user->fill($request->all());

                $user->save();
                return response()->json($user, 200);
            }
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
            $users = $this->model->find($id);

            if ($users === null) {
                return response()->Json([
                    'title' => 'Aviso',
                    'msg' => 'Usuário não encontrado.'
                ], 404);
            } else {
                $users->delete();
                return response()->Json([
                    'title' => 'Mensagem',
                    'msg' => 'Usuário deletado com sucesso.'
                ], 404);
            }
        } catch (Exception $e) {
            return response()->json([
                'title' => 'Erro',
                'msg' => 'Erro interno do servidor'
            ], 500);
        }
    }
}
