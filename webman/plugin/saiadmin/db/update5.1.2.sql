-- +----------------------------------------------------------------------
-- | SaiAdmin 5.1.2 增量更新脚本
-- +----------------------------------------------------------------------
-- | 更新日期: 2026-01-04
-- +----------------------------------------------------------------------

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for sa_plan_type
-- ----------------------------
DROP TABLE IF EXISTS `sa_plan_type`;
CREATE TABLE `sa_plan_type` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '计划类型ID',
  `title` varchar(191) NOT NULL DEFAULT '' COMMENT '计划类型名称',
  `project_id` int(11) NOT NULL DEFAULT 0 COMMENT '所属项目ID',
  `type_logo` text NOT NULL COMMENT '类型标识',
  `font_url` varchar(100) NOT NULL DEFAULT '' COMMENT '前端路由地址',
  `sort` int(11) NOT NULL DEFAULT 0 COMMENT '排序',
  `is_display` tinyint(1) NOT NULL DEFAULT 0 COMMENT '是否默认展示(0否 1是)',
  `state_ids` varchar(255) NOT NULL DEFAULT '' COMMENT '检测冲突状态ID',
  `map_state_ids` varchar(255) NOT NULL DEFAULT '' COMMENT '时空分布图状态ID',
  `monitoring_state_ids` varchar(255) NULL DEFAULT NULL COMMENT '行车监控图状态ID',
  `pc_static_collision_state_ids` text NULL COMMENT 'PC端静态冲突状态ID',
  `phone_dynamic_collision_state_ids` text NULL COMMENT '移动端动态冲突状态ID',
  `construction_type` tinyint(1) NOT NULL DEFAULT 0 COMMENT '施工类型',
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '状态(1正常 2停用)',
  `created_by` int(11) NULL DEFAULT NULL COMMENT '创建者',
  `updated_by` int(11) NULL DEFAULT NULL COMMENT '更新者',
  `create_time` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime(0) NULL DEFAULT NULL COMMENT '更新时间',
  `delete_time` datetime(0) NULL DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `idx_project_id`(`project_id`) USING BTREE,
  INDEX `idx_sort`(`sort`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 COMMENT = '计划类型表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sa_plan_type (可选：添加初始数据)
-- ----------------------------

SET FOREIGN_KEY_CHECKS = 1;

-- ----------------------------
-- Table structure for sa_plan_model
-- ----------------------------
DROP TABLE IF EXISTS `sa_plan_model`;
CREATE TABLE `sa_plan_model` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '计划模板ID',
  `title` varchar(191) NOT NULL DEFAULT '' COMMENT '模板名称',
  `desc` varchar(191) NOT NULL DEFAULT '' COMMENT '模板描述',
  `plan_content` varchar(191) NOT NULL DEFAULT '' COMMENT '模板内容表',
  `work_type` int(11) NOT NULL DEFAULT 0 COMMENT '作业类型',
  `project_id` int(11) NOT NULL DEFAULT 0 COMMENT '所属项目ID',
  `plan_type_id` int(11) NOT NULL DEFAULT 0 COMMENT '所属计划类型ID',
  `plan_type_title` varchar(191) NOT NULL DEFAULT '' COMMENT '所属计划类型名称',】
  `plan_content_logo` varchar(191) NOT NULL DEFAULT '' COMMENT '样式标识',
  `conversion_plan_type_id` int(11) NOT NULL DEFAULT 0 COMMENT '需要转换的计划类型ID',
  `conversion_plan_model_id` int(11) NOT NULL DEFAULT 0 COMMENT '需要转换的模板类型ID',
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT '状态(1正常 2停用)',
  `sort` int(11) NOT NULL DEFAULT 0 COMMENT '排序',
  `created_by` int(11) NULL DEFAULT NULL COMMENT '创建者',
  `updated_by` int(11) NULL DEFAULT NULL COMMENT '更新者',
  `create_time` datetime(0) NULL DEFAULT NULL COMMENT '创建时间',
  `update_time` datetime(0) NULL DEFAULT NULL COMMENT '更新时间',
  `delete_time` datetime(0) NULL DEFAULT NULL COMMENT '删除时间',   
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `idx_plan_type_id`(`plan_type_id`) USING BTREE,
  INDEX `idx_project_id`(`project_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 COMMENT = '计划模板表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sa_plan_model (可选：添加初始数据)
-- ----------------------------


