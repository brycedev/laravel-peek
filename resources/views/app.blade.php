<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <title>Laravel Peek</title>
    <link rel="stylesheet" href="{{ asset(mix('app.css', 'vendor/peek')) }}">
    @inertiaHead
  </head>
  <body @class(['dark bg-black' => config('peek.dark_mode', false)])>
    @inertia
    <script src="{{ asset(mix('app.js', 'vendor/peek')) }}"></script>
  </body>
</html>