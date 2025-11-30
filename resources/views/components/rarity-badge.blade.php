@php
$colors = [
    'Ширпотреб' => 'bg-gray-600 text-white',
    'Промислове' => 'bg-blue-600 text-white',
    'Армійське' => 'bg-green-600 text-white',
    'Заборонене' => 'bg-purple-600 text-white',
    'Засекречене' => 'bg-pink-600 text-white',
    'Таємне' => 'bg-red-600 text-white',
    'Вкрай рідкісний' => 'bg-yellow-500 text-black',
];
@endphp

<span class="px-3 py-1 rounded-lg text-xs font-semibold {{ $colors[$value] ?? 'bg-gray-700 text-gray-200' }}">
    {{ $value }}
</span>
