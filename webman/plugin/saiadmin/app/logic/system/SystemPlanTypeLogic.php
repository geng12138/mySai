<?php
// +----------------------------------------------------------------------
// | saiadmin [ saiadmin快速开发框架 ]
// +----------------------------------------------------------------------
// | Author: sai <1430792918@qq.com>
// +----------------------------------------------------------------------
namespace plugin\saiadmin\app\logic\system;

use plugin\saiadmin\app\model\system\SystemPlanType;
use plugin\saiadmin\basic\BaseLogic;

/**
 * 计划类型管理逻辑层
 */
class SystemPlanTypeLogic extends BaseLogic
{
    /**
     * 构造函数
     */
    public function __construct()
    {
        $this->model = new SystemPlanType();
    }

    /**
     * 可操作计划类型
     * @param array $where
     * @return array
     */
    public function accessPlanType(array $where = []): array
    {
        $query = $this->search($where);
        $query->field('id, id as value, title as label, title');
        return $this->getAll($query);
    }
}
