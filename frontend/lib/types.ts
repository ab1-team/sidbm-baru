/**
 * Common Types & Interfaces for SIDBM Modern
 */

export interface IPagination {
  current_page: number;
  last_page: number;
  total: number;
}

export interface IAnggota {
  id: number;
  nik: string;
  nama_lengkap: string;
  jenis_kelamin: "L" | "P";
  desa: string;
  hp?: string;
  alamat?: string;
  usaha?: string;
  status: string;
  created_at?: string;
  updated_at?: string;
}

export interface ITenantInfo {
  message: string;
  tenant_id: string;
}

export interface IUser {
  id: number;
  name: string;
  username: string;
  email?: string;
  role_id?: number;
}
