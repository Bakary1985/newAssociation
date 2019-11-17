<?php
namespace AppBundle\Service;
use PHPMailer\PHPMailer\PHPMailer;

class sendEmail 
{
    /**
    *
    *
    */
    private $data;
    /**
     *
     * @var string mandrill site
     */
    private $MANDRILL_SITE_URL = 'www.murinnovation.com';
    /**
     *
     * @var mandril object
     */
    private $mandrill;

    private $mandrillKey='881hmbmVFHx7aiiDGeNksg';

    public function __construct() {

    }

    /**
     * Envoi du mail de l'utilisateur
     *
     * @param
     *            $oUtilisateur
     * @return bool
     */
    // Mandrill
    public function sendHtmlMail_Mandrill($subject, $mail_from_name, $mail_from, $mail_to_name, $sendto, $html, $text = "Vous devez utiliser un gestionnaire de mail qui supporte le HTML", $files='')
    {
        $this->mandrill = new \Mandrill($this->mandrillKey);
        //$result = $this->mandrill->urls->getList();
        $mail_content = $html;

        if (!is_array($sendto)) {
            $sendto = array(
                array(
                    "email" => $sendto,
                    
                    "type" => "to",
                ),
            );
        } else {
            if (count($sendto['email'])>0 ) {
                $sendto = array(
                    $sendto['email'],
                );
            }
        }

        $attachments = null;
        $images = null;

        $message = array(
            //'html' => $mail_content,
            'text' => $mail_content,
            'subject' => $subject,
            'from_email' => $mail_from,
            'from_name' => $mail_from_name,
            'to' => $sendto,
            'headers' => array(
                'Reply-To' => $mail_from,
            ),
            'important' => false,
            'track_opens' => null,
            'track_clicks' => null,
            'auto_text' => null,
            'auto_html' => null,
            'inline_css' => null,
            'url_strip_qs' => null,
            'preserve_recipients' => null,
            'view_content_link' => null,
            'bcc_address' => null, // MANDRILL_SEND_BCC,
            'tracking_domain' => null,
            'signing_domain' => $this->MANDRILL_SITE_URL,
            'return_path_domain' => null,
            'merge' => true,
            'global_merge_vars' => array(
                array(
                    'name' => 'merge1',
                    'content' => 'merge1 content',
                ),
            ),

            'tags' => array(
                'ENOVA',
            ),
            // 'subaccount' => 'testAnd1544',
            'google_analytics_domains' => array(
                $this->MANDRILL_SITE_URL,
            ),
            'google_analytics_campaign' => 'message.from_' . $this->MANDRILL_SITE_URL,
            'metadata' => array(
                'website' => $this->MANDRILL_SITE_URL,
            ),
            /*'recipient_metadata' => array(
            array(
            'rcpt' => MANDRILL_METADATA_RCPT,
            'values' => array('user_id' => 145896325)
            )
            ),*/
            'attachments' => $attachments,
            'images' => $images,
        );

        $async = false;
        $ip_pool = 'Main Pool';
        $send_at = null;
        $result = $this->mandrill->messages->send($message, $async, $ip_pool, $send_at);
        
        $return = $result[0];

        // rejected //invalid //reject_reason
        $failed = array(
            'rejected',
            'invalid',
        );

        // "sent", "queued", "scheduled"
        $passed = array(
            'sent',
            'queued',
            'scheduled',
        );

        if (in_array($return['status'], $failed)) {
           // echo $return['reject_reason'];

            return false;
        } else if (in_array($return['status'], $passed)) {

           // return true;
        }

        return false;
    }
}

?>