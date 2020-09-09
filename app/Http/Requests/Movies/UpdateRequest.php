<?php

namespace App\Http\Requests\Movies;

use App\Models\Movie;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'       => 'nullable|string',
            'description' => 'nullable|string',
            'rating'      => 'nullable|numeric|between:' . Movie::MIN_RATING . ',' . Movie::MAX_RATING,
            'image_url'   => 'nullable|url'
        ];
    }
}
