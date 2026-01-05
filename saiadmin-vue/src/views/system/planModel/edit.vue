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
      <a-form-item label="模板名称" field="title">
        <a-input v-model="formData.title" placeholder="请输入模板名称" />
      </a-form-item>

      <a-form-item label="模板描述" field="desc">
        <a-input v-model="formData.desc" placeholder="请输入模板描述" />
      </a-form-item>

      <a-form-item label="模板内容表" field="plan_content">
        <a-input v-model="formData.plan_content" placeholder="请输入模板内容表" />
      </a-form-item>

      <a-form-item label="作业类型" field="work_type">
        <a-input-number
          v-model="formData.work_type"
          placeholder="请输入作业类型"
          :min="0"
          style="width: 100%"
        />
      </a-form-item>

      <a-form-item label="所属计划类型ID" field="plan_type_id">
        <sa-select v-model="formData.plan_type_id" :api="getPlanTypeList" placeholder="请选择所属计划类型" @change="updatePlanTypeName" value-key="value" label-key="label" />
      </a-form-item>

      <a-form-item label="所属计划类型名称" field="plan_type_title">
        <a-input v-model="formData.plan_type_title" placeholder="请输入所属计划类型名称" />
      </a-form-item>

      <a-form-item label="样式标识" field="plan_content_logo">
        <a-input v-model="formData.plan_content_logo" placeholder="请输入样式标识" />
      </a-form-item>

      <a-form-item label="需要转换的计划类型ID" field="conversion_plan_type_id">
        <a-input-number
          v-model="formData.conversion_plan_type_id"
          placeholder="请输入需要转换的计划类型ID"
          :min="0"
          style="width: 100%"
        />
      </a-form-item>

      <a-form-item label="需要转换的模板类型ID" field="conversion_plan_model_id">
        <a-input-number
          v-model="formData.conversion_plan_model_id"
          placeholder="请输入需要转换的模板类型ID"
          :min="0"
          style="width: 100%"
        />
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

      <a-form-item label="状态" field="status">
        <sa-radio v-model="formData.status" dict="data_status" />
      </a-form-item>
    </a-form>
    <!-- 表单信息 end -->
  </component>
</template>

<script setup>
import { ref, reactive, computed } from 'vue'
import { Message } from '@arco-design/web-vue'
import tool from '@/utils/tool'
import api from '@/api/system/planModel'

const emit = defineEmits(['success'])

// 引用定义
const formRef = ref()
const mode = ref('')
const visible = ref(false)
const loading = ref(false)

let title = computed(() => {
  return '计划模板管理' + (mode.value == 'add' ? '-新增' : '-编辑')
})

// 表单初始值
const initialFormData = {
  id: '',
  title: '',
  desc: '',
  plan_content: '',
  work_type: 0,
  project_id: 0,
  plan_type_id: '',  // 修改默认值为空字符串
  plan_type_title: '',
  plan_content_logo: '',
  conversion_plan_type_id: 0,
  conversion_plan_model_id: 0,
  status: 1,
  sort: 0,
}

// 表单信息
const formData = reactive({ ...initialFormData })

// 验证规则
const rules = {
  title: [{ required: true, message: '模板名称不能为空' }],
  plan_type_id: [{ required: true, message: '所属计划类型不能为空' }],
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

// 获取计划类型列表
const getPlanTypeList = async () => {
  try {
    const module = await import('@/api/system/planType');
    const response = await module.default.getAccessList();
    console.log('计划类型API响应:', response);
    
    if (response && response.code === 200 && response.data) {
      console.log('计划类型数据:', response.data);
      return response.data;
    } else {
      console.error('API响应格式错误:', response);
      return [];
    }
  } catch (error) {
    console.error('获取计划类型失败:', error);
    return [];
  }
}

// 监听计划类型选择变化，同步更新计划类型名称
const updatePlanTypeName = async () => {
  if (formData.plan_type_id) {
    try {
      const response = await import('@/api/system/planType').then(module => module.default.getAccessList())
      const selectedPlanType = response.data.find(item => item.value == formData.plan_type_id)
      if (selectedPlanType) {
        formData.plan_type_title = selectedPlanType.label
      }
    } catch (error) {
      console.error('更新计划类型名称失败:', error)
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
