<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Filters\Recipe\Search;
use App\Http\Resources\Recipe\RecipeCollection;
use App\Http\Resources\Recipe\RecipeDetail;
use App\Http\Traits\MessageFixer;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;

class RecipeController extends Controller
{
    use MessageFixer;

    protected $recipe;

    public function __construct(Recipe $recipe)
    {
        $this->recipe = $recipe;
    }

    public function index(Request $request)
    {
        $recipes = app(Pipeline::class)
            ->send($this->recipe->query())
            ->through([
                Search::class
            ])
            ->thenReturn()
            ->paginate($request->per_page);

        return new RecipeCollection($recipes);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $recipe = $this->recipe->find($id);
        if (!$recipe) {
            return $this->warningMessage("data resep tidak ditemukan.");
        }

        return new RecipeDetail($recipe);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
