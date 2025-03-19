<?php

namespace App\Notifications;

use App\Models\Rent;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReturnBookNotification extends Notification
{
    use Queueable;

    protected $rent;

    /**
     * Create a new notification instance.
     */
    public function __construct(Rent $rent)
    {
        $this->rent = $rent;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->greeting('Привет, ' . $notifiable->name)
            ->line('Вы должны вернуть книгу: ' . $this->rent->book->title)
            ->line('Срок возврата: ' . $this->rent->due_date)
            ->action('Перейти к возврату', route('books.index')) // 'rents.return', $this->rent->id
            ->line('Спасибо, что пользуетесь нашим сервисом!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'rent_id' => $this->rent->id,
            'book_id' => $this->rent->book_id,
            'due_date' => $this->rent->due_date
        ];
    }
}
