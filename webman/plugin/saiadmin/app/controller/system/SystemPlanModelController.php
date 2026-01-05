<?php
// +----------------------------------------------------------------------
// | saiadmin [ saiadmin快速开发框架 ]
// +----------------------------------------------------------------------
// | Author: sai <1430792918@qq.com>
// +----------------------------------------------------------------------
namespace plugin\saiadmin\app\controller\system;

use plugin\saiadmin\basic\BaseController;
use plugin\saiadmin\app\logic\system\SystemPlanModelLogic;
use plugin\saiadmin\app\validate\system\SystemPlanModelValidate;
use support\Request;
use support\Response;

/**
 * 计划模板控制器
 */
class SystemPlanModelController extends BaseController
{
    /**
     * 构造
     */
    public function __construct()
    {
        $this->logic = new SystemPlanModelLogic();
        $this->validate = new SystemPlanModelValidate;
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
            ['plan_type_id', ''],
            ['status', ''],
            ['create_time', ''],
        ]);
        $query = $this->logic->search($where);
        $data = $this->logic->getList($query);
        return $this->success($data);
    }

    /**
     * 保存数据
     * @param Request $request
     * @return Response
     */
    /**
     * 保存数据
     * @param Request $request
     * @return Response
     */
    public function save(Request $request): Response
    {
        $data = $request->post();
        if ($this->validate) {
            if (!$this->validate->scene('save')->check($data)) {
                return $this->fail($this->validate->getError());
            }
        }
        $result = $this->logic->add($data);
        if ($result > 0) {
            $this->afterChange('save', $result);
            return $this->success('保存成功');
        } else {
            return $this->fail('保存失败');
        }
    }

    /**
     * 更新数据
     * @param Request $request
     * @param $id
     * @return Response
     */
    public function update(Request $request, $id): Response
    {
        $id = $request->input('id', $id);
        if (empty($id)) {
            return $this->fail('参数错误，请检查');
        }
        $data = $request->post();
        if ($this->validate) {
            if (!$this->validate->scene('update')->check($data)) {
                return $this->fail($this->validate->getError());
            }
        }
        $result = $this->logic->edit($id, $data);
        if ($result) {
            $this->afterChange('update', $result);
            return $this->success('更新成功');
        } else {
            return $this->fail('更新失败');
        }
    }

    /**
     * 删除数据
     * @param Request $request
     * @return Response
     */
    public function destroy(Request $request): Response
    {
        $ids = $request->input('ids', '');
        if (!empty($ids)) {
            $this->logic->destroy($ids);
            $this->afterChange('destroy', $ids);
            return $this->success('删除成功');
        } else {
            return $this->fail('参数错误，请检查');
        }
    }

    /**
     * 读取数据
     * @param Request $request
     * @param $id
     * @return Response
     */
    public function read(Request $request, $id): Response
    {
        $id = $request->input('id', $id);
        $model = $this->logic->read($id);
        if ($model) {
            $data = is_array($model) ? $model : $model->toArray();
            return $this->success($data);
        } else {
            return $this->fail('获取失败');
        }
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
     * 可操作计划模板
     * @param Request $request
     * @return Response
     */
    public function accessPlanModel(Request $request): Response
    {
        $where = ['status' => 1];
        $data = $this->logic->accessPlanModel($where);
        return $this->success($data);
    }
}
