<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateEvaluation;
use App\Http\Resources\EvaluationResource;
use App\Models\Evaluation;
use App\Services\CompanyService;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    public function __construct(protected Evaluation $repository, protected CompanyService $companyService)
    {

    }
    /**
     * Display a listing of the resource.
     */
    public function index(string $company)
    {
        $evaluations = $this->repository->where('company', $company)->get();

        if(!$evaluations) return response()->json('Not found', 404);

        // return response()->json($evaluations);

        return EvaluationResource::collection($evaluations);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateEvaluation $request, string $company_uuid)
    {
        $response = $this->companyService->getCompany($company_uuid);

        $status = $response->status();

        if($status != 200) {
            return response()->json([
                'message' => 'Invalid Company'
            ], $status);
        }

        try {
            $this->repository->create($request->validated());

            return response()->json(['status' => 'success', 'message' => 'Avalição cadastrada com sucesso'], 201);
        } catch(\Exception $e) {
            return response()->json(['status' => 'failed', 'error' =>  $e], 500);
        }

    }
}
