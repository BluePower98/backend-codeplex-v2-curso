<?php

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Helpers\QueryHelper;

class UserRepository implements UserRepositoryInterface
{

    private User $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    /**
     * Get user by id.
     *
     * @param int $id
     * @return User|null
     */
    public function findOneById(int $id): ?User
    {
        return $this->model->query()
            ->where('idusuario', (string) $id)
            ->first();
    }

    /**
     * Get user by email.
     *
     * @param string $email
     * @return User|null
     */
    public function findOneByEmail(string $email): ?User
    {
        return $this->model->query()
            ->where('loglogin', $email)
            ->first();
    }

    /**
     * Get user by verification email code.
     *
     * @param string $token
     * @return User|null
     */
    public function findOneByVerificationEmailCode(string $token): ?User
    {
        return $this->model->query()->where(['email_verificacion_codigo' => $token])->first();
    }

    /**
     * @param array $params
     * @return void
     */
    public function create(array $params): void
    {
        $address = array_key_exists('direccion', $params) ? $params['direccion'] : null;
        $moduleId = array_key_exists('idmodulo', $params) ? $params['idmodulo'] : null;
        $planDetailId = array_key_exists('idplandetalle', $params) ? $params['idplandetalle'] : null;

        DB::select('Exec Lo_Man_zg_usuarios2 ?,?,?,?,?,?,?,?,?,?,?,?',
            [
                'M01',
                null,
                $params['nombre'],
                $params['telefono'],
                $params['email'],
                Hash::make($params['password']),
                $params['ruc'],
                $params['razon'],
                $address,
                $moduleId,
                $params['idplan'],
                $planDetailId
            ]
        );
    }

    /**
     * Update User by id.
     *
     * @param array $params
     * @param int $id
     * @return int|null
     */
    public function update(array $params, int $id): ?int
    {
        if (array_key_exists('logclave', $params)) {
            $params['logclave'] = Hash::make($params['logclave']);
        }

        return $this->model->where('idusuario', (string) $id)->update($params);
    }

    /**
     * @param User $user
     * @return void
     */
    public function generateVerificationEmailCode(User $user): void
    {
        $token = Str::random(32);

        $user->email_verificacion_codigo = $token;
        $this->update(['email_verificacion_codigo' => $token], $user->getKey());
    }

    public function hello(): string
    {
        return "Hola Luiggi";
    }

    public function updateToken(array $param):void
    {
        // dd(($params['idusuario'])?$params['idusuario']:'');
        $procedureDefinitions = QueryHelper::generateSyntaxPHPToProcedureParams(15);
        $params = QueryHelper::mergeValuesFromProcedureParams(['M04'], $procedureDefinitions);
        $countParams = count($params);
        $params[$countParams - 14] =($param['idusuario'])?$param['idusuario']:'';
        $params[$countParams - 2] =($param['token_beta'])?$param['token_beta']:'';
        $params[$countParams - 1] =($param['token_estable'])?$param['token_estable']:'';
        $result=DB::statement("EXEC Man_zg_usuarios {$procedureDefinitions}",$params);

    }

    public function showtoken(string $iduser):array
    {
        
        $procedureDefinitions = QueryHelper::generateSyntaxPHPToProcedureParams(15);
        $params = QueryHelper::mergeValuesFromProcedureParams(['S03'], $procedureDefinitions);
        $countParams = count($params);
        $params[$countParams - 14] =$iduser;

        $result=DB::select("EXEC Man_zg_usuarios {$procedureDefinitions}",$params);
        // dd($result);
        return $result;
    }
}
