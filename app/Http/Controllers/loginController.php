<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class loginController extends Controller
{
    protected $request;
    function __construct(Request $request)
    {
         $this->request=$request;
    }
    public function logout(){
       Auth::logout();//pour deconnecté l'utilisateur
       return redirect()->route('login');
    }

    public function existEmail()
    {
        $email=$this->request->input('email');//lorsque on a requete post recupere moi cette valeur de email,le token laravel le gere automatiquement,pour pouvoir recuperer les données on utilise les tokens
        $user=User::where('email',$email)
                  ->first();

        $response="";
        //si l'utilisateur existe w user traja3li true or false
        ($user)? $response="exist" : $response="not_exist";

        return response()->json(
            ['data'=>$response]
        );
    }

     /* verifier si l'utilisateur a déjà activé son compte ou pas avant d'etre authentifié */

    public function userChecker()
    {

        $activation_token=Auth::user()->activation_token;
        $is_verified=Auth::user()->is_verified;

        if($is_verified!=1)
         {
            Auth::logout();
            return redirect()->route('app_activation_code',['token'=>$activation_token])
                             ->with('warning','Your account is not activated yet , please check your mail-box and activate your account or resend the confirmation message !');
         }
         else
         {
            return redirect()->route('app_dashboard');
         }


    }




    public function activationCode($token)
    {
        //la bouton de type submit il va valider la formulaire
        // si la requete de type post
        if($this->request->isMethod('post'))
        {
            $user=User::where('$activation_token',$token)->first();
            $code=$user->activation_code;
            $activation_code=$this->request->input('activation-code');
            //si le code saisie par l'utilisateur est different de celui qu'on a recuperer avec la requete alors
            if($activation_code!=$code)
            {
                return back()->with([
                    'danger'=>'This activation code is invalid !! ',
                    '$activation_code'=> $activation_code,
                ]);
            }
            else
            {
               //on va activer le compte d'utilisateur on va mettre is_verified=1 et on va supprimer le code d'activation et le token
               DB::table('users')
                  ->where('id',$user->id)
                               ->update([
                                  'is_verified'=> 1,
                                  'activation_code'=> '',
                                  'activation_token'=>'',
                                  'email_verified_at'=>new \DateTimeImmutable,
                                  'updated_at'=>new \DateTimeImmutable

                               ]);
                return redirect()->route('login')->with('success','Your email address has been verified ! ');
            }


        }
        //si non il va afficher la page de l'activation de code
       return view('auth.activation_code',[
         'token'=>$token

       ]);
    }



}
