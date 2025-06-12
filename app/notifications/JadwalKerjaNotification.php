<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class JadwalKerjaNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $jadwal;

    public function __construct($jadwal)
    {
        $this->jadwal = $jadwal;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Jadwal Kerja Baru')
            ->line('Anda memiliki jadwal kerja baru:')
            ->line('Tanggal: ' . $this->jadwal->tanggal)
            ->line('Shift: ' . $this->jadwal->shift)
            ->line('Posisi: ' . $this->jadwal->posisi)
            ->action('Lihat Jadwal', url('/jadwal'));
    }

    public function toArray($notifiable)
    {
        return [
            'tanggal' => $this->jadwal->tanggal,
            'shift' => $this->jadwal->shift,
            'posisi' => $this->jadwal->posisi
        ];
    }
}