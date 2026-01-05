<?php
// +----------------------------------------------------------------------
// | saiadmin [ saiadmin快速开发框架 ]
// +----------------------------------------------------------------------
// | Author: sai <1430792918@qq.com>
// +----------------------------------------------------------------------
namespace plugin\saiadmin\app\controller\system;

use plugin\saiadmin\basic\BaseController;
use plugin\saiadmin\app\logic\system\SystemPlanTypeLogic;
use plugin\saiadmin\app\validate\system\SystemPlanTypeValidate;
use support\Request;
use support\Response;

/**
 * 计划类型控制器
 */
class SystemPlanTypeController extends BaseController
{
    /**
     * 构造
     */
    public function __construct()
    {
        $this->logic = new SystemPlanTypeLogic();
        $this->validate = new SystemPlanTypeValidate;
        parent::__construct();
    }

    /**
     * 数据列表
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        $where = $request->more([
            ['title', ''],
            ['project_id', ''],
            ['status', ''],
            ['create_time', ''],
        ]);
        $query = $this->logic->search($where);
        $data = $this->logic->getList($query);
        return $this->success($data);
    }

    /**
     * 修改状态
     * @param Request $request
     * @return Response
     */
    public function changeStatus(Request $request): Response
    {
        $id = $request->input('id', '');
        $status = $request->input('status', 1);
        $model = $this->logic->findOrEmpty($id);
        if ($model->isEmpty()) {
            return $this->fail('未查找到信息');
        }
        $result = $model->save(['status' => $status]);
        if ($result) {
            $this->afterChange('changeStatus', $model);
            return $this->success('操作成功');
        } else {
            return $this->fail('操作失败');
        }
    }

    /**
     * 可操作计划类型
     * @param Request $request
     * @return Response
     */
    public function accessPlanType(Request $request): Response
    {
        $where = ['status' => 1];
        $data = $this->logic->accessPlanType($where);
        return $this->success($data);
    }
}
