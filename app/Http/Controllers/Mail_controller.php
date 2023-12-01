<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB; // Importez la classe DB
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class Mail_controller extends Controller
{

    // INDEX

    public function index(){
        // Session::forget("erreur");
        // Session::forget("success");
        // return view("send_email");
        $path = storage_path('app/public/demande_de_proforma1.pdf');

        if(File::exists($path)){
            echo "Coucou bebe";
            $this->demande($path);
        }else{
            echo "Non nonnnnnnnnnnnnnnnnnnnnnn";
        }
        // $pdf = Storage::get();
        
    }

    // public function demande_proforma(Request $request) {

        

    // }

    public function demande($file_path) {
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->Mailer = "smtp";

        $mail->SMTPDebug  = 0;  
        $mail->SMTPAuth   = TRUE;
        $mail->SMTPSecure = "tls";
        $mail->Port       = 587;
        $mail->Host       = "smtp.gmail.com";
        $mail->Username   = "layahanjaratiana877@gmail.com";
        $mail->Password   = "myoq cybw mrhc mias";

        $mail->IsHTML(true);
        $mail->AddAddress("anjaratianasandratrinionylayah@gmail.com", "Layah 1");
        $mail->Subject = "Demande de proforma";

        // Content of the proforma request email
        $content = "<p>Bonjour,</p>";
        $content .= "<p>Veuillez trouver ci-joint la demande de proforma. Les détails complets se trouvent dans le fichier PDF attaché.</p>";
        $content .= "<p>Merci de traiter cette demande dès que possible.</p>";

        $mail->MsgHTML($content);

        // Attachment
        $mail->addAttachment($file_path, "Demande_de_proforma1.pdf");

        if(!$mail->Send()) {
            Session::flash("erreur", "Erreur lors de l'envoi de l'e-mail.");
            // return redirect()->route('test_mail')->with('erreur')
        } else {
            Session::flash("success", "Votre e-mail a bien été envoyé! .");
            // return redirect()->route('test_mail');
        }

        return view("send_email");
    }
}
