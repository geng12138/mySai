import { request } from '@/utils/request.js'

/**
 * 计划模板数据接口
 */
export default {
  /**
   * 数据列表
   * @returns
   */
  getPageList(params = {}) {
    return request({
      url: '/core/planModel/index',
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
      url: '/core/planModel/read?id=' + id,
      method: 'get'
    })
  },

  /**
   * 添加数据
   * @returns
   */
  save(params = {}) {
    return request({
      url: '/core/planModel/save',
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
      url: '/core/planModel/update?id=' + id,
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
      url: '/core/planModel/changeStatus',
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
      url: '/core/planModel/destroy',
      method: 'delete',
      data
    })
  },

  /**
   * 获取可用计划模板
   * @returns
   */
  getAccessList() {
    return request({
      url: '/core/planModel/accessPlanModel',
      method: 'get'
    })
  }
}
