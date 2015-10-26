<?php

namespace app\Repositories;

use app\Models\Sale;
use app\Models\SaleProcessed;
use Illuminate\Support\Facades\DB;

class SaleRepo
{
    function findAll($campaignId)
    {
        $q = DB::table('sales')
            ->join('customers', 'sales.customer_id', '=', 'customers.id')
            ->join('products', 'sales.product_id', '=', 'products.id')
            ->join('users', 'sales.user_id', '=', 'users.id')
            ->join('employees', 'users.id', '=', 'employees.user_id')
            ->join('campaigns', 'products.campaign_id', '=', 'campaigns.id');

        if (intval($campaignId) > 0) {
            $q->where('products.campaign_id', '=', $campaignId);
        }

        return $q->select(
                'sales.id',
                'sales.order_number',
                'sales.date_sold',
                'sales.ninety_days',
                'sales.remarks',

                'customers.first_name',
                'customers.last_name',
                'customers.phone_number',

                'products.name as product_name',
                'campaigns.name as campaign_name',

                'employees.first_name as user_first_name',
                'employees.last_name as user_last_name',

                'campaigns.id as campaign_id'
            )
            ->groupBy('sales.id')
            ->get();
    }

    function findOneById($id, array $fields = [])
    {
        $query = DB::table('sales')
            ->join('customers', 'sales.customer_id', '=', 'customers.id')
            ->join('products', 'sales.product_id', '=', 'products.id')
            ->join('users', 'sales.user_id', '=', 'users.id')
            ->join('employees', 'users.id', '=', 'employees.user_id')
            ->join('campaigns', 'products.campaign_id', '=', 'campaigns.id')
            ->where('sales.id', '=', $id);

        if (count($fields) > 0)
        {
            $query->select($fields);
        }
        else
        {
            $query->select(
                'sales.id',
                'sales.order_number',
                'sales.date_sold',
                'sales.ninety_days',
                'sales.remarks',
                'sales.created_at',

                'customers.first_name',
                'customers.last_name',
                'customers.phone_number',

                'products.name as product_name',
                'campaigns.name as campaign_name',

                'employees.first_name as user_first_name',
                'employees.last_name as user_last_name',

                'campaigns.id as campaign_id'
            );
        }
        return $query->first();
    }

    function countByAgentAndDate($agentId, $fromSql = null, $toSql = null)
    {
        if ($toSql == null && $fromSql) {
            $q = Sale::where('date_sold', $fromSql)->where('user_id', $agentId)->count();
            $r = SaleProcessed::where('date_sold', $fromSql)->where('user_id', $agentId)->count();

            return $q + $r;
        } else if ($fromSql && $toSql) {
            $q = Sale::where('date_sold', '>=', $fromSql)->where('date_sold', '<=', $toSql)->where('user_id', $agentId);
            $r = SaleProcessed::where('date_sold', '>=', $fromSql)->where('date_sold', '<=', $toSql)->where('user_id', $agentId);

            return $q + $r;
        } else {
            $q = Sale::where('user_id', $agentId)->count();
            $r = SaleProcessed::where('user_id', $agentId)->count();

            return $q + $r;
        }
    }
}