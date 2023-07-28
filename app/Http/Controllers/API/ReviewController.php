<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Filters\Review\ShowByProduct;
use App\Http\Filters\Review\ShowByUser;
use App\Http\Filters\Review\ShowProduct;
use App\Http\Filters\Review\ShowUser;
use App\Http\Requests\API\ReviewRequest;
use App\Http\Resources\Review\ReviewCollection;
use App\Http\Resources\Review\ReviewDetail;
use App\Http\Traits\MessageFixer;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    use MessageFixer;

    protected $review;

    public function __construct(Review $review)
    {
        $this->review = $review;
    }

    public function index(Request $request)
    {
        $reviews = app(Pipeline::class)
            ->send($this->review->query())
            ->through([
                ShowUser::class,
                ShowByUser::class,
                ShowProduct::class,
                ShowByProduct::class,
            ])
            ->thenReturn()
            ->paginate($request->per_page);

        return new ReviewCollection($reviews);
    }

    public function store(ReviewRequest $request)
    {
        DB::beginTransaction();

        $request->merge([
            "user_id" => auth()->user()->id
        ]);

        try {
            $review = $this->review->create($request->all());

            DB::commit();
            return $this->successMessage("ulasan berhasil disimpan", $review);
        } catch (\Throwable $th) {
            DB::rollback();
            return $this->errorMessage($th->getMessage());
        }
    }

    public function show($id)
    {
        $review = $this->review->find($id);

        if (!$review) {
            return $this->warningMessage("data ulasan tidak ditemukan.");
        }

        if (request()->has('user') && request('user') == "true") {
            $review->load('user');
        }

        if (request()->has('product') && request('product') == "true") {
            $review->load('product');
        }

        return new ReviewDetail($review);
    }

    public function update(ReviewRequest $request, $id)
    {
        DB::beginTransaction();

        $review = $this->review->find($id);

        if (!$review) {
            return $this->warningMessage("data ulasan tidak ditemukan.");
        }

        try {
            $review->update($request->all());

            DB::commit();
            return $this->successMessage("ulasan berhasil diperbaharui", $review);
        } catch (\Throwable $th) {
            DB::rollback();
            return $this->errorMessage($th->getMessage());
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        $review = $this->review->find($id);

        if (!$review) {
            return $this->warningMessage("data ulasan tidak ditemukan.");
        }

        try {
            $review->delete();

            DB::commit();
            return $this->successMessage("ulasan berhasil dihapus", $review);
        } catch (\Throwable $th) {
            DB::rollback();
            return $this->errorMessage($th->getMessage());
        }
    }
}
