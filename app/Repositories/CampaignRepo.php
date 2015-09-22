<?php

namespace app\Repositories;

use Illuminate\Support\Facades\DB;

class CampaignRepo
{
    function findAll(array $fields = [])
    {
        if (count($fields))
        {
            return DB::table('campaigns')->select($fields)->get();
        }
        else
        {
            return DB::table('campaigns')->get();
        }
    }

    function findProductByCampaignId($campaignId)
    {
        return DB::table('products')->where('campaign_id', '=', $campaignId)->select(['id', 'name'])->get();
    }
}