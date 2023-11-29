<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB; // Importez la classe DB
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class Mail_controller extends Controller
{

    // INDEX

    public function index(){
        return view("send_email");
    }

    public function demande_proforma(Request $request) {
        try {
            $request->validate([
                'file_justificatif' => 'required|file|max:2048|mimes:pdf' // Max 2MB and only PDF files
            ]);
    
            $file_justificatif = null;
            $file_justificatif_name = null;
            $file_justificatif_path = null;

            if ($request->hasFile('file_justificatif')) {
                $file_justificatif = $request->file('file_justificatif');
                $file_justificatif_name = time() . '-' . $file_justificatif->getClientOriginalName();
                echo '<br>' . $file_justificatif_name;
                $file_justificatif->storeAs('public', $file_justificatif_name);
                Storage::putFileAs('public', $file_justificatif, $file_justificatif_name);

                $full_path = storage_path('app/public/'.$file_justificatif_name);

                echo '<br>Full Path: '.$full_path;
                $this->demande($full_path);
            }
        }
        catch (Exception $e) {
            echo '<br>Erreur: ' . $e->getMessage();
        }
    }

    public function demande($file_path) {
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->Mailer = "smtp";

        $mail->SMTPDebug  = 1;  
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
        $mail->addAttachment($file_path, "Demande_de_proforma.pdf");

        if(!$mail->Send()) {
            Session::put("erreur", "Erreur lors de l'envoi de l'e-mail.");
            return redirect()->route('test_mail');
            echo " Nonnnnnnnnnnnn!";
        } else {
            Session::put("success", "Votre e-mail a bien été envoyé! .");
            echo " OK!";
            return redirect()->route('test_mail');
        }
    }
}
