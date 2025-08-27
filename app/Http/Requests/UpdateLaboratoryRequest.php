<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLaboratoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:laboratories,code,' . $this->route('laboratory')->id,
            'description' => 'nullable|string',
            'location' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1|max:200',
            'operating_hours' => 'required|array',
            'operating_hours.monday' => 'nullable|array',
            'operating_hours.tuesday' => 'nullable|array',
            'operating_hours.wednesday' => 'nullable|array',
            'operating_hours.thursday' => 'nullable|array',
            'operating_hours.friday' => 'nullable|array',
            'operating_hours.saturday' => 'nullable|array',
            'operating_hours.sunday' => 'nullable|array',
            'blackout_dates' => 'nullable|array',
            'blackout_dates.*' => 'date',
            'contact_person' => 'nullable|string|max:255',
            'contact_email' => 'nullable|email|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'image_gallery' => 'nullable|array',
            'image_gallery.*' => 'url',
            'sop_documents' => 'nullable|array',
            'sop_documents.*' => 'string',
            'rules' => 'nullable|string',
            'status' => 'in:active,inactive,maintenance',
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
            'name.required' => 'Laboratory name is required.',
            'code.required' => 'Laboratory code is required.',
            'code.unique' => 'This laboratory code is already in use.',
            'location.required' => 'Laboratory location is required.',
            'capacity.required' => 'Laboratory capacity is required.',
            'capacity.min' => 'Laboratory capacity must be at least 1 person.',
            'capacity.max' => 'Laboratory capacity cannot exceed 200 people.',
            'operating_hours.required' => 'Operating hours are required.',
        ];
    }
}