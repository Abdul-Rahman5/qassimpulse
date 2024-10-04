<?php

namespace App\Notifications;


// use Ichtrojan\Otp\Models\Otp;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Otp;
class EmailVerificationNotification extends Notification
{
    use Queueable;
    public $message;
    public $subject;
    public $fromEmail;
    public $mailer;
    public $otp;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        $this->message="use the below code for resetting your password";
        $this->subject='password resetting';
        $this->fromEmail="abdulrahmanom568@gmail.com";
        $this->mailer="smtp";
        $this->otp= new Otp;

        }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        //                          EmailUser|numberCode|exper 60miunt
        //$otp = Otp::generate('michael@okoh.co.uk', 6, 15);
        $otp=$this->otp->generate($notifiable->email,6,60);
        return (new MailMessage)
        ->mailer('smtp')
        ->subject($this->subject)
        ->greeting('Hello '.$notifiable->name)
        ->line($this->message)
        ->line("code: ".$otp->token);
                    // ->line('The introduction to the notification.')
                    // ->action('Notification Action', url('/'))
                    // ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
