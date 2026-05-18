<?php
// ================= DATABASE CONNECTION =================
$host     = "localhost";      
$username = "gigkagxx_cardiologistadmin"; 
$password = "Cardiology@4345"; 
$database = "gigkagxx_drsubramanyamsspennerucardiologist";     

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("<script>alert('Database Connection Failed!'); window.history.back();</script>");
}

// ================= GET FORM DATA =================
$name     = htmlspecialchars($_POST['name']);
$phone    = htmlspecialchars($_POST['phone']);
$address  = htmlspecialchars($_POST['address']);
$location = htmlspecialchars($_POST['location']);
$message  = htmlspecialchars($_POST['message']);
$doctor   = "UB's Goutham Dental Care";
$date     = date("d M Y, h:i A");

// ================= SAVE TO DATABASE =================
$sql = "INSERT INTO appointments (name, phone, address, location, doctor, message, created_at)
        VALUES (?, ?, ?, ?, ?, ?, NOW())";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssss", $name, $phone, $address, $location, $doctor, $message);

if ($stmt->execute()) {

    // ================= SEND MAIL USING PHPMailer =================
    require 'vendor/phpmailer/src/PHPMailer.php';
    require 'vendor/phpmailer/src/Exception.php';
    require 'vendor/phpmailer/src/SMTP.php';

    $mail = new \PHPMailer\PHPMailer\PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = "drsubramanyamsspennerucardiologist.in"; 
        $mail->SMTPAuth   = true;
        $mail->Username   = "app@drsubramanyamsspennerucardiologist.in";
        $mail->Password   = "Cardiology@4345"; 
        $mail->SMTPSecure = "tls"; 
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom("app@drsubramanyamsspennerucardiologist.in", "Web Appointment");
        $mail->addAddress("dearknaveenofficial@gmail.com");

        // Content
        $mail->isHTML(true);
        $mail->Subject = "New Dental Appointment - $name";

        // ================= New Modern Responsive Template =================
       // ================= New Modern Responsive Template =================
$mail->Body = "
<!DOCTYPE html>
<html lang='en'>
<head>
  <meta charset='UTF-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
  <title>Appointment Details</title>
</head>
<body style='margin:0;padding:0;background:#f4f6f9;font-family:Arial,Helvetica,sans-serif;'>
  <table width='100%' cellpadding='0' cellspacing='0' style='background:#f4f6f9;padding:20px 0;'>
    <tr>
      <td align='center'>
        <table width='600' cellpadding='0' cellspacing='0' 
               style='background:#ffffff;border-radius:12px;overflow:hidden;
                      box-shadow:0 5px 15px rgba(0,0,0,0.08);
                      border:2px solid #12436E;'> <!-- ✅ Border Added -->

          <!-- Header Logo -->
          <tr>
            <td style='background:#fff;padding:25px;text-align:center;'>
              <img src='https://drsubramanyamsspennerucardiologist.in/assets/images/logos/ubs-logo.png' 
                   alt='Logo' style='max-height:60px;margin-bottom:10px;'>
            </td>
          </tr>

          <!-- Title Section -->
          <tr>
            <td style='background:#12436E;padding:25px;text-align:center;color:#fff;'>
              <h2 style='margin:0;font-size:22px;'>New Dental Appointment Request</h2>
              <p style='margin:5px 0 0;font-size:14px;color:#cce6ff;'>$date</p>
            </td>
          </tr>

          <!-- Content -->
          <tr>
            <td style='padding:25px;'>
              <h3 style='margin:0 0 15px;color:#12436E;font-size:20px;'>Dental Consultation Details</h3>
              <table width='100%' cellpadding='10' cellspacing='0' style='border-collapse:collapse;'>
                <tr style='background:#f9fbfd;'>
                  <td width='30%' style='color:#12436E;font-weight:bold;'>Name:</td>
                  <td style='color:#197CA6;'>$name</td>
                </tr>
                <tr>
                  <td style='color:#12436E;font-weight:bold;'>Mobile:</td>
                  <td style='color:#197CA6;'>$phone</td>
                </tr>
                <tr style='background:#f9fbfd;'>
                  <td style='color:#12436E;font-weight:bold;'>Address:</td>
                  <td style='color:#197CA6;'>$address</td>
                </tr>
                <tr>
                  <td style='color:#12436E;font-weight:bold;'>Location:</td>
                  <td style='color:#197CA6;'>$location</td>
                </tr>
                <tr style='background:#f9fbfd;'>
                  <td style='color:#12436E;font-weight:bold;'>Clinic:</td>
                  <td style='color:#197CA6;'>$doctor</td>
                </tr>
                <tr>
                  <td style='color:#12436E;font-weight:bold;'>Message:</td>
                  <td style='color:#197CA6;'>$message</td>
                </tr>
              </table>
            </td>
          </tr>

          <!-- Footer -->
          <tr>
            <td style='background:#12436E;padding:15px;text-align:center;color:#fff;font-size:13px;'>
              © ".date("Y")." UB's Goutham Dental Care
            </td>
          </tr>

        </table>
      </td>
    </tr>
  </table>
</body>
</html>";


        $mail->send();
        echo "<script>alert('Appointment booked successfully!'); window.location.href='data/index.html';</script>";
    } catch (\PHPMailer\PHPMailer\Exception $e) {
        echo "<script>alert('Database saved, but Email sending failed: {$mail->ErrorInfo}'); window.location.href='data/index.html';</script>";
    }

} else {
    echo "<script>alert('Failed to save appointment!'); window.history.back();</script>";
}

$stmt->close();
$conn->close();
?>
