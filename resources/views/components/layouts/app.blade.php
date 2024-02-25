<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Fonts -->
  <link href="https://fonts.bunny.net" rel="preconnect">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

  <!-- Scripts -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen font-sans antialiased">
  {{-- Mobile navbar --}}
  <x-layouts.navigation />


  {{-- MAIN --}}
  <x-main full-width>
    {{-- SIDEBAR --}}
    <x-slot:sidebar class="bg-base-100 lg:bg-inherit" drawer="main-drawer" collapsible>

      {{-- BRAND --}}
      <div class="flex h-20 items-center gap-3 p-6 pt-3">
        <x-icon class="text-primary" name="o-square-3-stack-3d" />
        <div class="hidden-when-collapsed">App</div>
      </div>

      {{-- MENU --}}
      <x-menu activate-by-route>
        <x-menu-item title="Dashboard" icon="o-home" link="{{ route('dashboard') }}" />
        <x-menu-item title="Browse" icon="o-magnifying-glass" link="{{ route('browse') }}" />
        <x-menu-item title="Groups" icon="o-user-group" link="{{ route('groups.index') }}" />
        <x-menu-item title="Profile" icon="o-user" link="/" />
      </x-menu>
    </x-slot:sidebar>

    {{-- The `$slot` goes here --}}
    <x-slot:content class="min-h-screen bg-neutral-100 !pb-28">
      <div class="lg:max-w-screen-lg mx-auto lg:mt-10">
        {{ $slot }}
      </div>
    </x-slot:content>
  </x-main>

  {{--  TOAST area --}}
  <x-toast />
</body>

</html>
