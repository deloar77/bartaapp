<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class PostLiked extends Notification implements ShouldQueue
{
    use Queueable;
    protected $post;
    protected $liker;

    /**
     * Create a new notification instance.
     */
    public function __construct($post,$liker)
    {
        $this->post=$post;
        $this->liker=$liker;
        Log::info($post->user_id);
    }

    // Store notification in the database
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    // Define how the notification should be stored in the database
    public function toDatabase($notifiable)
    {
        return [
            'post_id' => $this->post->id,
            'liker_id' => $this->liker->id,
            'liker_name' => $this->liker->first_name,
        ];
    }

    // Define how the notification should be broadcasted
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'post_id' => $this->post->id,
            'liker_id' => $this->liker->id,
            'liker_name' => $this->liker->first_name,
        ]);
    }

     /**
     * The broadcast channel this notification should go to.
     */
    public function broadcastOn()
    {
       
        return ['post-notifications.' . $this->post->user_id];
    }
    
}
