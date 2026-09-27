<?php
declare(strict_types=1);
namespace app\home\controller;

use app\BaseController;
use app\home\logic\FormLogic;
use app\common\response\ResponseCode;
use think\Response;

/**
 * @title 表单收集控制器
 * @desc 表单收集控制器
 * @use \app\home\controller\ApiController
 */
class ApiController extends BaseController
{
    public FormLogic $FormLogic;

    public function initialize()
    {
        parent::initialize();
        $this->FormLogic = app(FormLogic::class);
    }

    /**
     * @title 获取表单字段配置
     * @desc 获取表单字段配置，供前端渲染表单
     * @author zhaoyj
     * @version v1
     * @url /home/v1/form/data
     * @method get
     * @return int status - 状态码
     * @return string message - 提示信息
     * @return array data.fields - 表单字段配置
     * @return int time - 时间戳
     */
    public function getFormData(): Response
    {
        $data = ['fields' => config('form.fields')];
        return result($data);
    }

    /**
     * @title 提交表单数据
     * @desc 收集用户提交的表单数据
     * @author zhaoyj
     * @version v1
     * @url /home/v1/form/submit
     * @method post
     * @param string name - 姓名
     * @param string mobile - 手机号
     * @return int status - 状态码
     * @return string message - 提示信息
     * @return array data - 校验错误信息
     * @return int time - 时间戳
     */
    public function submitData(): Response
    {
        $param = $this->request->param();
        $error = $this->FormLogic->submit($param);
        if (!empty($error)) {
            return result($error, 'fail', '', ResponseCode::fail, 400);
        }
        return result([]);
    }
}
