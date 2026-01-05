<template>
  <component
    is="a-modal"
    v-model:visible="visible"
    :width="tool.getDevice() === 'mobile' ? '100%' : '700px'"
    title="查看详情"
    :footer="false"
    @cancel="close">
    <a-descriptions :column="2" bordered>
      <a-descriptions-item label="ID">{{ record.id }}</a-descriptions-item>
      <a-descriptions-item label="计划类型名称">{{ record.title }}</a-descriptions-item>
      <a-descriptions-item label="项目ID">{{ record.project_id }}</a-descriptions-item>
      <a-descriptions-item label="排序">{{ record.sort }}</a-descriptions-item>
      <a-descriptions-item label="是否展示">
        <a-tag :color="record.is_display === 1 ? 'green' : 'gray'">
          {{ record.is_display === 1 ? '是' : '否' }}
        </a-tag>
      </a-descriptions-item>
      <a-descriptions-item label="状态">
        <a-tag :color="record.status === 1 ? 'green' : 'red'">
          {{ record.status === 1 ? '正常' : '停用' }}
        </a-tag>
      </a-descriptions-item>
      <a-descriptions-item label="类型标识" :span="2">{{ record.type_logo }}</a-descriptions-item>
      <a-descriptions-item label="前端路由" :span="2">{{ record.font_url }}</a-descriptions-item>
      <a-descriptions-item label="检测冲突状态ID" :span="2">{{ record.state_ids }}</a-descriptions-item>
      <a-descriptions-item label="时空分布图状态ID" :span="2">{{ record.map_state_ids }}</a-descriptions-item>
      <a-descriptions-item label="行车监控图状态ID" :span="2">{{ record.monitoring_state_ids }}</a-descriptions-item>
      <a-descriptions-item label="PC端静态冲突状态" :span="2">
        {{ record.pc_static_collision_state_ids }}
      </a-descriptions-item>
      <a-descriptions-item label="移动端动态冲突状态" :span="2">
        {{ record.phone_dynamic_collision_state_ids }}
      </a-descriptions-item>
      <a-descriptions-item label="施工类型">{{ record.construction_type }}</a-descriptions-item>
      <a-descriptions-item label="创建者">{{ record.created_by }}</a-descriptions-item>
      <a-descriptions-item label="创建时间" :span="2">{{ record.create_time }}</a-descriptions-item>
      <a-descriptions-item label="更新时间" :span="2">{{ record.update_time }}</a-descriptions-item>
      <a-descriptions-item label="备注" :span="2">{{ record.remark }}</a-descriptions-item>
    </a-descriptions>
  </component>
</template>

<script setup>
import { ref, reactive } from 'vue'
import tool from '@/utils/tool'

const visible = ref(false)
const record = reactive({})

// 打开弹框
const open = async (data) => {
  Object.assign(record, data)
  visible.value = true
}

// 关闭弹窗
const close = () => (visible.value = false)

defineExpose({ open })
</script>
