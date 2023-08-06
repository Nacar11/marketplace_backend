<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;


class ProductItemRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'product_id' => 'required|exists:products,id',
            'qty_in_stock' => 'required|integer|min:0',
            'product_images' => '',
            'price' => 'required|numeric|min:0',
        ];
    }

    public function wantsJson()
    {
        return true;
    }

}
