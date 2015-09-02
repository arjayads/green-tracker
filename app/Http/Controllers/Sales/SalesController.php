<?php

namespace app\Http\Controllers\Sales;

use app\Dto\SaleDto;
use app\Http\Controllers\Controller;
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

    // actions
    public function store(Request $request)
    {
        $messages = [
            'product_id.required' => 'Select product',
            'customer.first_name.max' => 'The customer first name may not be greater than :max characters.',
            'customer.last_name.max' => 'The customer last name may not be greater than :max characters.',
            'customer.phone_number.max' => 'The customer phone number may not be greater than :max characters.',
            'customer.first_name.required' => 'The customer first name is required.',
            'customer.last_name.required' => 'The customer last name is required.',
            'customer.phone_number.required' => 'The customer phone number is required.',
        ];

        $v = Validator::make($request->all(), [
            'product_id' => 'required|min:1',
            'date_sold' => 'required',
            'order_number' => 'required|unique:sales,order_number|max:30',
            'customer.first_name' => 'required|max:255',
            'customer.last_name' => 'required|max:255',
            'customer.phone_number' => 'required|max:15'
        ], $messages);

        if ($v->fails())
        {
            $response = new ResponseEntity();
            $response->setSuccess(false);
            $response->setMessages((array)$v->errors()->getMessages());
            return $response->toArray();
        }
        else
        {
            return  $this->saleService->save($request->all())->toArray();
        }
    }
    // data
    public function process(Request $request)
    {
        $params = $request->all();
        return $this->saleService->process($params['sale_id'], $params['status_id'])->toArray();
    }

    // data
    public function salesList()
    {
        return $this->saleDto->lists();
    }

    public function detail($id)
    {
        return $this->saleDto->findById($id);
    }

    public function statuses()
    {
        return SaleStatus::all();
    }
}