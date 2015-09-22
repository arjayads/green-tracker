<?php

namespace app\Http\Controllers\Sales;

use app\Dto\SaleDto;
use app\Http\Controllers\Controller;
use app\Http\Requests\CreateSaleRequest;
use app\Models\SaleStatus;
use app\ResponseEntity;
use app\Services\Impl\SaleServiceImpl;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class SalesController extends Controller
{

    private $saleService;
    private $saleDto;

    public function __construct()
    {
        $this->saleService = new SaleServiceImpl();
        $this->saleDto = new SaleDto();
    }

    public function store(CreateSaleRequest $request)
    {
        $x = $this->saleService->save($request->all())->toArray();
        var_dump($x);
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