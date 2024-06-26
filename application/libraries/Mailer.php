<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mailer {
    protected $_ci;
    protected $email_pengirim = 'rizkikosasih1997@gmail.com'; // Isikan dengan email pengirim
    protected $nama_pengirim = 'Rizki Kosasih'; // Isikan dengan nama pengirim
    protected $password = 'mbhzvvufjaellmgl'; // Isikan dengan password email pengirim

    public function __construct(){
        $this->_ci = &get_instance(); // Set variabel _ci dengan Fungsi2-fungsi dari Codeigniter

        require_once(APPPATH.'third_party/phpmailer/Exception.php');
        require_once(APPPATH.'third_party/phpmailer/PHPMailer.php');
        require_once(APPPATH.'third_party/phpmailer/SMTP.php');
    }

    public function send($object){

        $data = json_decode($object);

        $mail = new PHPMailer;
        $mail->isSMTP();

        $mail->Host = 'smtp.gmail.com';
        $mail->Username = $this->email_pengirim; // Email Pengirim
        $mail->Password = $this->password; // Isikan dengan Password email pengirim
        $mail->Port = 587;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
        // $mail->SMTPDebug = 2; // Aktifkan untuk melakukan debugging

        $mail->setFrom($this->email_pengirim, $this->nama_pengirim);
        $mail->addAddress( $data->email_penerima, $data->nama );
        $mail->isHTML(true); // Aktifkan jika isi emailnya berupa html

        $mail->Subject = $data->subjek;
        $mail->Body = $data->content;
        // $mail->AddEmbeddedImage('image/logo.png', 'logo_mynotescode', 'logo.png'); // Aktifkan jika ingin menampilkan gambar dalam email

        $send = $mail->send();

        if($send){ // Jika Email berhasil dikirim
            $response = array( 
                'status' => 'sukses', 
                'message' => 'Email berhasil dikirim'
            );
        }else{ // Jika Email Gagal dikirim
            $response = array( 
                'status' => 'gagal', 
                'message' => $mail->ErrorInfo 
            );
        }

        return json_encode($response, JSON_PRETTY_PRINT);
    }

    public function send_with_attachment($object){
        $data = json_decode($object);

        $mail = new PHPMailer;
        $mail->isSMTP();

        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        $mail->Username = $this->email_pengirim; // Email Pengirim
        $mail->Password = $this->password; // Isikan dengan Password email pengirim
        $mail->Port = 587;
        // $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';
        // $mail->SMTPDebug = 2; // Aktifkan untuk melakukan debugging

        $mail->setFrom($this->email_pengirim, $this->nama_pengirim);
        $mail->addAddress($data->email_penerima, '');
        $mail->isHTML(true); // Aktifkan jika isi emailnya berupa html

        $mail->Subject = $data->subjek;
        $mail->Body = $data->content;
        // $mail->AddEmbeddedImage('image/logo.png', 'logo_mynotescode', 'logo.png'); // Aktifkan jika ingin menampilkan gambar dalam email

        if($data['attachment']['size'] <= 25000000){ // Jika ukuran file <= 25 MB (25.000.000 bytes)
            $mail->addAttachment($data->attachment['tmp_name'], $data->attachment['name']);

            $send = $mail->send();

            if($send){ // Jika Email berhasil dikirim
                $response = array( 
                    'status'=>'Sukses', 
                    'message'=>'Email berhasil dikirim'
                );
            }else{ // Jika Email Gagal dikirim
                $response = array( 
                    'status' => 'Gagal', 
                    'message' => $mail->ErrorInfo 
                );
            }
        }else{ // Jika Ukuran file lebih dari 25 MB
            $response = array( 
                'status' => 501, 
                'message'=> 'Ukuran file attachment maksimal 25 MB'
            );
        }

        return json_encode($response, JSON_PRETTY_PRINT);
    }
}