<?php

namespace App\Http\Traits;

use Illuminate\Http\Response;

trait MessageFixer
{
    public function successMessage($message, $data, $token = null)
    {
        $result = [
            'status' => 'SUCCESS',
            'message' => $message,
            'status_code' => Response::HTTP_OK,
            'data' => $data,
        ];

        if ($token) {
            $result['token'] = $token;
        }

        return response()->json($result, Response::HTTP_OK);
    }

    public function collectionMessage()
    {
        return [
            "status" => "SUCCESS",
            "message" => "ambil data berhasil",
            "status_code" => Response::HTTP_OK,
            "data" => $this->collection,
        ];
    }

    public function detailMessage()
    {
        return [
            "status" => "SUCCESS",
            "message" => "ambil data berhasil",
            "status_code" => Response::HTTP_OK,
            "data" => $this->resource,
        ];
    }

    public function createMessage($message, $data)
    {
        return response()->json([
            'status' => 'CREATED',
            'message' => $message,
            'status_code' => Response::HTTP_CREATED,
            'data' => $data,
        ], Response::HTTP_CREATED);
    }

    public function warningMessage($message)
    {
        return response()->json([
            'status' => 'WARNING',
            'messages' => $message,
            'status_code' => Response::HTTP_BAD_REQUEST,
        ], Response::HTTP_BAD_REQUEST);
    }

    public function customMessage($status, $message, $statusCode)
    {
        return response()->json([
            'status' => $status,
            'messages' => $message,
            'status_code' => $statusCode,
        ], $statusCode);
    }

    public function errorMessage($message)
    {
        return response()->json([
            'status' => 'ERROR',
            'message' => $message,
            'status_code' => Response::HTTP_INTERNAL_SERVER_ERROR,
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
