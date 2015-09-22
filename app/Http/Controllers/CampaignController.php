<?php
namespace app\Http\Controllers;

use app\Repositories\CampaignRepo;

class CampaignController extends Controller {

    private $campaignRepo;

    public function __construct()
    {
        $this->campaignRepo = new CampaignRepo();
    }

    public function campaignList()
    {
        return $this->campaignRepo->findAll(['id', 'name']);
    }

    public function products($campaignId)
    {
        return $this->campaignRepo->findProductByCampaignId($campaignId);
    }
}