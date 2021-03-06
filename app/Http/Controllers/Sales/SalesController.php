<?php

namespace app\Http\Controllers\Sales;

use app\Dto\SaleDto;
use app\Http\Controllers\Controller;
use app\Http\Requests\CreateSaleRequest;
use app\Models\Sale;
use app\Models\SaleStatus;
use app\Repositories\SaleRepo;
use app\ResponseEntity;
use app\Services\SaleService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class SalesController extends Controller
{

    public function __construct(SaleService $saleService, SaleDto $saleDto, SaleRepo $saleRepo)
    {
        $this->middleware('rolefilter:admin,QC', ['only' => ['salesList', 'process']]);

        $this->saleService = $saleService;
        $this->saleDto = $saleDto;
        $this->saleRepo = $saleRepo;

        parent::__construct();
    }

    public function index() {
        return view('sale.list');
    }

    public function create() {
        return view('sale.create');
    }

    public function store(CreateSaleRequest $request)
    {
        return $this->saleService->save($request->all())->toArray();
    }

    public function process(Request $request)
    {
        $params = $request->all();
        return $this->saleService->process($params['sale_id'], $params['status_id'])->toArray();
    }

    public function salesList(Request $request)
    {
        $sortCol = Input::get('sortCol');
        $direction = Input::get('direction');
        $offset = Input::get('offset');
        $limit = Input::get('limit');
        $campaignId = Input::get('campId');
        $query = Input::get('q');   // 1 - verified, -1 - all, 0 - unverified

        if (!$campaignId) {
            $request->session()->forget('campaign');
        }

        return $this->saleDto->lists($campaignId,
            $query,
            $sortCol ?: 'id',
            in_array(strtoupper($direction), ['ASC', 'DESC']) ? $direction : 'ASC',
            $offset ?: 0,
            $limit ?: 15);
    }

    public function detail($id)
    {
        $selectedCampaignFilter = Input::get('c');
        session(['campaign' => $selectedCampaignFilter]);

        $sale = $this->saleDto->findById($id);
        if ($sale) {
            return view('sale.detail', ['sale' => $sale]);
        } else {
            abort(404);
        }
    }

    public function statuses()
    {
        return SaleStatus::all();
    }

    public function myCountToday()
    {
        return $this->saleDto->countTodayByAgent(Auth::user()->id);
    }

    public function myWeeklyChart()
    {
        $now = Carbon::now();
        $wStart = clone $now->startOfWeek();
        $wEnd = clone $now->endOfWeek();

        $result = $this->saleRepo->countByAgentAndDateGroupByDate(Auth::user()->id, $wStart->toDateString(), $wEnd->toDateString());

        $data = [];
        if (is_array($result)) {
            while ($wStart->toDateString() <= $wEnd->toDateString()) {
                $cur = clone $wStart;

                $count = isset($result[$cur->toDateString()]) ? $result[$cur->toDateString()] : 0;
                $data[] = intval($count);
                $wStart->addDay();
            }
        }

        return $data;
    }


    public function setVerified($saleId)
    {
        return $this->saleService->setVerified($saleId)->toArray();
    }

    public function countFind() {
        $query = Input::get('q');
        $campId = Input::get('campId');
        $offset = Input::get('offset');
        $limit = Input::get('limit');
        return $this->saleRepo->countFind($campId, $query, $offset ?: 0, $limit ?: 15);
    }
}