<!DOCTYPE html>
<html lang='en' class="h-full bg-gray-50">
<head>
    <title>StreamStats|App</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/>
    <link rel="icon" :href="asset('/images/logo.png')" type="image/png" sizes="16x16">
    {{--styles--}}
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet"/>

    {{--scripts--}}

    @inertiaHead

    <script src="{{ asset('/js/app.js') }}" defer></script>
    <script>window._asset = '{{ asset('') }}';</script>

</head>
<body class='h-full'>
@inertia
@routes
</body>
</html>
