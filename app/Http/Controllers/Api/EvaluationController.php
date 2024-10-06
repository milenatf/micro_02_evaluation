<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateEvaluation;
use App\Http\Resources\EvaluationResource;
use App\Models\Evaluation;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    public function __construct(protected Evaluation $repository)
    {
        
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $company)
    {
        $evaluations = $this->repository->get();

        if(!$evaluations) return response()->json('Not found', 404);

        // return response()->json($evaluations);

        return EvaluationResource::collection($evaluations);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUpdateEvaluation $request)
    {
        try {
            $this->repository->create($request->validated());

            return response()->json(['status' => 'success', 'message' => 'Avalição cadastrada com sucesso'], 201);
        } catch(\Exception $e) {
            return response()->json(['status' => 'failed', 'error' =>  $e], 500);
        }

    }
}
