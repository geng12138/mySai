import { request } from '@/utils/request.js'

/**
 * 计划类型数据接口
 */
export default {
  /**
   * 数据列表
   * @returns
   */
  getPageList(params = {}) {
    return request({
      url: '/core/planType/index',
      method: 'get',
      params
    })
  },

  /**
   * 读取数据
   * @returns
   */
  read(id) {
    return request({
      url: '/core/planType/read?id=' + id,
      method: 'get'
    })
  },

  /**
   * 添加数据
   * @returns
   */
  save(params = {}) {
    return request({
      url: '/core/planType/save',
      method: 'post',
      data: params
    })
  },

  /**
   * 修改数据
   * @returns
   */
  update(id, data = {}) {
    return request({
      url: '/core/planType/update?id=' + id,
      method: 'put',
      data
    })
  },

  /**
   * 更改状态
   * @returns
   */
  changeStatus(data = {}) {
    return request({
      url: '/core/planType/changeStatus',
      method: 'post',
      data
    })
  },

  /**
   * 删除数据
   * @returns
   */
  destroy(data) {
    return request({
      url: '/core/planType/destroy',
      method: 'delete',
      data
    })
  },

  /**
   * 获取可用计划类型
   * @returns
   */
  getAccessList() {
    return request({
      url: '/core/planType/accessPlanType',
      method: 'get'
    })
  }
}
