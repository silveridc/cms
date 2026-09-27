export interface FormDataItem {
  id: number;
  content: Record<string, unknown>;
  ip: string;
  create_time: number;
}

export interface FormListResult {
  list: Array<FormDataItem>;
  total: number;
}
