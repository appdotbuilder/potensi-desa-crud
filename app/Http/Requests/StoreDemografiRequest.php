<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDemografiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->hasAnyRole(['super_admin', 'admin_desa']);
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
            'total_penduduk' => 'required|integer|min:0',
            'laki_laki' => 'required|integer|min:0',
            'perempuan' => 'required|integer|min:0',
            'usia_0_2' => 'required|integer|min:0',
            'usia_0_5' => 'required|integer|min:0',
            'usia_17_plus' => 'required|integer|min:0',
            'agama' => 'required|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu',
            'pendidikan_terakhir' => 'required|in:Tidak Sekolah,SD,SMP,SMA,Diploma,Sarjana,Pascasarjana',
            'pekerjaan' => 'required|in:Petani,Pedagang,PNS,Swasta,Nelayan,Buruh,Lainnya',
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
            'desa_id.required' => 'Desa is required.',
            'desa_id.exists' => 'Selected desa does not exist.',
            'total_penduduk.required' => 'Total penduduk is required.',
            'total_penduduk.integer' => 'Total penduduk must be a number.',
            'total_penduduk.min' => 'Total penduduk cannot be negative.',
            'laki_laki.required' => 'Jumlah laki-laki is required.',
            'perempuan.required' => 'Jumlah perempuan is required.',
            'agama.required' => 'Agama is required.',
            'agama.in' => 'Selected agama is invalid.',
        ];
    }
}