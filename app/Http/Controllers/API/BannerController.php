<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Filters\Banner\ShowByUser;
use App\Http\Resources\Banner\BannerCollection;
use App\Http\Resources\Banner\BannerDetail;
use App\Http\Traits\MessageFixer;
use App\Models\Banner;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Xendit\VirtualAccounts;
use Xendit\Xendit;

class BannerController extends Controller
{
    use MessageFixer;

    protected $banner;

    public function __construct(Banner $banner)
    {
        $this->banner = $banner;

        Xendit::setApiKey(config('xendit.secret_key'));
    }

    public function index(Request $request)
    {
        $banners = app(Pipeline::class)
            ->send($this->banner->query())
            ->through([
                ShowByUser::class
            ])
            ->thenReturn()
            ->with('user.store')
            ->paginate($request->per_page);

        return new BannerCollection($banners);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        $validator = Validator::make($request->all(), [
            "document_banner" => "required|image|mimes:jpeg,png,jpg,gif",
            "bank_code" => "required",
            "amount" => "required"
        ]);

        if ($validator->fails()) {
            return $this->warningMessage($validator->errors());
        }

        try {
            $request->merge([
                "user_id" => auth()->user()->id,
                "experation_at" => Carbon::now()->addWeek(),
                "image_path" => $request->file("document_banner")->store("banner"),
                "external_id" => "VA-" . uniqid()
            ]);

            $banner = $this->banner->create($request->all());

            $this->payment($request);

            DB::commit();
            return $this->successMessage("banner berhasil terdaftar", $banner);
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->errorMessage($th->getMessage());
        }
    }

    public function show($id)
    {
        $banner = $this->banner->find($id);
        if (!$banner) {
            return $this->warningMessage("data banner tidak ditemukan.");
        }

        $banner->load('user.store');

        return new BannerDetail($banner);
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }

    public function payment($request)
    {
        $params = [
            "external_id" => $request->external_id,
            "bank_code" => $request->bank_code,
            "name" => auth()->user()->name,
            "is_closed" => true,
            "expected_amount" => $request->amount,
            "expiration_date" => Carbon::now()->addDays(1)->toISOString(),
            "is_single_use" => true
        ];

        return VirtualAccounts::create($params);
    }
}
