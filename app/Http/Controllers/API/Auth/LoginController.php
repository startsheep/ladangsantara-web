<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Auth\LoginRequest;
use App\Http\Traits\MessageFixer;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    use MessageFixer;

    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function __invoke(LoginRequest $request)
    {
        DB::beginTransaction();

        $user = $this->user->where('email', $request->email)->first();

        if (!Hash::check($request->password, $user->password)) {
            return $this->customMessage('WARNING', ['password' => ['password anda salah']], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $tokenName = 'api';
            $scopes = [$user->role->name];

            $user->tokens()->where('name', $tokenName)->delete();

            $token = $user->createToken('api', $scopes)->plainTextToken;

            DB::commit();
            return $this->successMessage("login berhasil", $user, $token);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->errorMessage($th->getMessage());
        }
    }
}
