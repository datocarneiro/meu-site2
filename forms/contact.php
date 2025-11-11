<?php
// Replace contact@example.com with your real receiving email address
$receiving_email_address = 'datocarneiro1@outlook.com';

if( file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php' )) {
  include( $php_email_form );
} else {
  die( 'Unable to load the "PHP Email Form" Library!');
}

$contact = new PHP_Email_Form;
$contact->ajax = true;

$contact->to = $receiving_email_address;
$contact->from_name = $_POST['name'];
$contact->from_email = $_POST['email'];
$contact->subject = $_POST['subject'];

// Uncomment below code if you want to use SMTP to send emails. You need to enter your correct SMTP credentials
/*
$contact->smtp = array(
  'host' => 'example.com',
  'username' => 'example',
  'password' => 'pass',
  'port' => '587'
);
*/

$contact->add_message( $_POST['name'], 'From');
$contact->add_message( $_POST['email'], 'Email');
isset($_POST['phone']) && $contact->add_message($_POST['phone'], 'Phone');
$contact->add_message( $_POST['message'], 'Message', 10);

echo $contact->send();
?> 

<!-- ############################################### -->


<?php
// Endereço de e-mail que vai receber as mensagens do formulário
$receiving_email_address = 'datocarneiro1@outlook.com';

// Caminho da biblioteca PHP Email Form
$php_email_form = '../assets/vendor/php-email-form/php-email-form.php';

if (file_exists($php_email_form)) {
  include($php_email_form);
} else {
  die('Unable to load the "PHP Email Form" Library!');
}

$contact = new PHP_Email_Form;
$contact->ajax = true;

// Configurações básicas
$contact->to = $receiving_email_address;
$contact->from_name = $_POST['name'] ?? 'Visitante';
$contact->from_email = $_POST['email'] ?? 'no-reply@datocarneiro.com.br';
$contact->subject = $_POST['subject'] ?? 'Contato via site';

// Configuração SMTP via variáveis de ambiente (recomendado)
$smtp_user = getenv('SMTP_USER');
$smtp_pass = getenv('SMTP_PASS');

if ($smtp_user && $smtp_pass) {
  $contact->smtp = array(
    'host' => 'smtp.office365.com',
    'username' => 'datocarneiro1@outlook.com',
    'password' => 'Joshm@ath1620',
    'port' => '587'
  );
} else {
  error_log('⚠️ SMTP_USER e SMTP_PASS não definidos no container.');
}

// Mensagem
$contact->add_message($_POST['name'] ?? '', 'From');
$contact->add_message($_POST['email'] ?? '', 'Email');
if (isset($_POST['phone'])) {
  $contact->add_message($_POST['phone'], 'Phone');
}
$contact->add_message($_POST['message'] ?? '', 'Message', 10);

// Envia
echo $contact->send();
?>
