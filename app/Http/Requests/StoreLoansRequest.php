<?php

namespace App\Http\Requests;

use App\Models\Member;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class StoreLoansRequest extends FormRequest
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
            'member_id' => 'required|exists:members,id',
            'copy_id' => 'required|exists:book_copies,id,status,1',
            'return_date' => 'required|date'
        ];
    }

    /**
     * Get the "after" validation callables for the request.
     */
    public function after(): array
    {
        return [
            function (Validator $validator) {
                if (getSetting('loan_must_visitor') == 1 && !Member::find($this->member_id)->hasVisited) {
                    $validator->errors()->add(
                        'member_id',
                        'Anggota harus tercatat pada kunjungan terlebih dahulu'
                    );
                }
            }
        ];
    }
}
