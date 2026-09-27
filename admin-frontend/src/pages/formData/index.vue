<template>
  <div class="form-data-page">
    <t-card :bordered="false">
      <t-table
        row-key="id"
        :data="data"
        :columns="columns"
        :loading="loading"
        :pagination="pagination"
        vertical-align="top"
        :hover="true"
        @page-change="onPageChange"
      >
        <template #name="{ row }">{{ row.content?.name ?? '-' }}</template>
        <template #mobile="{ row }">{{ row.content?.mobile ?? '-' }}</template>
        <template #email="{ row }">{{ row.content?.email ?? '-' }}</template>
        <template #createTime="{ row }">{{ formatTime(row.create_time) }}</template>
        <template #op="{ row }">
          <t-space>
            <t-link theme="primary" hover="color" @click="showDetail(row)">详情</t-link>
            <t-link theme="danger" hover="color" @click="confirmDelete(row)">删除</t-link>
          </t-space>
        </template>
      </t-table>
    </t-card>

    <t-drawer v-model:visible="detailVisible" header="提交详情" size="480px" :footer="false">
      <div class="detail-list">
        <div class="detail-item">
          <span class="detail-label">ID</span>
          <span class="detail-value">{{ current?.id }}</span>
        </div>
        <div v-for="(value, key) in current?.content" :key="key" class="detail-item">
          <span class="detail-label">{{ key }}</span>
          <span class="detail-value">{{ value }}</span>
        </div>
        <div class="detail-item">
          <span class="detail-label">提交IP</span>
          <span class="detail-value">{{ current?.ip }}</span>
        </div>
        <div class="detail-item">
          <span class="detail-label">提交时间</span>
          <span class="detail-value">{{ formatTime(current?.create_time) }}</span>
        </div>
      </div>
    </t-drawer>

    <t-dialog
      v-model:visible="deleteVisible"
      header="删除确认"
      body="确定删除该条提交记录吗？删除后不可恢复。"
      @confirm="onConfirmDelete"
    />
  </div>
</template>

<script setup lang="ts">
import dayjs from 'dayjs';
import type { PageInfo, PrimaryTableCol, TableRowData } from 'tdesign-vue-next';
import { MessagePlugin } from 'tdesign-vue-next';
import { onMounted, ref } from 'vue';

import { deleteFormRecord, getFormList } from '@/api/form';
import type { FormDataItem } from '@/api/model/formModel';

defineOptions({
  name: 'FormDataIndex',
});
const columns: PrimaryTableCol<TableRowData>[] = [
  { title: 'ID', colKey: 'id', width: 80 },
  { title: '姓名', colKey: 'name', width: 120 },
  { title: '手机号', colKey: 'mobile', width: 140 },
  { title: '邮箱', colKey: 'email', width: 200 },
  { title: '提交IP', colKey: 'ip', width: 140 },
  { title: '提交时间', colKey: 'createTime', width: 180 },
  { title: '操作', colKey: 'op', width: 120, fixed: 'right' },
];

const data = ref<FormDataItem[]>([]);
const loading = ref(false);
const pagination = ref({
  current: 1,
  pageSize: 10,
  total: 0,
});

const formatTime = (time?: number) => (time ? dayjs(time * 1000).format('YYYY-MM-DD HH:mm:ss') : '-');

const fetchData = async () => {
  loading.value = true;
  try {
    const res = await getFormList({ page: pagination.value.current, limit: pagination.value.pageSize });
    data.value = res.list;
    pagination.value.total = res.total;
  } catch (e) {
    MessagePlugin.error((e as Error).message || '加载失败');
  } finally {
    loading.value = false;
  }
};
const onPageChange = (pageInfo: PageInfo) => {
  pagination.value.current = pageInfo.current;
  pagination.value.pageSize = pageInfo.pageSize;
  fetchData();
};

const detailVisible = ref(false);
const current = ref<FormDataItem | null>(null);
const showDetail = (row: FormDataItem) => {
  current.value = row;
  detailVisible.value = true;
};

const deleteVisible = ref(false);
const deleteId = ref(0);
const confirmDelete = (row: FormDataItem) => {
  deleteId.value = row.id;
  deleteVisible.value = true;
};
const onConfirmDelete = async () => {
  try {
    await deleteFormRecord(deleteId.value);
    MessagePlugin.success('删除成功');
    deleteVisible.value = false;
    if (data.value.length === 1 && pagination.value.current > 1) {
      pagination.value.current -= 1;
    }
    fetchData();
  } catch (e) {
    MessagePlugin.error((e as Error).message || '删除失败');
  }
};

onMounted(() => {
  fetchData();
});
</script>

<style lang="less" scoped>
.form-data-page {
  padding: var(--td-comp-paddingTB-xxl) var(--td-comp-paddingLR-xxl);
}

.detail-list {
  display: flex;
  flex-direction: column;
  gap: var(--td-comp-margin-l);
}

.detail-item {
  display: flex;
  gap: var(--td-comp-margin-l);
}

.detail-label {
  flex: 0 0 96px;
  color: var(--td-text-color-secondary);
}

.detail-value {
  flex: 1;
  word-break: break-all;
}
</style>
