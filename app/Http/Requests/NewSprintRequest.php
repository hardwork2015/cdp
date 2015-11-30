<?php namespace App\Http\Requests;
/**
 * User: oumaziz
 * Date: 04/11/15
 * Time: 11:18
 */

use App\Http\Requests\Request;

class NewSprintRequest extends Request {

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
            'StartDate' => 'required|date',
            'EndDate' => 'required|date|after:StartDate'
        ];
    }

}