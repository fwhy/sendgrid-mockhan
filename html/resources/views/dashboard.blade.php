@extends('_layout')

@section('container', 'container-fluid')

@section('content')
    <div class="row">
        <div class="cell">
            {{ $mails->links('_pagination') }}
        </div>
    </div>

    <div class="row my-0">
        <div class="cell">
            <table class="table striped row-hover row-border mb-0">
                <thead>
                <tr>
                    <th>To</th>
                    <th>Subject <span class="fg-grayBlue">-- Content</span></th>
                    <th>Datetime</th>
                </tr>
                </thead>
                <tbody>
                <?php /** @var \App\Models\Mail $mail */ ?>
                @foreach ($mails as $mail)
                    @foreach ($mail->personalizations as $personalization)
                        <tr>
                            <td class="p-0">
                                <a href="/{{ $personalization->id }}" class="d-block p-2 fg-dark text-">
                                    {{ $personalization->to[0]->name ?: $personalization->to[0]->email }}
                                    @if ($personalization->to->count() > 1)
                                        , <span class="text-gray-500">{{ $personalization->to->count() - 1 }}</span>
                                    @endif
                                </a>
                            </td>
                            <td class="p-0">
                                <a href="/{{ $personalization->id }}" class="d-block p-2 fg-dark">
                                    <span>{{ \Illuminate\Support\Str::limit($personalization->subject ?: $mail->subject, 50) }}</span>
                                    <span class="fg-grayBlue">
                                        -- {{ \Illuminate\Support\Str::limit(explode(PHP_EOL, strip_tags($mail->content[0]->formattedValue($personalization->substitutions)))[0], 50) }}
                                    </span>
                                </a>
                            </td>
                            <td class="p-0">
                                <a href="/{{ $personalization->id }}" class="d-block p-2 fg-dark">
                                    {{ $mail->created_at->format('M j G:i') ?: '--' }}
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="row mt-0">
        <div class="cell">
            {{ $mails->links('_pagination') }}
        </div>
    </div>
@endsection
