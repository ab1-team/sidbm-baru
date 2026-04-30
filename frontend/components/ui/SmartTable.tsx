"use client";

import React from "react";

export interface TableColumn<T> {
  header: string;
  accessor: keyof T | ((item: T) => React.ReactNode);
  className?: string;
  align?: "left" | "center" | "right";
}

interface SmartTableProps<T> {
  data: T[];
  columns: TableColumn<T>[];
  loading?: boolean;
  pagination?: {
    current_page: number;
    last_page: number;
    total: number;
    onPageChange: (page: number) => void;
  };
  emptyMessage?: string;
}

export default function SmartTable<T extends { id: string | number }>({
  data,
  columns,
  loading = false,
  pagination,
  emptyMessage = "Tidak ada data ditemukan.",
}: SmartTableProps<T>) {
  const getAlignment = (align?: string) => {
    if (align === "center") return "text-center";
    if (align === "right") return "text-right";
    return "text-left";
  };

  return (
    <div className="bg-white dark:bg-zinc-900 rounded-3xl border border-zinc-200 dark:border-zinc-800 overflow-hidden shadow-xl">
      <div className="overflow-x-auto">
        <table className="w-full text-left border-collapse">
          <thead>
            <tr className="bg-zinc-50 dark:bg-zinc-800/50">
              {columns.map((col, idx) => (
                <th
                  key={idx}
                  className={`px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-widest border-b border-zinc-100 dark:border-zinc-800 ${getAlignment(
                    col.align
                  )} ${col.className || ""}`}
                >
                  {col.header}
                </th>
              ))}
            </tr>
          </thead>
          <tbody className="divide-y divide-zinc-100 dark:divide-zinc-800">
            {loading ? (
              [...Array(5)].map((_, i) => (
                <tr key={i} className="animate-pulse">
                  <td colSpan={columns.length} className="px-6 py-8">
                    <div className="h-4 bg-zinc-200 dark:bg-zinc-800 rounded-full w-full opacity-50"></div>
                  </td>
                </tr>
              ))
            ) : data.length > 0 ? (
              data.map((item) => (
                <tr
                  key={item.id}
                  className="hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors"
                >
                  {columns.map((col, idx) => (
                    <td
                      key={idx}
                      className={`px-6 py-6 ${getAlignment(col.align)} ${
                        col.className || ""
                      }`}
                    >
                      {typeof col.accessor === "function"
                        ? col.accessor(item)
                        : (item[col.accessor] as React.ReactNode)}
                    </td>
                  ))}
                </tr>
              ))
            ) : (
              <tr>
                <td
                  colSpan={columns.length}
                  className="px-6 py-20 text-center text-zinc-500 font-medium"
                >
                  {emptyMessage}
                </td>
              </tr>
            )}
          </tbody>
        </table>
      </div>

      {pagination && (
        <div className="px-6 py-4 bg-zinc-50/50 dark:bg-zinc-800/20 border-t border-zinc-100 dark:border-zinc-800 flex items-center justify-between">
          <p className="text-sm text-zinc-500 font-medium">
            Total {pagination.total} data
          </p>
          <div className="flex gap-2">
            <button
              disabled={pagination.current_page === 1}
              onClick={() => pagination.onPageChange(pagination.current_page - 1)}
              className="px-4 py-2 rounded-xl border border-zinc-200 dark:border-zinc-800 hover:bg-white dark:hover:bg-zinc-900 disabled:opacity-30 transition-all font-bold text-xs uppercase tracking-widest text-zinc-600 dark:text-zinc-400"
            >
              Sebelumnya
            </button>
            <button
              disabled={pagination.current_page === pagination.last_page}
              onClick={() => pagination.onPageChange(pagination.current_page + 1)}
              className="px-4 py-2 rounded-xl border border-zinc-200 dark:border-zinc-800 hover:bg-white dark:hover:bg-zinc-900 disabled:opacity-30 transition-all font-bold text-xs uppercase tracking-widest text-zinc-600 dark:text-zinc-400"
            >
              Selanjutnya
            </button>
          </div>
        </div>
      )}
    </div>
  );
}
