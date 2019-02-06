<?php

namespace saeedphr\imail;

use Illuminate\Support\Facades\Config;
use PhpImap\Exception;
use PhpImap\Mailbox;

class imail
{
    public static function getInbox($count)
    {
        self::checkImapExtenstion();
        $path=self::getImapPath();
        if(
            !Config::has('imail.IMAP_USER') ||
            !Config::has('imail.IMAP_PASSWORD')
        )
            dd('Imail email and password does not exists in Config.');

        $email=config('imail.IMAP_USER');
        $password=config('imail.IMAP_PASSWORD');
        $mailbox=null;

        $attachment_path=__DIR__.'/Attachments';
        $attachment=true;
        $attachment_dir=file_exists($attachment_path)?$attachment_path:false;
        if(!Config::has('imail.ATTACHMENT') || !config('imail.ATTACHMENT'))
        {
            $attachment=false;
            $attachment_dir=false;
        }


        try {
            $mailbox = new Mailbox('{' . $path . '}INBOX', $email, $password, $attachment_dir);
        } catch (Exception $e) {
            dd('Error : '.$e->getMessage());
        }

        if($mailbox==null || $mailbox==false)
            dd("error on getting mailbox.");

        // Read all messaged into an array:
        if(!Config::has('imail.SINCE'))
            dd("Since days not set on config file.");
        $days=config('imail.SINCE');
        $since=date('Ymd', strtotime("-{$days} days", time()));
        $mailsIds = $mailbox->searchMailbox('SINCE "'.$since.'"');
        if(!$mailsIds) {
            dd('Mailbox is empty');
        }

        rsort($mailsIds);// Put the latest email on top of listing

        $content='textHtml';
        if(!Config::has('imail.HTML') || !config('imail.HTML'))
            $content='textPlain';

        $result=array();
        $mail_count=count($mailsIds);
        for($i=0;$i<$count;$i++)
        {
            if($i+1>$mail_count)
                break;
            $mail = $mailbox->getMail($mailsIds[$i]);
            $result[$i]['subject']= $mail->subject;
            $result[$i]['date']= $mail->date;
            $result[$i]['fromName']= $mail->fromName;
            $result[$i]['fromAddress']= $mail->fromAddress;
            $result[$i]['content']= $mail->$content;
            if($attachment)
                $result[$i]['attachments']=$mail->getAttachments();
        }
        return $result;
    }

    private static function checkImapExtenstion()
    {
        if (!extension_loaded('imap')) {
            dd("IMAP PHP extenstion should be installed to use imail.");
        }
    }

    private static function getImapPath()
    {
        if(
            !Config::has('imail.IMAP_SERVER') ||
            !Config::has('imail.IMAP_PORT') ||
            !Config::has('imail.IMAP_SSL')
        )
            dd('Imail Config not Exists');
        $path=config('imail.IMAP_SERVER');
        $path.=':'.config('imail.IMAP_PORT').'/imap';
        if(Config('imail.IMAP_SSL')===true)
            $path.='/ssl';
        return $path;

    }
}