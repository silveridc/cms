<?php
declare(strict_types=1);
namespace app\admin\logic;

use app\common\model\FormDataModel;

/**
 * @title 表单收集管理类
 */
class FormLogic
{
    public FormDataModel $FormDataModel;

    public function __construct()
    {
        $this->FormDataModel = new FormDataModel();
    }

    /**
     * @title 获取提交列表
     * @desc 分页获取表单收集数据列表
     * @author zhaoyj
     * @version v1
     * @param array $param - 查询参数
     * @return array - 列表数据与总数
     */
    public function getList(array $param)
    {
        $page  = isset($param['page']) ? (int)$param['page'] : 1;
        $limit = isset($param['limit']) ? (int)$param['limit'] : 10;
        $total = $this->FormDataModel->count();
        $list  = $this->FormDataModel
            ->order('id', 'desc')
            ->page($page, $limit)
            ->select()
            ->toArray();
        foreach ($list as &$item) {
            $item['content'] = json_decode($item['content'], true);
        }
        return ['list' => $list, 'total' => $total];
    }

    /**
     * @title 获取提交详情
     * @desc 获取单条表单收集数据详情
     * @author zhaoyj
     * @version v1
     * @param int $id - 记录ID
     * @return array - 详情数据
     */
    public function getDetail(int $id)
    {
        $data = $this->FormDataModel->find($id);
        if (empty($data)) {
            return [];
        }
        $data = $data->toArray();
        $data['content'] = json_decode($data['content'], true);
        return $data;
    }

    /**
     * @title 删除提交
     * @desc 删除指定的表单收集数据
     * @author zhaoyj
     * @version v1
     * @param int $id - 记录ID
     * @return void
     */
    public function delete(int $id)
    {
        $this->FormDataModel->where('id', $id)->delete();
    }
}
