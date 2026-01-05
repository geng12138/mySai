<?php
// +----------------------------------------------------------------------
// | saiadmin [ saiadmin快速开发框架 ]
// +----------------------------------------------------------------------
// | Author: sai <1430792918@qq.com>
// +----------------------------------------------------------------------
namespace plugin\saiadmin\app\validate\system;

use think\Validate;

/**
 * 计划类型验证器
 */
class SystemPlanTypeValidate extends Validate
{
    /**
     * 定义验证规则
     */
    protected $rule = [
        'title' => 'require|max:191',
        'project_id' => 'require|number',
        'sort' => 'number',
        'is_display' => 'in:0,1',
        'status' => 'require|in:1,2',
    ];

    /**
     * 定义错误信息
     */
    protected $message = [
        'title.require' => '计划类型名称必须填写',
        'title.max' => '计划类型名称最多不能超过191个字符',
        'project_id.require' => '项目ID必须填写',
        'project_id.number' => '项目ID必须是数字',
        'sort.number' => '排序必须是数字',
        'is_display.in' => '是否展示值不正确',
        'status.require' => '状态必须填写',
        'status.in' => '状态值不正确',
    ];

    /**
     * 定义场景
     */
    protected $scene = [
        'save' => [
            'title',
            'project_id',
            'sort',
            'is_display',
            'status',
        ],
        'update' => [
            'title',
            'project_id',
            'sort',
            'is_display',
            'status',
        ],
    ];
}
