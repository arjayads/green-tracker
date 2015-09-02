<?php

namespace app\Services;

interface SaleService extends BaseService
{
    function process($saleId, $statusId);
}