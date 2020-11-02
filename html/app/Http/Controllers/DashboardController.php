<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\Mail;
use App\Models\Personalization;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $mails = Mail::orderByDesc('id')->paginate(25);

        return view('dashboard')
            ->with([
                'mails' => $mails,
            ]);
    }

    public function show(int $personalizationId)
    {
        $personalization = Personalization::findOrFail($personalizationId);
        $mail = $personalization->mail;

        return view('detail')
            ->with([
                'mail' => $mail,
                'personalization' => $personalization,
            ]);
    }

    public function download(int $attachmentId)
    {
        $attachment = Attachment::findOrFail($attachmentId);

        return new StreamedResponse(
            fn() => file_put_contents('php://output', base64_decode($attachment->content)),
            200,
            [
                'Content-Type' => $attachment->type,
                'Content-Disposition' => 'attachment; filename=' . $attachment->filename,
            ]
        );
    }
}
