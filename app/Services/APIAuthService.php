<?php

namespace App\Services;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class APIAuthService extends BaseService
{
    /**
     * Login method for users.
     * 
     * @param array $credentials
     * 
     * @return \Illuminate\Http\Response
     */
    public function login(array $credentials)
    {
        try {
            if (!filter_var($credentials['email'], FILTER_VALIDATE_EMAIL)) {
                $credentials['username'] = $credentials['email'];
                unset($credentials['email']);
            }
            if (Auth::attempt($credentials)) {
                /** @var \App\Models\User $user **/
                $user = Auth::user();
                $token = $user->createToken('MySecretToken')->plainTextToken;
                $output = [
                    'user' => $user,
                    'accessToken' => $token
                ];
                return $this->sendResponse($output, 'Login Success.');
            } else {
                return $this->sendError('Unauthorized!', ['Unauthorized!'], 401);
            }
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), [$e->getMessage()], 500);
        }
    }

    /**
     * Register method for users.
     * 
     * @param array $data
     * 
     * @return \Illuminate\Http\Response
     */
    public function register(array $data)
    {
        try {
            $data['password'] = bcrypt($data['password']);
            $newUser = new User();
            DB::transaction(function () use($newUser, $data) {
                $newUser->fill($data);
                tap($newUser)->save();
            });
            return $this->sendResponse([], 'Registered Successfully.', 201);
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), [$e->getMessage()], 500);
        }
    }
}