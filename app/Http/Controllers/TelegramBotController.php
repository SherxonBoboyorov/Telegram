<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Telegram\Bot\FileUpload\InputFile;
use Telegram\Bot\Laravel\Facades\Telegram;
use Illuminate\Support\Str;

class TelegramBotController extends Controller
{
    public function updatedActivity()
    {
        $activity = Telegram::getUpdates();
        dd($activity);
    }


    public function sendMessage()
    {
        return view('message');
    }

    public function storeMessage(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'message' => 'required'
        ]);

        $date = "A new contact us query\n"
            . "<b>Email Address: </b>\n"
            . "$request->email\n"
            . "<b>Message: </b>\n"
            . $request->message;

        Telegram::sendMessage([
            'chat_id' => env('TELEGRAM_CHANNEL_ID', '-1001971247287'),
            'parse_mode' => 'HTML',
            'text' => $date
        ]);


        return redirect()->back();
    }


    public function sendPhoto()
    {
        return view('photo');
    }

    public function storePhoto(Request $request)
    {
       $request->validate([
           'file' => 'file|mimes:png,jpg,gif'
       ]);

       $photo = $request->file('file');

       Telegram::sendPhoto([
            'chat_id' => env('TELEGRAM_CHANNEL_ID', '-1001971247287'),
            'photo' => InputFile::createFromContents(file_get_contents($photo->getRealPath()),  '.' . $photo->getClientOriginalExtension())
        ]);

        return redirect()->back();
    }
}
