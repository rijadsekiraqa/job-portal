<?php

namespace App\Http\Requests\Announcement;

use Illuminate\Foundation\Http\FormRequest;

class CreateAnnouncementRequest extends FormRequest
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
            'name' => 'required|exists:companies,id',
            'jobtitle' => 'required|string|max:255',
            'category' => 'required',
            'city' => 'required',
            'work_schedule' => 'required',
            'from_date_full' => 'required|date|after_or_equal:' . now()->toDateString(),
            'to_date_full' => 'required|date|after_or_equal:from_date',
            'description' => 'required|string|min:50|max:1000',
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
            'name.required' => 'Ju lutem zgjidheni nje biznes',
            'jobtitle.required' => 'Titulli i Shpalljes nuk mund te jete i zbrazet',
            'category.required' => 'Ju lutem zgjidheni nje kategori',
            'city.required' => 'Ju lutem zgjidheni nje qytet',
            'work_schedule.required' => 'Ju lutem zgjidheni orarin e punes',
            'from_date_full.required' => 'Ju lutem zgjidheni daten e fillimit te shpalljes',
            'from_date_full.after_or_equal' => 'Data e Fillimit te shpalljes duhet te jete me se paku ' . now()->toDateString(),
            'to_date_full.required' => 'Ju lutem zgjidheni daten e mbarimit te shpalljes',
            'to_date_full.after_or_equal' => 'Data e mbarimit te shpalljes duhet te jete e barabarte ose me e madhe se data e fillimit te shpalljes',
            'description.required' => 'Pershkrimi i Shpalljes është i detyrueshme.',
            'description.min' => 'Përshkrimi duhet të ketë të paktën 50 shkronja.',
            'description.max' => 'Përshkrimi i Shpalljes nuk mund të ketë më shumë se 1000 shkronja.',
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
