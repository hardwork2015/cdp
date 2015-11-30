<?php namespace App\Http\Requests;
/**
 * Created by PhpStorm.
 * User: oumaziz
 * Date: 26/11/15
 * Time: 11:49
 */

use App\Http\Requests\Request;

class NewUsRequest extends Request {

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
            "description" => 'required',
            "priority" => 'required',
            "difficulty" => 'required'
        ];
    }

}