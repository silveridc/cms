<?php
declare(strict_types=1);
namespace app\common\model;

use think\Model;

/**
 * 表单收集数据模型
 * @desc 表单收集数据模型
 * @uses \app\common\model\FormDataModel
 */
class FormDataModel extends Model
{
    protected $name = 'form_data';
    // 关闭自动时间戳，create_time 手动写入并以原始时间戳返回
    protected $autoWriteTimestamp = false;
    protected $createTime = false;
    protected $updateTime = false;
    //设置字段信息
    protected array $schema = [
        'id'          => 'int',
        'content'     => 'string',
        'ip'          => 'string',
        'create_time' => 'int',
    ];
}
