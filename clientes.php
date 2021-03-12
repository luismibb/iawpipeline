<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';
class Cliente {
    //Estado
    private $dni;
    private $nombre;
    private $apellidos;
    private $fnac;
    private $email;

    //Comportamiento
    function __construct($dni,$nombre,$apellidos,$fnac,$email) {
        $this->dni = $dni;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->fnac = $fnac;
        $this->email = $email;
    }

    //darse de alta
    function darAlta($conn) {
        $sql = "INSERT INTO clientes (dni,nombre,apellidos,fechadenacimiento,email) VALUES ('$this->dni','$this->nombre','$this->apellidos','$this->fnac','$this->email');"; 

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
            //hago la construccion del email y lo mando
            // Load Composer's autoloader


            // Instantiation and passing `true` enables exceptions
            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
                $mail->isSMTP();                                            // Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                $mail->Username   = 'equipo4tiendaweb@gmail.com';                     // SMTP username
                $mail->Password   = 'bolson1234';                               // SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
                //Recipients
                $mail->setFrom('from@example.com', 'Mailer');
                $mail->addAddress("$this->email");     // Add a recipient              
                $mail->addReplyTo('equipo4tiendaweb@gmail.com', 'Information');
                $mail->addCC('equipo4tiendaweb@gmail.com');
                $mail->addBCC('equipo4tiendaweb@gmail.com');

                // Attachments
                //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

                // Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'Registro en nuestra TiendaWeb';
                $mail->Body    = 'Registro completado <b> Disfruta de nuestros servicios</b>';
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                $mail->send();
                echo 'Mensaje enviado';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        
    
          } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
          }
    }

    function buscarCliente($busqueda,$tipoBusqueda,$conn){

                // Consulta para realizar la búsqueda en la base de datos
        $sql = "SELECT * FROM clientes WHERE ";
        switch ($tipoBusqueda){
          case "onom":
            $sql = $sql."nombre like '%$busqueda%';";
          break;
          case "oape":
            $sql = $sql."apellidos like '%$busqueda%';";
          break;
          case "omail":
            $sql = $sql."email like '%$busqueda%';";
          break;
          case "odni":
            $sql = $sql."dni like '%$busqueda%';";
          break;
          default:
            echo "Se ha producido un error durante la búsqueda.";
        }

        $resultado = mysqli_query($conn, $sql);

        // Consulta para realizar la busqueda en la base de datos
        if (mysqli_num_rows($resultado) > 0) {
          // Salida de datos por cada fila
          while($row = mysqli_fetch_assoc($resultado)) {
            echo "- Nombre: ".$row["nombre"].", Apellidos: ".$row["apellidos"].", Email: ".$row["email"].", DNI: ".$row["dni"]."<br>";
          }
        }else{
          echo "No se han encontrado resultados.";
        }



    }
    


   }
?>