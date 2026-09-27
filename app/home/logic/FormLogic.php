<?php
declare(strict_types=1);
namespace app\home\logic;

use app\common\model\FormDataModel;

/**
 * @title 表单收集类
 */
class FormLogic
{
    public FormDataModel $FormDataModel;

    public function __construct()
    {
        $this->FormDataModel = new FormDataModel();
    }

    /**
     * @title 提交表单数据
     * @desc 按字段配置校验必填项并保存提交数据
     * @author zhaoyj
     * @version v1
     * @param array $param - 提交的表单数据
     * @return array - 校验错误信息，为空数组表示提交成功
     */
    public function submit(array $param)
    {
        $fields = config('form.fields');
        $data = [];
        foreach ($fields as $field) {
            $value = trim((string)($param[$field['name']] ?? ''));
            if (!empty($field['required']) && $value === '') {
                return ['field' => $field['name'], 'message' => $field['label'] . '不能为空'];
            }
            $data[$field['name']] = $value;
        }
        $this->FormDataModel->save([
            'content'     => json_encode($data, JSON_UNESCAPED_UNICODE),
            'ip'          => request()->ip(),
            'create_time' => time(),
        ]);
        return [];
    }
}
