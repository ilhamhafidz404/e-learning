<a href="{{ route('dashboard') }}" class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition
    @if (request()->is('dashboard'))
        border-indigo-400
        hover:border-indigo-300
    @else
        border-transparent
        hover:border-gray-300
    @endif
">
    Dashboard
</a>

<a href="{{ route('index.lesson') }}" class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition
    @if (request()->is('lessons*'))
        border-indigo-400
        hover:border-indigo-300
    @else
        border-transparent
        hover:border-gray-300
    @endif
">
    Pelajaran
</a>

<a href="{{ route('add.question') }}" class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition
    @if (request()->is('addquestion*'))
        border-indigo-400
        hover:border-indigo-300
    @else
        border-transparent
        hover:border-gray-300
    @endif
">
    Buat Soal
</a>