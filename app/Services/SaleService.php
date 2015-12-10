<?php

namespace app\Services;

use app\Models\Customer;
use app\Models\Incentive;
use app\Models\Product;
use app\Models\Sale;
use app\Models\SaleProcessed;
use app\Models\User;
use app\Repositories\SaleRepo;
use app\ResponseEntity;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class SaleService implements BaseService
{
    public function __construct(SaleRepo $saleRepo)
    {
        $this->saleRepo = $saleRepo;
    }

    function save(array $params)
    {
        $response = new ResponseEntity();

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
                $sale->sale_status_id = Config::get('constants.sale_status.sale');
                $sale->product_id = $product->id;
                $sale->customer_id = $cust->id;
                $sale->date_sold = Carbon::createFromFormat('m/d/Y', $params['date_sold'])->toDateString();
                $sale->remarks = isset($params['remarks']) ? $params['remarks'] : '';
                $sale->order_number = $params['order_number'];
                $sale->ninety_days = isset($params['ninety_days']) ?: 0;

                $ok = $sale->save();

                if ($ok)
                {
                    $ok = $this->setIncentive($sale->user_id, $sale->date_sold);
                    $response->setMessages($ok ? ['Sale successfully created!']:['Failed to create sale!']);
                    $response->setSuccess($ok);
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
                    $sale->qc_user_id = Auth::user()->id;
                    $sale->sale_status_id = $statusId;
                    $sale->verified = 1;

                    $ok = $sale->save();

                    if ($ok) {
                        $ok = $this->setIncentive($sale->user_id, $sale->date_sold);
                        $response->setMessages($ok ? ['Sale successfully processed!']:['Failed to process sale!']);
                        $response->setSuccess($ok);
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
        return $response;
    }

    private function setIncentive($userId, $dateSold) {
        $saleCount = $this->saleRepo->countByAgentAndDate($userId, $dateSold);
        $incentive = Incentive::where('date', $dateSold)->where('user_id', $userId)->first();

        if ($saleCount > 0) {

            $data = $this->getIncentiveData($saleCount);

            if($incentive) {
                $incentive->sale_count = $saleCount;
                $incentive->multiplier = $data['multiplier'];
                $incentive->amount = $data['amount'];
                $incentive->save();

                return true;

            } else {
                $data = [
                    'user_id' => $userId,
                    'date' => $dateSold,
                    'sale_count' => $saleCount,
                    'multiplier' => $data['multiplier'],
                    'amount' => $data['amount']
                ];
                $incentive = Incentive::create($data);

                if ($incentive) {
                    return true;
                } else {
                    return false;
                }
            }
        } else if ($incentive) {
            $incentive->delete();
            return true;
        }
        return false;
    }

    private function getIncentiveData($saleCount) {
        if ($saleCount <= 3) {
            $multiplier = 25;
        } else if ($saleCount <= 7) {
            $multiplier = 50;
        } else {
            $multiplier = 80;
        }
        $amount = $saleCount * $multiplier;

        return  [
            'sale_count' => $saleCount,
            'multiplier' => $multiplier,
            'amount' => $amount
        ];
    }
}