<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUmkmRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->hasRole('admin_desa') || $this->user()->isSuperAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'desa_id' => 'required|exists:desas,id',
            'nama_usaha' => 'required|string|max:255',
            'jenis_usaha' => 'required|in:perdagangan,jasa,manufaktur,kuliner,kerajinan,pertanian',
            'pemilik' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'jumlah_pekerja' => 'required|integer|min:0',
            'omset_tahunan' => 'nullable|numeric|min:0',
            'produk_utama' => 'nullable|string|max:255',
            'status' => 'required|in:aktif,tidak_aktif',
            'keterangan' => 'nullable|string',
        ];
    }

    /**
     * Get custom error messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'desa_id.required' => 'Desa harus dipilih.',
            'desa_id.exists' => 'Desa yang dipilih tidak valid.',
            'nama_usaha.required' => 'Nama usaha harus diisi.',
            'jenis_usaha.required' => 'Jenis usaha harus dipilih.',
            'pemilik.required' => 'Nama pemilik harus diisi.',
            'jumlah_pekerja.required' => 'Jumlah pekerja harus diisi.',
            'jumlah_pekerja.integer' => 'Jumlah pekerja harus berupa angka.',
            'status.required' => 'Status harus dipilih.',
        ];
    }
}