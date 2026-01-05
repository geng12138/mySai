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
      <a-descriptions-item label="模板名称">{{ record.title }}</a-descriptions-item>
      <a-descriptions-item label="模板描述">{{ record.desc }}</a-descriptions-item>
      <a-descriptions-item label="模板内容表">{{ record.plan_content }}</a-descriptions-item>
      <a-descriptions-item label="作业类型">{{ record.work_type }}</a-descriptions-item>
      <a-descriptions-item label="所属项目ID">{{ record.project_id }}</a-descriptions-item>
      <a-descriptions-item label="所属计划类型名称">{{ getPlanTypeName(record.plan_type_id) }}</a-descriptions-item>
      <a-descriptions-item label="样式标识">{{ record.plan_content_logo }}</a-descriptions-item>
      <a-descriptions-item label="需要转换的计划类型ID">{{ record.conversion_plan_type_id }}</a-descriptions-item>
      <a-descriptions-item label="需要转换的模板类型ID">{{ record.conversion_plan_model_id }}</a-descriptions-item>
      <a-descriptions-item label="排序">{{ record.sort }}</a-descriptions-item>
      <a-descriptions-item label="状态">
        <a-tag :color="record.status === 1 ? 'green' : 'red'">
          {{ record.status === 1 ? '正常' : '停用' }}
        </a-tag>
      </a-descriptions-item>
      <a-descriptions-item label="创建者">{{ record.created_by }}</a-descriptions-item>
      <a-descriptions-item label="创建时间" :span="2">{{ record.create_time }}</a-descriptions-item>
      <a-descriptions-item label="更新时间" :span="2">{{ record.update_time }}</a-descriptions-item>
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

// 获取计划类型名称
const getPlanTypeName = async (id) => {
  if (!id) return ''
  try {
    const response = await import('@/api/system/planType').then(module => module.default.getAccessList())
    const item = response.data.find(item => item.value == id)
    return item ? item.label : ''
  } catch (error) {
    return ''
  }
}

// 关闭弹窗
const close = () => (visible.value = false)

defineExpose({ open })
</script>
