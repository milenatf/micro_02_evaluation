<?php

namespace App\Services;

use Milenatf\MicroservicesCommon\Services\Traits\ConsumerExternalService;

class CompanyService
{
    use ConsumerExternalService;

    protected string $token, $url;
    // Entrada para comunicação com o micro01
    public function __construct()
    {
        $this->token = config('services.micro_01.token');
        $this->url = config('services.micro_01.url');
    }

    public function getCompany(string $company)
    {
        return $this->request('get', "companies/{$company}");
    }
}