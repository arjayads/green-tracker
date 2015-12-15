<?php

namespace app\Repositories;

use app\Models\Sale;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class SaleRepo
{
    function findAll($campaignId, $kwari = -1)
    {
        $q = DB::table('sales')
            ->join('customers', 'sales.customer_id', '=', 'customers.id')
            ->join('products', 'sales.product_id', '=', 'products.id')
            ->join('users', 'sales.user_id', '=', 'users.id')
            ->join('employees', 'users.id', '=', 'employees.user_id')
            ->join('campaigns', 'products.campaign_id', '=', 'campaigns.id')
            ->leftJoin('sale_statuses', 'sales.sale_status_id', '=', 'sale_statuses.id');

        if (intval($campaignId) > 0) {
            $q->where('products.campaign_id', $campaignId);
        }

        if ($kwari != -1) {
            $q->where('sales.verified', $kwari);
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

                'campaigns.id as campaign_id',
                'sale_statuses.status',
                'sales.verified'
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
            ->leftJoin('sale_statuses', 'sales.sale_status_id', '=', 'sale_statuses.id')
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

                'campaigns.id as campaign_id',
                'sale_statuses.status',
                'sales.verified'
            );
        }
        return $query->first();
    }

    function countByAgentAndDate($agentId, $fromSql = null, $toSql = null)
    {
        if ($toSql == null && $fromSql) {
            $r = Sale::where('date_sold', $fromSql)
                ->where('user_id', $agentId)
                ->where('sale_status_id', Config::get('constants.sale_status.sale'))
                ->count();

            return $r;
        } else if ($fromSql && $toSql) {
            $r = Sale::where('date_sold', '>=', $fromSql)
                ->where('date_sold', '<=', $toSql)
                ->where('user_id', $agentId)
                ->where('sale_status_id', Config::get('constants.sale_status.sale'))
                ->count();

            return $r;
        } else {
            $r = Sale::where('user_id', $agentId)
                ->where('sale_status_id', Config::get('constants.sale_status.sale'))
                ->count();

            return $r;
        }
    }

    function countByAgentAndDateGroupByDate($agentId, $fromSql = null, $toSql = null)
    {
        $r = Sale::where('user_id', $agentId)
            ->where('sale_status_id', Config::get('constants.sale_status.sale'));

        if ($fromSql && $toSql) {

            $r->where('date_sold', '>=', $fromSql)
                ->where('date_sold', '<=', $toSql);
        }

        return $r->groupBy('date_sold')
            ->select([
                'date_sold',
                DB::raw("count(*) as salesCount")
            ])
            ->orderBy('date_sold')
            ->lists('salesCount', 'date_sold')
            ->toArray();
    }

    function findTopSeller($limit = 3)
    {
        DB::statement('SET @rank=0');
        $query = "select *,  @rank:=@rank+1 AS rank FROM (
                  select `sales`.`user_id`, `employees`.`first_name`, `employees`.`last_name`, COUNT(sales.id) as score
                  from sales inner join `employees` on `employees`.`user_id` = `sales`.`user_id`
                  group by `sales`.`user_id` order by `score` desc limit ?
                  ) as inner_table";
        return DB::select(DB::raw($query), [$limit]);
    }

    function findUserSpotAsSeller($userId)
    {
        DB::statement('SET @rank=0');
        $query = "select * from (select *,  @rank:=@rank+1 AS rank FROM (
                  select `sales`.`user_id`, `employees`.`first_name`, `employees`.`last_name`, COUNT(sales.id) as score
                  from sales inner join `employees` on `employees`.`user_id` = `sales`.`user_id`
                  group by `sales`.`user_id` order by `score` desc
                  ) as inner_table) as inner_table2 where user_id = ? LIMIT 1";
        return DB::select(DB::raw($query), [$userId]);
    }
}