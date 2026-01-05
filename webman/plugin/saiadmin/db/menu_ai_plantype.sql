-- +----------------------------------------------------------------------
-- | SaiAdmin 5.1.2 菜单配置
-- +----------------------------------------------------------------------
-- | 更新日期: 2026-01-04
-- | 说明: 添加AI新建管理菜单及计划类型管理功能
-- +----------------------------------------------------------------------

SET NAMES utf8mb4;

-- ----------------------------
-- 添加AI新建管理一级菜单
-- ----------------------------
INSERT INTO `sa_system_menu` VALUES (6000, 0, '0', 'AI新建管理', 'ai-manage', 'IconRobot', 'ai-manage', '', NULL, 2, 1, 'M', 0, NULL, 1, 99, 'AI生成的管理功能模块', 1, 1, '2026-01-04 11:40:00', '2026-01-04 11:40:00', NULL);

-- ----------------------------
-- 添加计划类型管理菜单及权限
-- ----------------------------
-- 计划类型管理菜单
INSERT INTO `sa_system_menu` VALUES (6100, 6000, '0,6000', '计划类型管理', 'ai-manage/planType', 'IconSchedule', 'ai-manage/planType', 'system/planType/index', NULL, 2, 1, 'M', 0, NULL, 1, 0, '计划类型管理模块', 1, 1, '2026-01-04 11:40:00', '2026-01-04 11:40:00', NULL);

-- 计划类型列表权限
INSERT INTO `sa_system_menu` VALUES (6101, 6100, '0,6000,6100', '计划类型列表', '/core/planType/index', NULL, NULL, NULL, NULL, 2, 1, 'B', 0, NULL, 1, 0, '获取计划类型列表', 1, 1, '2026-01-04 11:40:00', '2026-01-04 11:40:00', NULL);

-- 计划类型保存权限
INSERT INTO `sa_system_menu` VALUES (6102, 6100, '0,6000,6100', '计划类型保存', '/core/planType/save', NULL, NULL, NULL, NULL, 2, 1, 'B', 0, NULL, 1, 0, '新增计划类型', 1, 1, '2026-01-04 11:40:00', '2026-01-04 11:40:00', NULL);

-- 计划类型更新权限
INSERT INTO `sa_system_menu` VALUES (6103, 6100, '0,6000,6100', '计划类型更新', '/core/planType/update', NULL, NULL, NULL, NULL, 2, 1, 'B', 0, NULL, 1, 0, '更新计划类型', 1, 1, '2026-01-04 11:40:00', '2026-01-04 11:40:00', NULL);

-- 计划类型删除权限
INSERT INTO `sa_system_menu` VALUES (6104, 6100, '0,6000,6100', '计划类型删除', '/core/planType/destroy', NULL, NULL, NULL, NULL, 2, 1, 'B', 0, NULL, 1, 0, '删除计划类型', 1, 1, '2026-01-04 11:40:00', '2026-01-04 11:40:00', NULL);

-- 计划类型读取权限
INSERT INTO `sa_system_menu` VALUES (6105, 6100, '0,6000,6100', '计划类型读取', '/core/planType/read', NULL, NULL, NULL, NULL, 2, 1, 'B', 0, NULL, 1, 0, '查看计划类型详情', 1, 1, '2026-01-04 11:40:00', '2026-01-04 11:40:00', NULL);

-- 计划类型状态改变权限
INSERT INTO `sa_system_menu` VALUES (6106, 6100, '0,6000,6100', '计划类型状态改变', '/core/planType/changeStatus', NULL, NULL, NULL, NULL, 2, 1, 'B', 0, NULL, 1, 0, '修改计划类型状态', 1, 1, '2026-01-04 11:40:00', '2026-01-04 11:40:00', NULL);

-- 计划类型可用列表权限
INSERT INTO `sa_system_menu` VALUES (6107, 6100, '0,6000,6100', '计划类型可用列表', '/core/planType/accessPlanType', NULL, NULL, NULL, NULL, 2, 1, 'B', 0, NULL, 1, 0, '获取可用计划类型列表', 1, 1, '2026-01-04 11:40:00', '2026-01-04 11:40:00', NULL);

-- ----------------------------
-- 添加计划模板管理菜单及权限
-- ----------------------------
-- 计划模板管理菜单
INSERT INTO `sa_system_menu` VALUES (6200, 6000, '0,6000', '计划模板管理', 'ai-manage/planModel', 'IconTemplate', 'ai-manage/planModel', 'system/planModel/index', NULL, 2, 1, 'M', 0, NULL, 1, 2, '计划模板管理模块', 1, 1, '2026-01-04 15:40:00', '2026-01-04 15:40:00', NULL);

-- 计划模板列表权限
INSERT INTO `sa_system_menu` VALUES (6201, 6200, '0,6000,6200', '计划模板列表', '/core/planModel/index', NULL, NULL, NULL, NULL, 2, 1, 'B', 0, NULL, 1, 0, '获取计划模板列表', 1, 1, '2026-01-04 15:40:00', '2026-01-04 15:40:00', NULL);

-- 计划模板保存权限
INSERT INTO `sa_system_menu` VALUES (6202, 6200, '0,6000,6200', '计划模板保存', '/core/planModel/save', NULL, NULL, NULL, NULL, 2, 1, 'B', 0, NULL, 1, 0, '新增计划模板', 1, 1, '2026-01-04 15:40:00', '2026-01-04 15:40:00', NULL);

-- 计划模板更新权限
INSERT INTO `sa_system_menu` VALUES (6203, 6200, '0,6000,6200', '计划模板更新', '/core/planModel/update', NULL, NULL, NULL, NULL, 2, 1, 'B', 0, NULL, 1, 0, '更新计划模板', 1, 1, '2026-01-04 15:40:00', '2026-01-04 15:40:00', NULL);

-- 计划模板删除权限
INSERT INTO `sa_system_menu` VALUES (6204, 6200, '0,6000,6200', '计划模板删除', '/core/planModel/destroy', NULL, NULL, NULL, NULL, 2, 1, 'B', 0, NULL, 1, 0, '删除计划模板', 1, 1, '2026-01-04 15:40:00', '2026-01-04 15:40:00', NULL);

-- 计划模板读取权限
INSERT INTO `sa_system_menu` VALUES (6205, 6200, '0,6000,6200', '计划模板读取', '/core/planModel/read', NULL, NULL, NULL, NULL, 2, 1, 'B', 0, NULL, 1, 0, '查看计划模板详情', 1, 1, '2026-01-04 15:40:00', '2026-01-04 15:40:00', NULL);

-- 计划模板状态改变权限
INSERT INTO `sa_system_menu` VALUES (6206, 6200, '0,6000,6200', '计划模板状态改变', '/core/planModel/changeStatus', NULL, NULL, NULL, NULL, 2, 1, 'B', 0, NULL, 1, 0, '修改计划模板状态', 1, 1, '2026-01-04 15:40:00', '2026-01-04 15:40:00', NULL);

-- 计划模板可用列表权限
INSERT INTO `sa_system_menu` VALUES (6207, 6200, '0,6000,6200', '计划模板可用列表', '/core/planModel/accessPlanModel', NULL, NULL, NULL, NULL, 2, 1, 'B', 0, NULL, 1, 0, '获取可用计划模板列表', 1, 1, '2026-01-04 15:40:00', '2026-01-04 15:40:00', NULL);
