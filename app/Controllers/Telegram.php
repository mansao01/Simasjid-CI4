<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use Telegram\Bot\Api;
use App\Models\ChatbotModel;

class Telegram extends Controller
{
    protected $telegram;
    protected $chatbotModel;

    public function __construct()
    {
        // Inisialisasi API Telegram dengan token bot Anda
        $this->telegram = new Api('7350718072:AAFSCi4GXyj6cQbvi8qEOjyy5IFvMb6SiZg');
        $this->chatbotModel = new ChatbotModel();
    }

    public function index()
    {
        return view('bot');
    }

    public function sendMessage($chatId, $message, $parseMode = 'HTML')
    {
        try {
            // Kirim pesan ke chat ID
            $this->telegram->sendMessage([
                'chat_id' => $chatId,
                'text'    => $message,
                'parse_mode' => $parseMode,
            ]);
        } catch (\Exception $e) {
            // Tangani kesalahan jika terjadi
            return $this->response->setStatusCode(500, 'Error: ' . $e->getMessage());
        }

        return $this->response->setStatusCode(200, 'Message sent successfully');
    }

    public function webhook()
    {
        // Ambil update dari Telegram
        $update = $this->telegram->getWebhookUpdate();

        if ($update->has('message')) {
            // Ambil data pesan dan chat ID
            $message = $update->getMessage();
            $chatId = $message->getChat()->getId();
            $text = $message->getText();
        
            // Ambil informasi pengguna
            $from = $message->getFrom();
            $username = $from->getUsername();
            $firstName = $from->getFirstName(); // Ambil nama depan sebagai alternatif
        
            if ($username) {
                $username = '@' . $username;
            } else {
                $username = $firstName ? $firstName : 'User'; // Gunakan nama depan jika username tidak tersedia
            }      

        // Proses pesan
        if (strtolower($text) == 'info kegiatan bulan ini') {
            $kegiatan = $this->chatbotModel->getKegiatanBulanIni();
            $response = "Kegiatan Bulan Ini:\n";
            foreach ($kegiatan as $item) {
                $response .= "Nama Kegiatan: {$item['nama_kegiatan']},\nTanggal: {$item['tanggal']},\nWaktu: {$item['jam']}\n";
            }
        } elseif (strtolower($text) == 'info kegiatan') {
            $kegiatan = $this->chatbotModel->getKegiatanBerjalan();
            $response = "Kegiatan Berjalan:\n";
            foreach ($kegiatan as $item) {
                $response .= "Nama Kegiatan: {$item['nama_kegiatan']},\nTanggal: {$item['tanggal']},\nWaktu: {$item['jam']}\n";
            }
        } elseif (strpos(strtolower($text), 'lihat anggaran') === 0) {
            $namaKegiatan = trim(substr($text, strlen('lihat anggaran')));
            $agenda = $this->chatbotModel->getAgendaIdByName($namaKegiatan);
            if ($agenda) {
                $anggaran = $this->chatbotModel->getAnggaranByAgenda($agenda['id_agenda']);
                $response = "Anggaran untuk Kegiatan '{$namaKegiatan}':\n";
                foreach ($anggaran as $item) {
                    $response .= "Uraian: {$item['uraian']}, Biaya: {$item['biaya']}\n";
                }
            } else {
                $response = "Kegiatan '{$namaKegiatan}' tidak ditemukan.";
            }
        } elseif ($text == 'Hallo') {
            $response = "HALLO, {$username} :\n\nSelamat datang! Apakah ada yang bisa saya bantu hari ini?";
        } elseif ($text == 'Info') {
            $response = "INFO SEPUTAR CHATBOT.\n\n"
                . "Anda bisa memperoleh informasi seputar kegiatan masjid dengan mengirimkan pesan berikut:\n\n"
                . "<b>INFO KEGIATAN</b> - Untuk informasi kegiatan yang akan terlaksana.\n"
                . "<b>INFO KEGIATAN BULAN INI</b> - Untuk informasi kegiatan pada bulan ini.\n"
                . "<b>LIHAT ANGGARAN 'nama kegiatan'</b> - Untuk informasi anggaran dari kegiatan yang disebutkan.\n\n"
                . "Pastikan untuk menggunakan format yang tepat dan nama kegiatan yang sesuai.";
        } else {
            $response = "MAAF, PERINTAH TIDAK DIKENALI\n\nSilahkan kirim 'info' untuk melihat informasi chatbot";
        }

        // Kirim balasan
        $this->sendMessage($chatId, $response, 'HTML');

        return $this->response->setStatusCode(200, 'Webhook received');
    }
    }

    // Menyiapkan webhook
    public function setWebhook()
    {
        try {
            $this->telegram->setWebhook(['url' => 'https://7e15-103-153-246-133.ngrok-free.app/Simasjid-CI4/public/telegram/webhook']);
        } catch (\Exception $e) {
            // Tangani kesalahan jika terjadi
            return $this->response->setStatusCode(500, 'Error: ' . $e->getMessage());
        }

        return $this->response->setStatusCode(200, 'Webhook set successfully');
    }
}
