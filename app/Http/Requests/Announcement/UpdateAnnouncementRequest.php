<?php

namespace App\Http\Requests\Announcement;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAnnouncementRequest extends FormRequest
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
            'company_id' => 'required|integer',
            'jobtitle' => 'required|string|max:255',
            'category_id' => 'required|integer',
            'city_id' => 'required|integer',
            'work_schedule' => 'required|string',
            'from_date' => 'required|date',
            'to_date' => 'required|date|after_or_equal:from_date',
            'requirements' => 'required|array|min:1',
            'requirements.*' => 'required|string', 
            'qualifications' => 'required|array|min:1',
            'qualifications.*' => 'required|string', 
            'announcement_image' => 'nullable|image|mimes:jpeg,png,jpg',
        ];
    }


    public function messages(): array
    {
        return [
            'company_id.required' => 'Ju lutem zgjidheni nje biznes',
            'jobtitle.required' => 'Titulli i Shpalljes nuk mund te jete i zbrazet',
            'category_id.required' => 'Ju lutem zgjidheni nje kategori',
            'city_id.required' => 'Ju lutem zgjidheni nje qytet',
            'work_schedule.required' => 'Ju lutem zgjidheni orarin e punes',
            'from_date.required' => 'Ju lutem zgjidheni datën e fillimit të shpalljes.',
            'to_date.required' => 'Ju lutem zgjidheni datën e mbarimit të shpalljes.',
            'to_date.after_or_equal' => 'Data e mbarimit të shpalljes duhet të jetë e barabartë ose më e madhe se data e fillimit të shpalljes.',
            'requirements.required' => 'Kerkesat e Shpalljes nuk mund te jene te zbrazeta',
            'requirements.*.required' => 'Se paku nje kerkes duhet te plotesohet',
            'qualifications.required' => 'Kualifikimet e Shpalljes nuk mund te jene te zbrazeta',
            'qualifications.*.required' => 'Se paku nje kualifikim duhet te plotesohet',
            'announcement_image.required' => 'Foto nuk mund te jete e zbrazet',
            'announcement_image.image' => 'Foto duhet te jete nje imazh',
            'announcement_image.mimes' => 'Foto duhet te jete e formatit: jpeg, png, jpg.',
        ];
    }

}
