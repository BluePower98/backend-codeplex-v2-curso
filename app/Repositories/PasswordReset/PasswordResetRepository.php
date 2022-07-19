<?php

namespace App\Repositories\PasswordReset;

use App\Models\PasswordReset;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PasswordResetRepository implements PasswordResetRepositoryInterface
{
    private PasswordReset $model;

    public function __construct(PasswordReset $passwordReset)
    {
        $this->model = $passwordReset;
    }

    /**
     * @param string $email
     * @return PasswordReset
     */
    public function create(string $email): PasswordReset
    {
        return $this->model->create([
            'email' => $email,
            'token' => Str::random(150),
            'created_at' => Carbon::now()
        ]);
    }

    /**
     * @param string $token
     * @return PasswordReset|null
     */
    public function findOneByToken(string $token): ?PasswordReset
    {
        return $this->model->query()->where('token', $token)->first();
    }

    /**
     * @param string $token
     * @return void
     */
    public function removeByToken(string $token): void
    {
        $table = $this->model->getTable();

        DB::table($table)->where('token', $token)->delete();
    }
}
