<template>
  <div class="ma-content-block lg:flex justify-between">
    <!-- CRUD 组件 -->
    <sa-table ref="crudRef" :options="options" :columns="columns" :searchForm="searchForm">
      <!-- 搜索区 tableSearch -->
      <template #tableSearch>
        <a-col :sm="8" :xs="24">
          <a-form-item field="title" label="计划类型名称">
            <a-input v-model="searchForm.title" placeholder="请输入计划类型名称" allow-clear />
          </a-form-item>
        </a-col>
        <a-col :sm="8" :xs="24">
          <a-form-item field="status" label="状态">
            <sa-select v-model="searchForm.status" dict="data_status" placeholder="请选择状态" />
          </a-form-item>
        </a-col>
        <a-col :sm="8" :xs="24">
          <a-form-item field="create_time" label="时间范围">
            <a-range-picker v-model="searchForm.create_time" style="width: 100%" />
          </a-form-item>
        </a-col>
      </template>

      <!-- Table 自定义渲染 -->
      <!-- 状态列 -->
      <template #status="{ record }">
        <sa-switch v-model="record.status" @change="changeStatus($event, record.id)"></sa-switch>
      </template>

      <!-- 是否展示列 -->
      <template #is_display="{ record }">
        <a-tag :color="record.is_display === 1 ? 'green' : 'gray'">
          {{ record.is_display === 1 ? '是' : '否' }}
        </a-tag>
      </template>
    </sa-table>

    <!-- 编辑表单 -->
    <edit-form ref="editRef" @success="refresh" />

    <!-- 查看表单 -->
    <view-form ref="viewRef" @success="refresh" />
  </div>
</template>

<script setup>
import { onMounted, ref, reactive } from 'vue'
import { Message } from '@arco-design/web-vue'
import EditForm from './edit.vue'
import ViewForm from './view.vue'
import api from '@/api/system/planType'

const crudRef = ref()
const editRef = ref()
const viewRef = ref()

// 搜索表单
const searchForm = ref({
  title: '',
  status: '',
  create_time: [],
})

// 修改状态
const changeStatus = async (status, id) => {
  const response = await api.changeStatus({ id, status })
  if (response.code === 200) {
    Message.success(response.message)
    crudRef.value.refresh()
  }
}

// SaTable 基础配置
const options = reactive({
  api: api.getPageList,
  rowSelection: { showCheckedAll: true },
  view: {
    show: true,
    auth: ['/core/planType/read'],
    func: async (record) => {
      viewRef.value?.open(record)
    },
  },
  add: {
    show: true,
    auth: ['/core/planType/save'],
    func: async () => {
      editRef.value?.open()
    },
  },
  edit: {
    show: true,
    auth: ['/core/planType/update'],
    func: async (record) => {
      editRef.value?.open('edit')
      editRef.value?.setFormData(record)
    },
  },
  delete: {
    show: true,
    auth: ['/core/planType/destroy'],
    func: async (params) => {
      const resp = await api.destroy(params)
      if (resp.code === 200) {
        Message.success(`删除成功！`)
        crudRef.value?.refresh()
      }
    },
  },
})

// SaTable 列配置
const columns = reactive([
  { title: 'ID', dataIndex: 'id', width: 80 },
  { title: '计划类型名称', dataIndex: 'title', width: 150 },
  { title: '类型标识', dataIndex: 'type_logo', width: 120, ellipsis: true, tooltip: true },
  { title: '前端路由', dataIndex: 'font_url', width: 150, ellipsis: true, tooltip: true },
  { title: '排序', dataIndex: 'sort', width: 100 },
  { title: '是否展示', dataIndex: 'is_display', width: 120 },
  { title: '状态', dataIndex: 'status', type: 'dict', dict: 'data_status', width: 120 },
  { title: '创建时间', dataIndex: 'create_time', width: 180 },
])

// 页面数据初始化
const initPage = async () => {}

// SaTable 数据请求
const refresh = async () => {
  crudRef.value?.refresh()
}

// 页面加载完成执行
onMounted(async () => {
  initPage()
  refresh()
})
</script>
