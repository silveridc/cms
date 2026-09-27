import type { RouteRecordRaw } from 'vue-router';

import { LAYOUT } from '@/utils/route/constant';

export default [
  {
    path: '/form-data',
    name: 'formData',
    component: LAYOUT,
    redirect: '/form-data/index',
    meta: { title: { zh_CN: '表单收集', en_US: 'Form Collection' }, icon: 'form' },
    children: [
      {
        path: 'index',
        name: 'FormDataIndex',
        component: () => import('@/pages/formData/index.vue'),
        meta: { title: { zh_CN: '提交记录', en_US: 'Submissions' } },
      },
    ],
  },
] satisfies RouteRecordRaw[];
