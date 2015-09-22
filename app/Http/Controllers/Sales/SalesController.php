<?php

namespace app\Http\Controllers\Sales;

use app\Dto\SaleDto;
use app\Http\Controllers\Controller;
use app\Http\Requests\CreateSaleRequest;
use app\Models\SaleStatus;
use app\Services\SaleService;
use Illuminate\Http\Request;

class SalesController extends Controller
{

    public function __construct(SaleService $saleService, SaleDto $saleDto)
    {
        $this->saleService = $saleService;
        $this->saleDto = $saleDto;
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

    public function salesList()
    {
        return $this->saleDto->lists();
    }

    public function detail($id)
    {
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
}