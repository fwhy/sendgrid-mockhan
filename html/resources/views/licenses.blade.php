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

    <div class="row">
        <div class="col">
            <h1>Licenses</h1>

            <h2>PHP</h2>
            <pre class="border p-3 bg-grayMouse"><code class="fg-grayWhite">{{ $php }}</code></pre>

            <br>
            <hr>

            <h2>Javascript</h2>
            <pre class="border p-3 bg-grayMouse"><code class="fg-grayWhite">{{ $js }}</code></pre>
        </div>
    </div>
@endsection
