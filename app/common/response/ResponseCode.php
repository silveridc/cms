<?php
declare(strict_types=1);
// Type: T|FF|O
// T: 2-Request OK 3-Internal Error 4-Request Error
// F: 0-Request OK 1-Internal Error
// O: 1-General 2-OpenAPI
// Type: T|FF|O
// T: 2-请求成功 3-内部错误 4-请求错误
// F: 0-请求成功 1-内部错误
// O: 1-通用 2-OpenAPI
namespace app\common\response;
class ResponseCode
{
    public const int success  = 200100;
    public const int fail = 311100;
    public const int notFound = 411200;
}
