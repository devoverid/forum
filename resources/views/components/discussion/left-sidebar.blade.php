@php
    $menu = [
        [
            'text' => 'All Thread',
            'route' => route('discussion.index'),
            'activated' => (request()->get('filter', null) == null) && (url()->current() == route('discussion.index')),
            'icon' => 'far fa-comments'
        ],
        [
            'text' => 'Popular This Week',
            'route' => route('discussion.index') . '?filter=popular_this_week',
            'activated' => request()->get('filter', null) == 'popular_this_week',
            'icon' => 'far fa-star'
        ],
        [
            'text' => 'Popular All Time',
            'route' => route('discussion.index') . '?filter=popular',
            'activated' => request()->get('filter', null) == 'popular',
            'icon' => 'far fa-star'
        ],
        [
            'text' => 'Solved',
            'route' => route('discussion.index') . '?filter=solved',
            'activated' => request()->get('filter', null) == 'solved',
            'icon' => 'far fa-check-circle'
        ],
        [
            'text' => 'Unsolved',
            'route' => route('discussion.index') . '?filter=unsolved',
            'activated' => request()->get('filter', null) == 'unsolved',
            'icon' => 'far fa-times-circle'
        ],
    ];
    if (Auth::check())
    {
        array_unshift($menu, [
            'text' => 'My Thread',
            'route' => route('discussion.index', ['filter' => 'me']),
            'activated' => (request()->get('filter', null) == 'me'),
            'icon' => 'far fa-comment'
        ]);
    }
@endphp

<div class="forum-sidebar flex-none pr-10">
    <div class="mt-6">
        <ul class="mobile:hidden">
            @foreach ($menu as $item)
                <li class="mb-2 block">
                    <a
                        href="{{ $item['route'] }}"
                        class="
                            py-2 px-3 rounded-xs inline-block w-full text-gray-700
                            hover:bg-gray-100
                            {{ $item['activated'] ? 'pl-3 shadow-sm bg-gray-100 border-l-4 border-blue-500  text-blue-600' : 'pl-4' }}
                        "
                    >
                        <i class="{{ $item['icon'] }}"></i>
                        {{ $item['text'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
