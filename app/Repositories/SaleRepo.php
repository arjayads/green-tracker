<?php

namespace app\Repositories;

use Illuminate\Support\Facades\DB;

class SaleRepo
{
    function findAll()
    {
        return DB::table('sales')
            ->join('customers', 'sales.customer_id', '=', 'customers.id')
            ->join('products', 'sales.product_id', '=', 'products.id')
            ->join('users', 'sales.user_id', '=', 'users.id')
            ->join('employees', 'users.id', '=', 'employees.user_id')
            ->join('campaigns', 'products.campaign_id', '=', 'campaigns.id')
            ->select(
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
                'employees.last_name as user_last_name'
            )
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
                'employees.last_name as user_last_name'
            );
        }
        return $query->first();
    }
}