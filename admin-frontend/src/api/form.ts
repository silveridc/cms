import type { FormDataItem, FormListResult } from '@/api/model/formModel';
import { request } from '@/utils/request';

const Api = {
  List: '/form/list',
  Detail: '/form/detail',
  Delete: '/form/delete',
};

export function getFormList(params: { page: number; limit: number }) {
  return request.get<FormListResult>({
    url: Api.List,
    params,
  });
}

export function getFormDetail(id: number) {
  return request.get<FormDataItem>({
    url: `${Api.Detail}/${id}`,
  });
}

export function deleteFormRecord(id: number) {
  return request.delete({
    url: `${Api.Delete}/${id}`,
  });
}
