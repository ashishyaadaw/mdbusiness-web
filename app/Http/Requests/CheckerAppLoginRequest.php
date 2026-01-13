<?php
namespace App\Http\Requests;
  
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class CheckerAppLoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "phone" => [
                "required",
                "string",
                "min:10",
                Rule::exists("users", "phone")->where(
                    fn($q) => $q->where("role", "admin"),
                ),
            ],
            "otp" => "nullable|string|min:4|max:6",
            "full_name" => "nullable|string|min:3|max:40",
            "fcm_key" => "nullable|string",
        ];
    }
    public function messages(): array
    {
        return [
            "phone.exists" => "Please use Admin Phone Number.",
        ];
    }
    /**
     * Handle a failed validation attempt.
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json(
                [
                    "errors" => $validator->errors(),
                ],
                422,
            ),
        );
    }
}
