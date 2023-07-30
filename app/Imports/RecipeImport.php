<?php

namespace App\Imports;

use App\Models\Recipe;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RecipeImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        foreach ($collection as $collect) {
            Recipe::create([
                "name" => $collect["nama_masakan"],
                "description" => $collect["deskripsi"],
                "steps" => $collect["cara_membuat"],
                "ingredient" => $collect["bahan"]
            ]);
        }
    }
}
