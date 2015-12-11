<?php

namespace app\Dto;


use app\Models\Sale;
use app\Repositories\SaleRepo;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SaleDto
{

    private $saleRepo;

    public function __construct()
    {
        $this->saleRepo = new SaleRepo();
    }

    function lists($campaignId, $q = null)
    {
        $rows = $this->saleRepo->findAll($campaignId, $q);

        $result = [];
        if ($rows)
        {
            foreach($rows as $s)
            {
                $result[] = $this->composeSaleData($s);
            }
        }
        return $result;
    }

    function findById($saleId)
    {
        $saleArr = [];
        $s = $this->saleRepo->findOneById($saleId);
        if ($s)
        {
            $saleArr = $this->composeSaleData($s);
            $saleArr['created_at'] = $s->created_at;
        }
        return $saleArr;
    }

    function countTodayByAgent($agentId)
    {
        $now = Carbon::now();
        $today = $now->format('Y-m-d');

        $data['today'] = $this->saleRepo->countByAgentAndDate($agentId, $today);
        $data['toDate'] = $this->saleRepo->countByAgentAndDate($agentId);

        return $data;
    }

    function countByAgent($agentId, $date = null)
    {
        return $this->saleRepo->countByAgentAndDate($agentId, $date);
    }

    private  function composeSaleData($s)
    {
        $processedBy = $s->user_first_name . ' ' .  $s->user_last_name;

        $customer['first_name'] = $s->first_name;
        $customer['last_name'] = $s->last_name;
        $customer['phone_number'] = $s->phone_number;

        $saleArr['id'] = $s->id;
        $saleArr['product_name'] = $s->product_name;
        $saleArr['campaign_name'] = $s->campaign_name;
        $saleArr['campaign_id'] = $s->campaign_id;

        $saleArr['order_number'] = $s->order_number;
        $saleArr['date_sold'] = $s->date_sold;
        $saleArr['ninety_days'] = $s->ninety_days;
        $saleArr['remarks'] = $s->remarks;
        $saleArr['customer'] = $customer;
        $saleArr['processed_by'] = $processedBy;
        $saleArr['status'] = $s->status;
        $saleArr['verified'] = $s->verified;

        return $saleArr;
    }
}