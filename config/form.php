<?php
// +----------------------------------------------------------------------
// | 表单收集字段配置
// +----------------------------------------------------------------------

return [
    // 表单字段定义，供前端渲染表单，提交时按此校验必填项
    'fields' => [
        [
            'name'     => 'name',
            'label'    => '姓名',
            'type'     => 'text',
            'required' => true,
        ],
        [
            'name'     => 'mobile',
            'label'    => '手机号',
            'type'     => 'tel',
            'required' => true,
        ],
        [
            'name'     => 'email',
            'label'    => '邮箱',
            'type'     => 'email',
            'required' => false,
        ],
        [
            'name'     => 'content',
            'label'    => '留言内容',
            'type'     => 'textarea',
            'required' => false,
        ],
    ],
];
