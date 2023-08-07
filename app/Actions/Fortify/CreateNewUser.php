<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Psy\Readline\Hoa\Console;
use App\Services\emailService;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        /* input est un tableau qui contient tous les données de la formulaire */
     /*
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
        ])->validate();
        */


        $email=$input['email'];
        $activation_token=md5(uniqid()).$email.sha1($email);//token permettra d'activer le compte de l'utilisateur

        $activation_code="";
        $length_code=6;
        for( $i=0;$i<$length_code;$i++)
        {
            $activation_code.=mt_rand(0,9);//chiffre random de 0 à 9
        }
        $name=$input['FirstName'] . ' ' . $input['LastName'];
        $emailSend=new emailService();
        $subject="activate your account";
        $message=view('mail.confirmation_email')
                     ->with([
                       'name'=>$name,
                       'activation_code'=>$activation_code,
                       'activation_token'=>$activation_token,


                     ]);
        $emailSend->sendEmail($subject,$email,$name,true,$message);
        return User::create([
            'name' => $name,
            'email'=> $email,
            'password' => Hash::make($input['password']),
            'activation_code'=>$activation_code,
            'activation_token'=>$activation_token
        ]);
    }
}
