<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidateRules implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return [
            'email.required' => 'Ama bize bir e-posta lazım.',
            'email.unique' => 'Böyle bir hesap zaten mevcut. ',
            'password.required' => 'Bu e-postanın sana ait olduğunu nasıl bileceğiz. Bu yüzden lütfen şifreni gir.',
            'password.required' => 'Senin güvenliğin için ',
            'username.required'=> 'Seni nasıl çağıracağız. Lütfen bir takma isim gir.',
            'surname.required' => ' Ama seni tanımak istiyoruz. Lütfen soyadını girer misin ? '
            ];
    }
}
