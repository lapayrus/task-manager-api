<?php

namespace App\Http\Controllers\API;

use App\Services\APIAuthService;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Arr;

class AuthController extends Controller
{
    /**
     * Construct method.
     * 
     * @param APIAuthService $apiAuthService
     */
    public function __construct(
        private APIAuthService $apiAuthService
    )
    {}

    /**
     * Login method for users.
     * 
     * @param LoginRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        return $this->apiAuthService->login($request->validated());
    }

    /**
     * Register method for users.
     * 
     * @param RegisterRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequest $request)
    {
        return $this->apiAuthService->register(Arr::except($request->validated(), ['password_confirmation']));
    }
}
