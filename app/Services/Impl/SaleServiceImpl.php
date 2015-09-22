<?php

namespace app\Services\Impl;

use app\Models\Customer;
use app\Models\Product;
use app\Models\Sale;
use app\Models\SaleProcessed;
use app\Models\User;
use app\ResponseEntity;
use app\Services\SaleService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SaleServiceImpl implements SaleService
{
    public function __construct()
    {
    }

    function save(array $params)
    {
        $response = new ResponseEntity();
        try
        {
            DB::transaction(function() use (&$response, $params)
            {
                $user = User::find(Auth::user()->id);
                $product = Product::find($params['product_id']);

                $cust = new Customer();
                $cust->first_name = $params['customer']['first_name'];
                $cust->last_name = $params['customer']['last_name'];
                $cust->phone_number = $params['customer']['phone_number'];
                $custCreated = $cust->save();

                if ($custCreated && $product && $user)
                {
                    $sale = new Sale();
                    $sale->user_id = $user->id;
                    $sale->product_id = $product->id;
                    $sale->customer_id = $cust->id;
                    $sale->date_sold = Carbon::createFromFormat('m/d/Y', $params['date_sold']);
                    $sale->remarks = isset($params['remarks']) ? $params['remarks'] : '';
                    $sale->order_number = $params['order_number'];
                    $sale->ninety_days = isset($params['ninety_days']) ?: 0;

                    $ok = $sale->save();

                    if ($ok)
                    {
                        $response->setSuccess(true);
                        $response->setMessages(['Sale successfully created!']);
                    }
                    else
                    {
                        $response->setMessages(['Failed to create sale!']);
                    }
                }
                else
                {
                    $response->setMessages(['Entities not found']);
                }
            });
        }
        catch (\Exception $ex)
        {
            $response->setMessages(['Exception: ' . $ex->getMessage()]);
        }
        return $response;
    }

    function process($saleId, $statusId)
    {
        $response = new ResponseEntity();
        try {
            DB::transaction(function() use (&$response, $saleId, $statusId)
            {
                $sale = Sale::find($saleId);
                if ($sale)
                {
                    $sp = new SaleProcessed();
                    $sp->qc_user_id = 1;
                    $sp->sale_status_id = $statusId;
                    $sp->user_id = $sale->user_id;
                    $sp->product_id = $sale->product_id;
                    $sp->customer_id = $sale->customer_id;
                    $sp->date_sold = $sale->date_sold;
                    $sp->order_number = $sale->order_number;
                    $sp->ninety_days = $sale->ninety_days;
                    $sp->remarks = $sale->remarks;
                    $sp->entered_datetime = $sale->created_at;

                    $ok = $sp->save();

                    if ($ok) {

                        $deleted = Sale::destroy($saleId);
                        if ($deleted)
                        {
                            $response->setSuccess(true);
                            $response->setMessages(['Sale successfully processed!']);
                        }
                        else
                        {
                            $response->setMessages(['Failed to process sale!']);
                        }
                    } else {
                        $response->setMessages(['Failed to process sale!']);
                    }
                }
                else
                {
                    $response->setMessages(['Sale not available']);
                }
            });
        }
        catch (\Exception $ex)
        {
            $response->setMessages(['Exception: ' . $ex->getMessage()]);
        }
        return $response;
    }
}