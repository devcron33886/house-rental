<?php


namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateSubscriberRequest extends FormRequest
{
   public function authorize()
   {
       abort_if(Gate::denies('subscriber_edit'),Response::HTTP_FORBIDDEN,'403 Forbidden');
   }
   public function rules()
   {
       return [
         'email'=>[
             'required',
             'email',
         ]
       ];
   }

}
