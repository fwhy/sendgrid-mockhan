<?php
/**
 * @var \App\Models\Mail $mail
 * @var \App\Models\Personalization $personalization
 */
?>
@extends('_layout')

@section('container', 'container')

@section('content')
    <div class="row">
        <div class="col">
            <a href="/">
                <i class="mif-arrow-left"></i>
                Dashboard
            </a>
        </div>
    </div>

    <div class="row mt-0">
        <div class="col">
            <dl class="border p-3 mt-0">
                {{-- From --}}
                <dt class="m-2">From</dt>
                <dd class="m-2 pl-5">{{ $mail->from }}</dd>
                {{-- To --}}
                <dt class="m-2">To</dt>
                <dd class="m-2 pl-5">
                    @foreach ($personalization->to as $to)
                        <div>{{ $to }}</div>
                    @endforeach
                </dd>
                {{-- CC --}}
                @if ($personalization->cc->isNotEmpty())
                    <dt class="m-2">CC</dt>
                    <dd class="m-2 pl-5">
                        @foreach ($personalization->cc as $cc)
                            <div>{{ $cc }}</div>
                        @endforeach
                    </dd>
                @endif
                {{-- BCC --}}
                @if ($personalization->bcc->isNotEmpty())
                    <dt class="m-2">BCC</dt>
                    <dd class="m-2 pl-5">
                        @foreach($personalization->bcc as $bcc)
                            <div>{{ $bcc }}</div>
                        @endforeach
                    </dd>
                @endif
                {{-- Reply To --}}
                @if ($mail->reply_to)
                    <dt class="m-2">Reply To</dt>
                    <dd class="m-2 pl-5">
                        {{ $mail->reply_to }}
                    </dd>
                @endif
                <hr>
                {{-- Subject --}}
                <dt class="m-2">Subject</dt>
                <dd class="m-2 pl-5">
                    {{ $mail->subject }}
                </dd>
                <hr>
                {{-- Content --}}
                <dt class="m-2">Content</dt>
                <dd class="m-2 pl-5">
                    <?php /** @var \App\Models\Content $content */ ?>
                    @foreach ($mail->content as $content)
                        @unless ($loop->first) <br> @endunless

                        @if ($content->type === 'text/html')
                            {!! $content->formattedValue($personalization->substitutions) !!}
                        @else
                            {!! nl2br(e($content->formattedValue($personalization->substitutions))) !!}
                        @endif
                    @endforeach
                </dd>

                @if ($mail->attachments->isNotEmpty())
                    <hr>
                    {{-- Attachments --}}
                    <dt class="m-2">Attachments</dt>
                    <dd class="m-2 pl-5">
                        <?php /** @var \App\Models\Attachment $attachment */ ?>
                        @foreach ($mail->attachments as $attachment)
                            <a href="/download/{{ $attachment->id }}" class="button">
                                @switch ($attachment->type)
                                    @case('application/pdf') <i class="mif-file-pdf"></i> @break
                                    @case('application/zip') <i class="mif-file-zip"></i> @break
                                    @case('image/jpeg') <i class="mif-file-image"></i> @break
                                    @case('image/png') <i class="mif-file-image"></i> @break
                                    @default <i class="mif-file-empty"></i> @break
                                @endswitch

                                &nbsp;{{ $attachment->filename }}
                            </a>
                        @endforeach
                    </dd>
                @endif
            </dl>
        </div>
    </div>
@endsection
