<template>
  <component
    is="a-modal"
    v-model:visible="visible"
    :width="tool.getDevice() === 'mobile' ? '100%' : '600px'"
    :title="title"
    :mask-closable="false"
    :ok-loading="loading"
    @cancel="close"
    @before-ok="submit">
    <!-- 表单信息 start -->
    <a-form ref="formRef" :model="formData" :rules="rules" :auto-label-width="true">
      <a-form-item label="计划类型名称" field="title">
        <a-input v-model="formData.title" placeholder="请输入计划类型名称" />
      </a-form-item>

      <a-form-item label="类型样式标识" field="type_logo">
        <a-textarea
          v-model="formData.type_logo"
          placeholder="请输入类型样式标识（支持图标、颜色等样式配置）"
          :auto-size="{ minRows: 3, maxRows: 5 }"
        />
      </a-form-item>

      <a-form-item label="前端路由地址" field="font_url">
        <a-input v-model="formData.font_url" placeholder="请输入前端路由地址，如：/plan/list" />
      </a-form-item>

      <a-form-item label="排序" field="sort">
        <a-input-number
          v-model="formData.sort"
          placeholder="请输入排序"
          :min="0"
          :max="9999"
          style="width: 100%"
        />
      </a-form-item>

      <a-form-item label="是否默认展示" field="is_display">
        <sa-radio v-model="formData.is_display" :options="displayOptions" />
      </a-form-item>
    </a-form>
    <!-- 表单信息 end -->
  </component>
</template>

<script setup>
import { ref, reactive, computed } from 'vue'
import { Message } from '@arco-design/web-vue'
import tool from '@/utils/tool'
import api from '@/api/system/planType'

const emit = defineEmits(['success'])

// 引用定义
const formRef = ref()
const mode = ref('')
const visible = ref(false)
const loading = ref(false)

let title = computed(() => {
  return '计划类型管理' + (mode.value == 'add' ? '-新增' : '-编辑')
})

// 是否展示选项
const displayOptions = [
  { label: '否', value: 0 },
  { label: '是', value: 1 },
]

// 表单初始值（只保留5个核心字段 + 自动维护字段）
const initialFormData = {
  id: '',
  title: '',              // 名称
  type_logo: '',          // 样式
  font_url: '',           // 接口（前端路由）
  sort: 0,                // 排序
  is_display: 0,          // 显示
  // 自动维护字段
  project_id: 0,
  status: 1,
  state_ids: '',
  map_state_ids: '',
  monitoring_state_ids: '',
  pc_static_collision_state_ids: '',
  phone_dynamic_collision_state_ids: '',
  construction_type: 0,
}

// 表单信息
const formData = reactive({ ...initialFormData })

// 验证规则（只验证必填的5个字段）
const rules = {
  title: [{ required: true, message: '计划类型名称不能为空' }],
  type_logo: [{ required: true, message: '类型样式标识不能为空' }],
  font_url: [{ required: true, message: '前端路由地址不能为空' }],
}

// 打开弹框
const open = async (type = 'add') => {
  mode.value = type
  // 重置表单数据
  Object.assign(formData, initialFormData)
  formRef.value.clearValidate()
  visible.value = true
  await initPage()
}

// 初始化页面数据
const initPage = async () => {}

// 设置数据
const setFormData = async (data) => {
  for (const key in formData) {
    if (data[key] != null && data[key] != undefined) {
      formData[key] = data[key]
    }
  }
}

// 数据保存
const submit = async (done) => {
  const validate = await formRef.value?.validate()
  if (!validate) {
    loading.value = true
    let data = { ...formData }
    let result = {}
    if (mode.value === 'add') {
      // 添加数据
      data.id = undefined
      result = await api.save(data)
    } else {
      // 修改数据
      result = await api.update(data.id, data)
    }
    if (result.code === 200) {
      Message.success('操作成功')
      emit('success')
      done(true)
    }
    // 防止连续点击提交
    setTimeout(() => {
      loading.value = false
    }, 500)
  }
  done(false)
}

// 关闭弹窗
const close = () => (visible.value = false)

defineExpose({ open, setFormData })
</script>
