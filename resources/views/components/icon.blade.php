<button
    {{ $attributes->merge([
        'type' => 'button',
        'class' =>
            'inline-flex items-center p-1 border border-transparent rounded-md text-xs text-white disabled:opacity-50 transition ease-in-out duration-300 hover:opacity-85 transform hover:-translate-y-1',
    ]) }}>
    {{ $slot }}
</button>