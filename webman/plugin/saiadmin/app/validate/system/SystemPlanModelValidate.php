<?php
// +----------------------------------------------------------------------
// | saiadmin [ saiadmin快速开发框架 ]
// +----------------------------------------------------------------------
// | Author: sai <1430792918@qq.com>
// +----------------------------------------------------------------------
namespace plugin\saiadmin\app\validate\system;

use think\Validate;

/**
 * 计划模板验证器
 */
class SystemPlanModelValidate extends Validate
{
    /**
     * 定义验证规则
     */
    protected $rule = [
        'title' => 'require|max:191',
        'desc' => 'max:191',
        'plan_type_id' => 'require|number',
        'status' => 'require|in:1,2',
    ];

    /**
     * 定义错误信息
     */
    protected $message = [
        'title.require' => '模板名称必须填写',
        'title.max' => '模板名称最多不能超过191个字符',
        'desc.max' => '模板描述最多不能超过191个字符',
        'plan_type_id.require' => '计划类型ID必须填写',
        'plan_type_id.number' => '计划类型ID必须是数字',
        'status.require' => '状态必须填写',
        'status.in' => '状态值不正确',
    ];

    /**
     * 定义场景
     */
    protected $scene = [
        'save' => [
            'title',
            'desc',
            'plan_type_id',
            'status',
        ],
        'update' => [
            'title',
            'desc',
            'plan_type_id',
            'status',
        ],
    ];
}
