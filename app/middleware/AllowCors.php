<?php
declare(strict_types=1);
namespace app\middleware;

use Closure;
use think\Request;
use think\Response;

/**
 * 跨域中间件
 * @desc 允许前端SPA跨域访问接口
 */
class AllowCors
{
    public function handle(Request $request, Closure $next): Response
    {
        $origin = $request->header('origin', '');
        $header = [
            'Access-Control-Allow-Origin'      => $origin ?: '*',
            'Access-Control-Allow-Credentials' => 'true',
            'Access-Control-Allow-Methods'     => 'GET, POST, PUT, DELETE, OPTIONS',
            'Access-Control-Allow-Headers'     => 'Authorization, Content-Type, X-Requested-With, think-lang',
            'Access-Control-Max-Age'           => '86400',
        ];
        if ($request->method(true) === 'OPTIONS') {
            return response('', 204, $header);
        }
        return $next($request)->header($header);
    }
}
