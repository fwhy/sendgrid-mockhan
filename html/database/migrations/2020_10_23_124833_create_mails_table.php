<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mails', function (Blueprint $table) {
            $table->id();
            $table->text('subject');
            $table->text('template_id')->nullable();
            $table->text('headers')->nullable();
            $table->text('categories')->nullable();
            $table->text('custom_args')->nullable();
            $table->integer('send_at')->nullable();
            $table->text('batch_id')->nullable();
            $table->text('ip_pool_name')->nullable();
            $table->dateTime('created_at')->nullable();
        });

        Schema::create('personalizations', function (Blueprint $table) {
            $table->id();
            $table->integer('mail_id');
            $table->text('subject')->nullable();
            $table->text('headers')->nullable();
            $table->text('substitutions')->nullable();
            $table->text('custom_args')->nullable();
            $table->text('send_at')->nullable();
        });
        Schema::create('personalization_froms', function (Blueprint $table) {
            $table->id();
            $table->integer('personalization_id');
            $table->text('email');
            $table->text('name')->nullable();
        });
        Schema::create('personalization_tos', function (Blueprint $table) {
            $table->id();
            $table->integer('personalization_id');
            $table->text('email');
            $table->text('name')->nullable();
        });
        Schema::create('personalization_ccs', function (Blueprint $table) {
            $table->id();
            $table->integer('personalization_id');
            $table->text('email');
            $table->text('name')->nullable();
        });
        Schema::create('personalization_bccs', function (Blueprint $table) {
            $table->id();
            $table->integer('personalization_id');
            $table->text('email');
            $table->text('name')->nullable();
        });

        Schema::create('froms', function (Blueprint $table) {
            $table->id();
            $table->integer('mail_id');
            $table->text('email');
            $table->text('name')->nullable();
        });

        Schema::create('reply_tos', function (Blueprint $table) {
            $table->id();
            $table->integer('mail_id');
            $table->text('email');
            $table->text('name')->nullable();
        });

        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->integer('mail_id');
            $table->text('type');
            $table->text('value');
        });

        Schema::create('attachments', function (Blueprint $table) {
            $table->id();
            $table->integer('mail_id');
            $table->longText('content');
            $table->text('type')->nullable();
            $table->text('filename');
            $table->text('disposition')->nullable();
            $table->text('content_id')->nullable();
        });

        Schema::create('asms', function (Blueprint $table) {
            $table->id();
            $table->integer('mail_id');
            $table->integer('group_id');
            $table->text('groups_to_display')->nullable();
        });

        Schema::create('mail_settings', function (Blueprint $table) {
            $table->id();
            $table->integer('mail_id');
        });
        Schema::create('mail_setting_bypass_list_managements', function (Blueprint $table) {
            $table->id();
            $table->integer('mail_setting_id');
            $table->boolean('enable')->nullable();
        });
        Schema::create('mail_setting_footers', function (Blueprint $table) {
            $table->id();
            $table->integer('mail_setting_id');
            $table->boolean('enable')->nullable();
            $table->text('text')->nullable();
            $table->text('html')->nullable();
        });
        Schema::create('mail_setting_sandbox_modes', function (Blueprint $table) {
            $table->id();
            $table->integer('mail_setting_id');
            $table->boolean('enable')->nullable();
        });
        Schema::create('mail_setting_spam_checks', function (Blueprint $table) {
            $table->id();
            $table->integer('mail_setting_id');
            $table->boolean('enable')->nullable();
            $table->integer('threshold')->nullable();
            $table->text('post_to_url')->nullable();
        });

        Schema::create('tracking_settings', function (Blueprint $table) {
            $table->id();
            $table->integer('mail_id');
        });
        Schema::create('tracking_setting_click_trackings', function (Blueprint $table) {
            $table->id();
            $table->integer('tracking_setting_id');
            $table->boolean('enable')->nullable();
            $table->boolean('enable_text')->nullable();
        });
        Schema::create('tracking_setting_open_trackings', function (Blueprint $table) {
            $table->id();
            $table->integer('tracking_setting_id');
            $table->boolean('enable')->nullable();
            $table->text('substitution_tag')->nullable();
        });
        Schema::create('tracking_setting_subscription_trackings', function (Blueprint $table) {
            $table->id();
            $table->integer('tracking_setting_id');
            $table->boolean('enable')->nullable();
            $table->text('text')->nullable();
            $table->text('html')->nullable();
            $table->text('substitution_tag')->nullable();
        });
        Schema::create('tracking_setting_ganalytics', function (Blueprint $table) {
            $table->id();
            $table->integer('tracking_setting_id');
            $table->boolean('enable')->nullable();
            $table->text('utm_source')->nullable();
            $table->text('utm_medium')->nullable();
            $table->text('utm_term')->nullable();
            $table->text('utm_content')->nullable();
            $table->text('utm_campaign')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tracking_setting_ganalytics');
        Schema::dropIfExists('tracking_setting_subscription_trackings');
        Schema::dropIfExists('tracking_setting_open_trackings');
        Schema::dropIfExists('tracking_setting_click_trackings');
        Schema::dropIfExists('tracking_settings');
        Schema::dropIfExists('mail_setting_spam_checks');
        Schema::dropIfExists('mail_setting_sandbox_modes');
        Schema::dropIfExists('mail_setting_footers');
        Schema::dropIfExists('mail_setting_bypass_list_managements');
        Schema::dropIfExists('mail_settings');
        Schema::dropIfExists('asms');
        Schema::dropIfExists('attachments');
        Schema::dropIfExists('contents');
        Schema::dropIfExists('reply_tos');
        Schema::dropIfExists('froms');
        Schema::dropIfExists('personalization_bccs');
        Schema::dropIfExists('personalization_ccs');
        Schema::dropIfExists('personalization_tos');
        Schema::dropIfExists('personalization_froms');
        Schema::dropIfExists('personalizations');
        Schema::dropIfExists('mails');
    }
}
