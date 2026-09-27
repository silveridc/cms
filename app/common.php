<?php
// 应用公共文件

use app\common\response\ResponseCode;

/**
 * 返回统一格式响应
 * @param array $data
 * @param string $type
 * @param string $message
 * @param int|null $code
 * @param int $httpcode
 * @return \think\Response
 */
function result(array $data, string $type = 'success', string $message = '', int|null $code = null, int $httpcode = 200)
{
    if (!$code) {
        $code = ResponseCode::success;
    }
    if ($type === 'fail') {
        $message = lang('default_error_message');
    } else {
        $message = lang('success_message');
    }
    $result = [
        'status'  => $code,
        'message' => $message,
        'data'    => $data,
        'time'    => time(),
    ];
    return json($result, $httpcode, [], ['json_encode_param' => JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES]);
}
