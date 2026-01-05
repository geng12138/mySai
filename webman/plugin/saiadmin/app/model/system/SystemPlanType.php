<?php
// +----------------------------------------------------------------------
// | saiadmin [ saiadmin快速开发框架 ]
// +----------------------------------------------------------------------
// | Author: sai <1430792918@qq.com>
// +----------------------------------------------------------------------
namespace plugin\saiadmin\app\model\system;

use plugin\saiadmin\basic\BaseModel;

/**
 * 计划类型模型
 */
class SystemPlanType extends BaseModel
{
    /**
     * 数据表主键
     * @var string
     */
    protected $pk = 'id';

    protected $table = 'sa_plan_type';

    /**
     * 计划类型名称搜索
     */
    public function searchTitleAttr($query, $value)
    {
        $query->where('title', 'like', '%' . $value . '%');
    }

    /**
     * 项目ID搜索
     */
    public function searchProjectIdAttr($query, $value)
    {
        $query->where('project_id', $value);
    }

    /**
     * 状态搜索
     */
    public function searchStatusAttr($query, $value)
    {
        $query->where('status', $value);
    }
}
