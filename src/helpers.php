<?php
if(!class_exists('QueryType')) {
    abstract class QueryType
    {
        const Create = 1;
        const Read = 2;
        const Update = 3;
        const Delete = 4;
    }
}

if (!function_exists("jsend_error")) {
    /**
     * @param string $message Error message
     * @param string $code Optional custom error code
     * @param string | array $data Optional data
     * @param int $status HTTP status code
     * @param array $extraHeaders
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    function jsend_error($message, $code = null, $data = null, $status = 500, $extraHeaders = [])
    {
        $response = [
            "status" => "error",
            "message" => $message
        ];
        !is_null($code) && $response['code'] = $code;
        !is_null($data) && $response['data'] = $data;

        return response()->json($response, $status, $extraHeaders);
    }
}

if (!function_exists("jsend_fail")) {
    /**
     * @param array $data
     * @param int $status HTTP status code
     * @param array $extraHeaders
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    function jsend_fail($data, $status = 400, $extraHeaders = [])
    {
        $response = [
            "status" => "fail",
            "data" => $data
        ];

        return response()->json($response, $status, $extraHeaders);
    }
    
    /**
     * @param QueryType $type Query Type
     * @param int $status HTTP status code
     * @param array $extraHeaders
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    function jsend_success(QueryType $type, $status = 400, $extraHeaders = [])
    {
        switch($type) {
            case QueryType::Create:
                $data = ["message" => "Created Failed"];
                break;
            case QueryType::Read:
                $data = ["message" => "Read Failed"];
                break;
            case QueryType::Update:
                $data = ["message" => "Updated Failed"];
                break;
            case QueryType::Delete:
                $data = ["message" => "Deleted Failed"];
                break;
            default:
                $data = null;
        }
        $response = [
            "status" => "fail",
            "data" => $data
        ];

        return response()->json($response, $status, $extraHeaders);
    }
}

if (!function_exists("jsend_success")) {
    /**
     * @param array | Illuminate\Database\Eloquent\Model $data
     * @param int $status HTTP status code
     * @param array $extraHeaders
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    function jsend_success($data = [], $status = 200, $extraHeaders = [])
    {
        $response = [
            "status" => "success",
            "data" => $data
        ];

        return response()->json($response, $status, $extraHeaders);
    }
    
    /**
     * @param QueryType $type Query Type
     * @param int $status HTTP status code
     * @param array $extraHeaders
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    function jsend_success(QueryType $type, $status = 200, $extraHeaders = [])
    {
        switch($type) {
            case QueryType::Create:
                $data = ["message" => "Created Successfully"];
                break;
            case QueryType::Read:
                $data = ["message" => "Created Successfully"];
                break;
            case QueryType::Update:
                $data = ["message" => "Updated Successfully"];
                break;
            case QueryType::Delete:
                $data = ["message" => "Deleted Successfully"];
                break;
            default:
                $data = null;
        }
        $response = [
            "status" => "success",
            "data" => $data
        ];

        return response()->json($response, $status, $extraHeaders);
    }
}
