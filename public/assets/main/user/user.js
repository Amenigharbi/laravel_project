/**script pour la verification de l'enregistrement des utilisateurs */

$('#register-user').click(function()
{
    var firstname=$('#FirstName').val();
    var lastname=$('#LastName').val();
    var email=$('#email').val();
    var pass=$('#password').val();
    var passConf=$('#PasswordConfirm').val();
    var agreeTerms=$('#agreeTerms');
    var passLength=pass.length;



    if(firstname !="" && /^[a-zA-Z ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ]+$/.test(firstname))
    {
        $('#FirstName').removeClass('is-invalid');
        $('#FirstName').addClass('is-valid');
        $('#error-register-firstname').text('');
        if(lastname !="" && /^[a-zA-Z ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ]+$/.test(lastname))
        {
            $('#LastName').removeClass('is-invalid');
            $('#LastName').addClass('is-valid');
            $('#error-register-LastName').text('');

             if(email !="" && /^[a-z0-9._-]+@[a-z0-9._-]+\.[a-z]{2,6}$/.test(email))
             {
                $('#email').removeClass('is-invalid');
                $('#email').addClass('is-valid');
                $('#error-register-email').text('');



             if(passLength>=8)
             {
                $('#password').removeClass('is-invalid');
                $('#password').addClass('is-valid');
                $('#error-register-password').text('');
                if(pass==passConf)
                {
                    $('#PasswordConfirm').removeClass('is-invalid');
                    $('#PasswordConfirm').addClass('is-valid');
                    $('#error-register-password-confirm').text('');

                  if(agreeTerms.is(':checked'))
                  {
                    $('#agreeterms').removeClass('is-invalid');
                    $('#agreeterms').addClass('is-valid');
                    $('#error-register-agreeTerms').text('');

                     var res=Exister(email);
                     (res != 'exist')? $('#form-register').submit():$('#error-register-email').text('This email address is already used !!');


                  }else
                  {
                    $('#agreeterms').addClass('is-invalid');
                    $('#agreeterms').removeClass('is-valid');
                    $('#error-register-agreeTerms').text('you should agree our terms and conditions! ');
                  }

                }
                else
                {
                    $('#PasswordConfirm').addClass('is-invalid');
                    $('#PasswordConfirm').removeClass('is-valid');
                    $('#error-register-password-confirm').text('your password must be identical !!');
                }
             }
             else{
                $('#password').addClass('is-invalid');
                $('#password').removeClass('is-valid');
                $('#error-register-password').text('password is not valid,it must be at least 8 characters !! ');

             }
             }else{

               $('#email').addClass('is-invalid');
               $('#email').removeClass('is-valid');
               $('#error-register-email').text('Email is not valid ');

             }
        }else
        {
          $('#LastName').addClass('is-invalid');
          $('#LastName').removeClass('is-valid');
          $('#error-register-Lastname').text('Last Name is not valid ');

        }


    }else{
        $('#FirstName').addClass('is-invalid');//en cas d'erreur
        $('#FirstName').removeClass('is-valid');
        $('#error-register-firstname').text('FirstName is not valid !!');


    }


});

//evenement pour l'input terms et conditions
$('#agreeTerms').change(function()
{
var agree=$('#agreeTerms');

   if (agree.is(':checked'))
   {
    $('#agreeTerms').removeClass('is-invalid');
    $('#error-register-agreeTerms').text('');

   }
   else{
    $('#agreeTerms').addClass('is-invalid');
    $('#error-register-agreeTerms').text('you should agree our terms and conditions! ');

   }
});


function Exister(email)
{

   var url=$('#email').attr('url_email_exist');
   var token=$('#email').attr('token');
   var reponse="";

   $.ajax({

    type:'POST',
    url:url,
    data:{
        '_token':token,
        email:email
    },
    success:function(result)
    {
        reponse=result.data;
    },
    async:false /*si je n'utilise pas asynchrone la variable reponse ne peut pas etre utilisé en dehors de la fonction*/

   });
   return reponse;

}

