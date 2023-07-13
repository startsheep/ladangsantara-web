<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Auth\RegisterRequest;
use App\Http\Traits\MessageFixer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    use MessageFixer;

    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function __invoke(RegisterRequest $request)
    {
        DB::beginTransaction();

        $request->merge([
            'password' => Hash::make($request->password),
            'role_id' => User::MEMBER
        ]);

        try {
            $user = $this->user->create($request->all());

            DB::commit();
            return $this->successMessage("register berhasil", $user);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->errorMessage($th->getMessage());
        }
    }
}
