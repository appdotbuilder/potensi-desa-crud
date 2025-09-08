<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKabupatenRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->hasRole('super_admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama_kabupaten' => 'required|string|max:255|unique:kabupatens,nama_kabupaten',
            'ibukota_kabupaten' => 'required|string|max:255',
            'jumlah_kecamatan' => 'required|integer|min:0',
            'deskripsi' => 'nullable|string',
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
            'nama_kabupaten.required' => 'Nama kabupaten is required.',
            'nama_kabupaten.unique' => 'Kabupaten with this name already exists.',
            'ibukota_kabupaten.required' => 'Ibukota kabupaten is required.',
            'jumlah_kecamatan.required' => 'Jumlah kecamatan is required.',
            'jumlah_kecamatan.integer' => 'Jumlah kecamatan must be a number.',
            'jumlah_kecamatan.min' => 'Jumlah kecamatan cannot be negative.',
        ];
    }
}