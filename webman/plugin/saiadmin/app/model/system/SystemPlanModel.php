<?php
// +----------------------------------------------------------------------
// | saiadmin [ saiadmin快速开发框架 ]
// +----------------------------------------------------------------------
// | Author: sai <1430792918@qq.com>
// +----------------------------------------------------------------------
namespace plugin\saiadmin\app\model\system;

use plugin\saiadmin\basic\BaseModel;

/**
 * 计划模板模型
 */
class SystemPlanModel extends BaseModel
{
    /**
     * 数据表主键
     * @var string
     */
    protected $pk = 'id';

    protected $table = 'sa_plan_model';

    /**
     * 模板名称搜索
     */
    public function searchTitleAttr($query, $value)
    {
        $query->where('title', 'like', '%' . $value . '%');
    }

    /**
     * 计划类型ID搜索
     */
    public function searchPlanTypeIdAttr($query, $value)
    {
        $query->where('plan_type_id', $value);
    }

    /**
     * 状态搜索
     */
    public function searchStatusAttr($query, $value)
    {
        $query->where('status', $value);
    }
}
