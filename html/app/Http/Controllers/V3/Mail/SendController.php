<?php

namespace App\Http\Controllers\V3\Mail;

use App\Http\Controllers\Controller;
use App\Models\Asm;
use App\Models\Attachment;
use App\Models\Content;
use App\Models\From;
use App\Models\Mail;
use App\Models\MailSetting;
use App\Models\MailSettingBypassListManagement;
use App\Models\MailSettingFooter;
use App\Models\MailSettingSandboxMode;
use App\Models\MailSettingSpamCheck;
use App\Models\Personalization;
use App\Models\PersonalizationBcc;
use App\Models\PersonalizationCc;
use App\Models\PersonalizationFrom;
use App\Models\PersonalizationTo;
use App\Models\ReplyTo;
use App\Models\TrackingSetting;
use App\Models\TrackingSettingClickTracking;
use App\Models\TrackingSettingGanalytics;
use App\Models\TrackingSettingOpenTracking;
use App\Models\TrackingSettingSubscriptionTracking;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SendController extends Controller
{
    use ValidationTrait;

    public function __invoke(Request $request)
    {
        $this->validation($request);
        // Log::debug($request->all());

        DB::transaction(function () use ($request) {
            $mail = Mail::create($request->all());

            foreach ($request->get('personalizations') as $rawP14s) {
                $p14s = Personalization::create(['mail_id' => $mail->id] + $rawP14s);

                if (isset($rawP14s['from'])) {
                    PersonalizationFrom::create(['personalization_id' => $p14s->id] + $rawP14s['from']);
                }

                foreach ($rawP14s['to'] as $to) {
                    PersonalizationTo::create(['personalization_id' => $p14s->id] + $to);
                }

                if (isset($rawP14s['cc'])) {
                    foreach ($rawP14s['cc'] as $cc) {
                        PersonalizationCc::create(['personalization_id' => $p14s->id] + $cc);
                    }
                }

                if (isset($rawP14s['bcc'])) {
                    foreach ($rawP14s['bcc'] as $bcc) {
                        PersonalizationBcc::create(['personalization_id' => $p14s->id] + $bcc);
                    }
                }
            }

            From::create(['mail_id' => $mail->id] + $request->get('from'));

            if ($request->has('reply_to')) {
                ReplyTo::create(['mail_id' => $mail->id] + $request->get('reply_to'));
            }

            foreach ($request->get('content') as $content) {
                Content::create(['mail_id' => $mail->id] + $content);
            }

            if ($request->has('attachments')) {
                foreach ($request->get('attachments') as $attachment) {
                    Attachment::create(['mail_id' => $mail->id] + $attachment);
                }
            }

            if ($request->has('asm')) {
                Asm::create(['mail_id' => $mail->id] + $request->get('asm'));
            }

            if ($request->has('mail_settings')) {
                $ms = new MailSetting();
                $ms->mail_id = $mail->id;
                $ms->save();

                $rawMs = $request->get('mail_settings');

                if (isset($rawMs['bypass_list_management'])) {
                    MailSettingBypassListManagement::create(
                        ['mail_setting_id' => $ms->id] + $rawMs['bypass_list_management']
                    );
                }

                if (isset($rawMs['footer'])) {
                    MailSettingFooter::create(['mail_setting_id' => $ms->id] + $rawMs['footer']);
                }

                if (isset($rawMs['sandbox_mode'])) {
                    MailSettingSandboxMode::create(['mail_setting_id' => $ms->id] + $rawMs['sandbox_mode']);
                }

                if (isset($rawMs['spam_check'])) {
                    MailSettingSpamCheck::create(['mail_setting_id' => $ms->id] + $rawMs['spam_check']);
                }
            }

            if ($request->has('tracking_settings')) {
                $ts = new TrackingSetting();
                $ts->mail_id = $mail->id;
                $ts->save();

                $rawTs = $request->get('tracking_settings');

                if (isset($rawTs['click_tracking'])) {
                    TrackingSettingClickTracking::create(
                        ['tracking_setting_id' => $ts->id] + $rawTs['click_tracking']
                    );
                }

                if (isset($rawTs['open_tracking'])) {
                    TrackingSettingOpenTracking::create(
                        ['tracking_setting_id' => $ts->id] + $rawTs['open_tracking']
                    );
                }

                if (isset($rawTs['subscription_tracking'])) {
                    TrackingSettingSubscriptionTracking::create(
                        ['tracking_setting_id' => $ts->id] + $rawTs['subscription_tracking']
                    );
                }

                if (isset($rawTs['ganalytics'])) {
                    TrackingSettingGanalytics::create(
                        ['tracking_setting_id' => $ts->id] + $rawTs['ganalytics']
                    );
                }
            }
        });

        return response('', Response::HTTP_ACCEPTED);
    }
}
