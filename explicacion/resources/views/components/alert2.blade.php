@props(['colortext'=>"blue"])  {{-- lo que pasamos en props son parametros que pasamos y definimos dentro de una class o por el estilo, o cosas similares <x-alert colortext, .. etc --}}

{{-- Esto es un componente ANONIMO --}}

<div class="flex p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-{{ $colortext }}-800 dark:text-blue-400" role="alert">
    <svg class="flex-shrink-0 inline w-4 h-4 me-3 mt-[2px]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
      <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
    </svg>
    <span class="sr-only">Info</span>
    <div>
      <span class="font-medium">{{ $slot }}:</span>
        <ul class="mt-1.5 list-disc list-inside">
          <li>{{ $entrada1 }}</li> {{-- Como esto no está en props sabemos que esto es un slot con nombre.  --}}
          <li>{{ $entrada2 }}</li>
          <li>Inclusion of at least one special character, e.g., ! @ # ?</li>
      </ul>
    </div>
  </div>
