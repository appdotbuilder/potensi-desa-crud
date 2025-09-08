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
            'total_penduduk' => 'required|integer|min:0',
            'laki_laki' => 'required|integer|min:0',
            'perempuan' => 'required|integer|min:0',
            'usia_0_14' => 'required|integer|min:0',
            'usia_15_64' => 'required|integer|min:0',
            'usia_65_plus' => 'required|integer|min:0',
            'agama_mayoritas' => 'nullable|in:islam,kristen,katolik,hindu,buddha,konghucu',
            'islam' => 'required|integer|min:0',
            'kristen' => 'required|integer|min:0',
            'katolik' => 'required|integer|min:0',
            'hindu' => 'required|integer|min:0',
            'buddha' => 'required|integer|min:0',
            'konghucu' => 'required|integer|min:0',
            'tidak_sekolah' => 'required|integer|min:0',
            'sd' => 'required|integer|min:0',
            'smp' => 'required|integer|min:0',
            'sma' => 'required|integer|min:0',
            'diploma' => 'required|integer|min:0',
            'sarjana' => 'required|integer|min:0',
            'petani' => 'required|integer|min:0',
            'pedagang' => 'required|integer|min:0',
            'pns' => 'required|integer|min:0',
            'swasta' => 'required|integer|min:0',
            'tidak_bekerja' => 'required|integer|min:0',
            'tahun_data' => 'required|integer|min:2000|max:' . (date('Y') + 1),
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
            'total_penduduk.required' => 'Total penduduk harus diisi.',
            'total_penduduk.integer' => 'Total penduduk harus berupa angka.',
            'tahun_data.required' => 'Tahun data harus diisi.',
            'tahun_data.integer' => 'Tahun data harus berupa angka.',
        ];
    }
}