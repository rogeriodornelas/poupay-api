<?php

namespace App\Http\Requests\Payment;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // policy
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
            'name' => ['required'],
            'value' => ['required'],
            'scheduled_payment_date' => ['required'],
            'file' => ['required', 'file'],
            'category_id' => ['required'],
            'recurrence_id' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'name' => "O campo nome é obrigatório",
            'value' => "O campo valor é obrigatório",
            'scheduled_payment_date' => "O campo data de vencimento é obrigatório",
            'file' => "O arquivo é obrigatório",
            'category_id' => "O campo categoria é obrigatório",
            'recurrence_id' => "O campo recorrência é obrigatório"
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(["message" => "Falha ao cadastrar pagamento", "errors" => $validator->errors()], 400));
    }
}
