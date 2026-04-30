"use client";

import { useEffect, useState, useCallback } from "react";
import api from "@/lib/api";
import Modal from "@/components/Modal";
import Button from "@/components/ui/Button";
import Input from "@/components/ui/Input";
import SmartTable, { TableColumn } from "@/components/ui/SmartTable";
import { useRouter } from "next/navigation";
import Cookies from "js-cookie";

import { IAnggota, IPagination } from "@/lib/types";

export default function AnggotaPage() {
  const [anggota, setAnggota] = useState<IAnggota[]>([]);
  const [loading, setLoading] = useState(true);
  const [isSubmitting, setIsSubmitting] = useState(false);
  const [search, setSearch] = useState("");
  const [isModalOpen, setIsModalOpen] = useState(false);
  const [editingAnggota, setEditingAnggota] = useState<IAnggota | null>(null);
  const [pagination, setPagination] = useState<IPagination | null>(null);

  const [formData, setFormData] = useState({
    nik: "",
    nama_lengkap: "",
    jenis_kelamin: "L" as "L" | "P",
    desa: "",
    hp: "",
    alamat: "",
    usaha: "",
  });

  const router = useRouter();

  const fetchAnggota = useCallback(
    async (page = 1) => {
      setLoading(true);
      try {
        const response = await api.get(
          `/anggota?page=${page}&search=${search}`,
        );
        setAnggota(response.data.data);
        setPagination({
          current_page: response.data.current_page,
          last_page: response.data.last_page,
          total: response.data.total,
        });
      } catch (err) {
        console.error("Failed to fetch anggota", err);
      } finally {
        setLoading(false);
      }
    },
    [search],
  );

  useEffect(() => {
    const token = Cookies.get("auth_token");
    if (!token) {
      router.push("/login");
      return;
    }
    fetchAnggota();
  }, [fetchAnggota, router]);

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    setIsSubmitting(true);
    try {
      if (editingAnggota) {
        await api.put(`/anggota/${editingAnggota.id}`, formData);
      } else {
        await api.post("/anggota", formData);
      }
      setIsModalOpen(false);
      setEditingAnggota(null);
      resetForm();
      fetchAnggota();
    } catch (err: any) {
      alert(err.response?.data?.message || "Gagal menyimpan data");
    } finally {
      setIsSubmitting(false);
    }
  };

  const resetForm = () => {
    setFormData({
      nik: "",
      nama_lengkap: "",
      jenis_kelamin: "L",
      desa: "",
      hp: "",
      alamat: "",
      usaha: "",
    });
  };

  const handleDelete = async (id: number) => {
    if (confirm("Apakah Anda yakin ingin menghapus anggota ini?")) {
      try {
        await api.delete(`/anggota/${id}`);
        fetchAnggota();
      } catch (err) {
        alert("Gagal menghapus data");
      }
    }
  };

  const columns: TableColumn<IAnggota>[] = [
    {
      header: "NIK / Nama",
      accessor: (item) => (
        <div>
          <p className="font-bold text-zinc-900 dark:text-white leading-tight">
            {item.nama_lengkap}
          </p>
          <p className="text-xs text-zinc-500 font-mono mt-1">{item.nik}</p>
        </div>
      ),
    },
    {
      header: "Desa",
      accessor: (item) => (
        <span className="inline-flex items-center px-3 py-1 rounded-full bg-blue-50 dark:bg-blue-900/20 text-blue-600 text-xs font-bold">
          {item.desa}
        </span>
      ),
    },
    {
      header: "Kontak",
      accessor: "hp",
      className: "text-sm text-zinc-700 dark:text-zinc-300",
    },
    {
      header: "Usaha",
      accessor: "usaha",
      className: "text-sm text-zinc-600 dark:text-zinc-400",
    },
    {
      header: "Aksi",
      align: "center",
      accessor: (item) => (
        <div className="flex items-center justify-center gap-2">
          <Button
            variant="ghost"
            size="sm"
            className="p-2 h-auto rounded-lg text-blue-500 hover:bg-blue-50 dark:hover:bg-blue-900/20"
            onClick={() => {
              setEditingAnggota(item);
              setFormData({
                nik: item.nik,
                nama_lengkap: item.nama_lengkap,
                jenis_kelamin: item.jenis_kelamin,
                desa: item.desa,
                hp: item.hp || "",
                alamat: item.alamat || "",
                usaha: item.usaha || "",
              });
              setIsModalOpen(true);
            }}
          >
            <svg
              className="w-5 h-5"
              fill="none"
              stroke="currentColor"
              viewBox="0 0 24 24"
            >
              <path
                strokeLinecap="round"
                strokeLinejoin="round"
                strokeWidth={2}
                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"
              />
            </svg>
          </Button>
          <Button
            variant="ghost"
            size="sm"
            className="p-2 h-auto rounded-lg text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20"
            onClick={() => handleDelete(item.id)}
          >
            <svg
              className="w-5 h-5"
              fill="none"
              stroke="currentColor"
              viewBox="0 0 24 24"
            >
              <path
                strokeLinecap="round"
                strokeLinejoin="round"
                strokeWidth={2}
                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
              />
            </svg>
          </Button>
        </div>
      ),
    },
  ];

  return (
    <div className="min-h-screen bg-zinc-50 dark:bg-black font-sans pb-20">
      {/* Header Section */}
      <div className="bg-white dark:bg-zinc-900 border-b border-zinc-200 dark:border-zinc-800 px-8 py-8 sticky top-0 z-40">
        <div className="max-w-7xl mx-auto flex flex-col md:flex-row md:items-center justify-between gap-6">
          <div>
            <h1 className="text-3xl font-bold text-zinc-900 dark:text-white">
              Master Anggota
            </h1>
            <p className="text-zinc-500 mt-1">
              Kelola data nasabah dan anggota kecamatan.
            </p>
          </div>
          <Button
            onClick={() => {
              setEditingAnggota(null);
              resetForm();
              setIsModalOpen(true);
            }}
            icon={
              <svg
                className="w-5 h-5"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
              >
                <path
                  strokeLinecap="round"
                  strokeLinejoin="round"
                  strokeWidth={2}
                  d="M12 4v16m8-8H4"
                />
              </svg>
            }
          >
            Tambah Anggota
          </Button>
        </div>
      </div>

      <main className="max-w-7xl mx-auto p-8">
        {/* Search & Filter */}
        <div className="mb-8 flex gap-4">
          <div className="flex-1 relative">
            <input
              type="text"
              placeholder="Cari berdasarkan nama atau NIK..."
              value={search}
              onChange={(e) => setSearch(e.target.value)}
              className="w-full bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-2xl px-12 py-4 text-zinc-900 dark:text-white focus:ring-2 focus:ring-blue-500 outline-none transition-all shadow-sm"
            />
            <svg
              className="w-6 h-6 absolute left-4 top-1/2 -translate-y-1/2 text-zinc-400"
              fill="none"
              stroke="currentColor"
              viewBox="0 0 24 24"
            >
              <path
                strokeLinecap="round"
                strokeLinejoin="round"
                strokeWidth={2}
                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
              />
            </svg>
          </div>
        </div>

        {/* Smart Table */}
        <SmartTable
          data={anggota}
          columns={columns}
          loading={loading}
          pagination={
            pagination
              ? {
                  ...pagination,
                  onPageChange: fetchAnggota,
                }
              : undefined
          }
        />
      </main>

      {/* Form Modal */}
      <Modal
        isOpen={isModalOpen}
        onClose={() => {
          setIsModalOpen(false);
          setEditingAnggota(null);
        }}
        title={editingAnggota ? "Edit Anggota" : "Tambah Anggota Baru"}
      >
        <form onSubmit={handleSubmit} className="space-y-6">
          <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
            <Input
              label="NIK (16 Digit)"
              required
              maxLength={16}
              value={formData.nik}
              onChange={(e) =>
                setFormData({ ...formData, nik: e.target.value })
              }
            />
            <Input
              label="Nama Lengkap"
              required
              value={formData.nama_lengkap}
              onChange={(e) =>
                setFormData({ ...formData, nama_lengkap: e.target.value })
              }
            />
            <div className="space-y-1.5">
              <label className="text-sm font-bold text-zinc-700 dark:text-zinc-300">
                Jenis Kelamin
              </label>
              <select
                value={formData.jenis_kelamin}
                onChange={(e) =>
                  setFormData({
                    ...formData,
                    jenis_kelamin: e.target.value as "L" | "P",
                  })
                }
                className="w-full px-4 py-3 rounded-xl border border-zinc-200 dark:border-zinc-800 bg-zinc-50 dark:bg-zinc-800 text-zinc-900 dark:text-white outline-none focus:ring-2 focus:ring-blue-500 transition-all"
              >
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
              </select>
            </div>
            <Input
              label="Desa"
              required
              value={formData.desa}
              onChange={(e) =>
                setFormData({ ...formData, desa: e.target.value })
              }
            />
            <Input
              label="No. HP"
              value={formData.hp}
              onChange={(e) => setFormData({ ...formData, hp: e.target.value })}
            />
            <Input
              label="Jenis Usaha"
              value={formData.usaha}
              onChange={(e) =>
                setFormData({ ...formData, usaha: e.target.value })
              }
            />
          </div>
          <Input
            type="textarea"
            label="Alamat Lengkap"
            rows={3}
            value={formData.alamat}
            onChange={(e) =>
              setFormData({ ...formData, alamat: e.target.value })
            }
          />

          <div className="pt-4 flex gap-4">
            <Button
              type="button"
              variant="outline"
              className="flex-1"
              onClick={() => setIsModalOpen(false)}
            >
              Batal
            </Button>
            <Button type="submit" className="flex-[2]" isLoading={isSubmitting}>
              {editingAnggota ? "Simpan Perubahan" : "Daftarkan Anggota"}
            </Button>
          </div>
        </form>
      </Modal>
    </div>
  );
}
