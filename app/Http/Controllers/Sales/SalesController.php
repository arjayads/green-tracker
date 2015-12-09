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
        $campaignId = Input::get('campId');
        $q = Input::get('q');   // verified, all
        if (!$campaignId) {
            $request->session()->forget('campaign');
        }
        return $this->saleDto->lists($campaignId, $q);
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
        $response = new ResponseEntity();
        try {

            $sale = Sale::find($saleId);
            if ($sale) {
                $sale->verified = 1;
                $sale->save();

                $response->setSuccess(true);
                $response->setMessage('Sale successfully verified!');
            }
            else
            {
                $response->setMessage('Sale not available');
            }
        } catch (\Exception $ex) {
            $response->setMessages(['Exception: ' . $ex->getMessage()]);
        }
        return $response->toArray();
    }
}