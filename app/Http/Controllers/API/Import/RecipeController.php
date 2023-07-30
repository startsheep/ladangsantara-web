<?php

namespace App\Http\Controllers\API\Import;

use App\Http\Controllers\Controller;
use App\Http\Traits\MessageFixer;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\RecipeImport;
use Illuminate\Support\Facades\DB;

class RecipeController extends Controller
{
    use MessageFixer;

    public function __invoke(Request $request)
    {
        DB::beginTransaction();

        try {
            Excel::import(new RecipeImport, $request->file('recipe'));
            DB::commit();
            return $this->successMessage('data berhasil ditambahkan', []);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->errorMessage($th->getMessage());
        }
    }
}
