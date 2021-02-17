<?php

namespace App\Notifications\Frontend\Auth;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

/**
 * Class UserNeedsConfirmation.
 */
class UserNeedsConfirmation extends Notification
{
    use Queueable;

    /**
     * @var
     */
    protected $confirmation_code;
    
    protected $first_name;
    
    protected $last_name;

    /**
     * UserNeedsConfirmation constructor.
     *
     * @param $confirmation_code
     */
    public function __construct($confirmation_code, $first_name, $last_name)
    {
        $this->confirmation_code = $confirmation_code;
        
        $this->first_name = $first_name;
        
        $this->last_name = $last_name;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage())
            ->subject(app_name().': '.__('exceptions.frontend.auth.confirmation.confirm'))
            ->line(__('strings.emails.auth.click_to_confirm',['name'=>$this->first_name, 'surname' => $this->last_name]))
            ->action(__('buttons.emails.auth.confirm_account'), route('frontend.auth.account.confirm', $this->confirmation_code))
            ->line(__('strings.emails.auth.thank_you_for_using_app'));
    }
}
