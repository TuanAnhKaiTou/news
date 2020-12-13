<?php

namespace App\Http\Requests\News;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'title'         => 'bail|required|regex:/^[\w_ÀÁÃẢẠÂẤẦẨẪẬĂẮẰẲẴẶÈÉẸẺẼÊỀẾỂỄỆÌÍĨỈỊÒÓÕỌỎÔỐỒỔỖỘƠỚỜỞỠỢÙÚŨỤỦƯỨỪỬỮỰỲỴÝỶỸĐàáãạảâấầẩẫậăắằẳẵặèéẹẻẽêềếểễệìíĩỉịòóõọỏôốồổỗộơớờởỡợùúũụủưứừửữựỳýỵỷỹđ\s]{1,199}$/',
            'sub_title'     => 'bail|required|regex:/^[\w_ÀÁÃẢẠÂẤẦẨẪẬĂẮẰẲẴẶÈÉẸẺẼÊỀẾỂỄỆÌÍĨỈỊÒÓÕỌỎÔỐỒỔỖỘƠỚỜỞỠỢÙÚŨỤỦƯỨỪỬỮỰỲỴÝỶỸĐàáãạảâấầẩẫậăắằẳẵặèéẹẻẽêềếểễệìíĩỉịòóõọỏôốồổỗộơớờởỡợùúũụủưứừửữựỳýỵỷỹđ\s]{1,199}$/',
            'author'        => 'bail|required|regex:/^[.\w_ÀÁÃẢẠÂẤẦẨẪẬĂẮẰẲẴẶÈÉẸẺẼÊỀẾỂỄỆÌÍĨỈỊÒÓÕỌỎÔỐỒỔỖỘƠỚỜỞỠỢÙÚŨỤỦƯỨỪỬỮỰỲỴÝỶỸĐàáãạảâấầẩẫậăắằẳẵặèéẹẻẽêềếểễệìíĩỉịòóõọỏôốồổỗộơớờởỡợùúũụủưứừửữựỳýỵỷỹđ\s]{1,20}$/',
            'category_id'   => 'bail|required|integer',
            'source_id'     => 'bail|required|integer',
            'content'       => 'bail|required',
            'image'         => 'bail|nullable|image|mimes:jpg,jpeg,png'
        ];
    }

    public function messages() {
        return [
            'title.required'        => 'Please enter title',
            'sub_title.required'    => 'Please enter subtitle',
            'author.required'       => 'Please enter author',
            'category_id.required'  => 'Please choose category',
            'source_id.required'    => 'Please choose source',
            'content.required'      => 'Please enter content',

            'title.regex'           => 'Title is invalid',
            'sub_title.regex'       => 'Subtitle is invalid',
            'author.regex'          => 'Author is invalid',
            'category_id.integer'   => 'Category is invalid',
            'source_id.integer'     => 'Source is invalid',
            'image.image'           => 'Image must be image format',
            'image.mimes'           => 'Format image is invalid'
        ];
    }
}
