<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'id' => ["integer"],
            'uid' => ["required", "integer"],
            'title' => ["required", "string"],
            'link' => ["required", "string"],
            'description' => ["required", "string"],
            'author_name' => ["required", 'string'],
//            'categories' => ["array"],
            'categories.*.name' => ["string"],
        ];
    }

    public function messages()
    {
        return [
            "id.integer" => __("locale.post.validation.id.integer"),

            "uid.required" => __("locale.post.validation.uid.required"),
            "uid.integer" => __("locale.post.validation.uid.integer"),

            "title.required" => __("locale.post.validation.title.required"),
            "title.string" => __("locale.post.validation.title.string"),

            "link.required" => __("locale.post.validation.link.required"),
            "link.string" => __("locale.post.validation.link.string"),

            "description.required" => __("locale.post.validation.description.required"),
            "description.string" => __("locale.post.validation.description.string"),

            "author_name.required" => __("locale.post.validation.author_name.required"),
            "author_name.string" => __("locale.post.validation.author_name.string"),

            "categories.array" => __("locale.post.validation.categories.array"),

            "categories.*.name.string" => __("locale.post.validation.categories.*.name.string"),

        ];
    }
}
