<?php
declare(strict_types=1);
namespace app\admin\controller;

use app\BaseController;
use app\admin\logic\FormLogic;
use app\common\response\ResponseCode;
use think\Response;

/**
 * @title 表单收集管理控制器
 * @desc 表单收集管理控制器
 * @full app\admin\controller\FormController
 */
class FormController extends BaseController
{
    public FormLogic $FormLogic;

    public function initialize()
    {
        parent::initialize();
        $this->FormLogic = app(FormLogic::class);
    }

    /**
     * @title 获取提交列表
     * @desc 分页获取表单收集数据列表
     * @author zhaoyj
     * @version v1
     * @url /admin/v1/form/list
     * @method get
     * @param int page - 页码
     * @param int limit - 每页数量
     * @return int status - 状态码
     * @return string message - 提示信息
     * @return array data.list - 列表数据
     * @return int data.total - 总数
     * @return int time - 时间戳
     */
    public function getList(): Response
    {
        $param = $this->request->param();
        $data = $this->FormLogic->getList($param);
        return result($data);
    }

    /**
     * @title 获取提交详情
     * @desc 获取单条表单收集数据详情
     * @author zhaoyj
     * @version v1
     * @url /admin/v1/form/detail/:id
     * @method get
     * @param int id - 记录ID
     * @return int status - 状态码
     * @return string message - 提示信息
     * @return array data - 详情数据
     * @return int time - 时间戳
     */
    public function getDetail($id): Response
    {
        $data = $this->FormLogic->getDetail((int)$id);
        if (empty($data)) {
            return result([], 'fail', '', ResponseCode::notFound, 404);
        }
        return result($data);
    }

    /**
     * @title 删除提交
     * @desc 删除指定的表单收集数据
     * @author zhaoyj
     * @version v1
     * @url /admin/v1/form/delete/:id
     * @method delete
     * @param int id - 记录ID
     * @return int status - 状态码
     * @return string message - 提示信息
     * @return int time - 时间戳
     */
    public function delete($id): Response
    {
        $this->FormLogic->delete((int)$id);
        return result([]);
    }
}
