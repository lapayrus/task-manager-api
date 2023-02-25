<?php

namespace App\Services;

class BaseService
{
    /**
     * success response method.
     * 
     * @param array $result
     * @param string $message
     * @param int $code
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse(array $result, string $message = 'Success!', int $code = 200)
    {
    	$response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];
        return response()->json($response, $code);
    }

    /**
     * return error response.
     *
     * @param string $error
     * @param array $errorMessage
     * @param int $code
     * 
     * @return \Illuminate\Http\Response
     */
    public function sendError(string $error, array $errorMessages = [], int $code = 404)
    {
    	$response = [
            'success' => false,
            'message' => $error,
        ];
        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }
        return response()->json($response, $code);
    }
}