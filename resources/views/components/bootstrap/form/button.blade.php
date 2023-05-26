@isset($url)
    <a
        href="{{ $url }}"
        
        @class([
            'py-2 text-nowrap',
            $class ?? 'btn btn-secondary',
            $small ? 'btn-sm' : '',
            $pill ? 'rounded-pill' : '',
            $disabled ? 'disabled' : '',
        ])

        @isset($dropdown)
            data-bs-toggle="dropdown"
            role="button"
            aria-expanded="false"
        @endisset
    >
        @isset($iconLeft)
            <span @class([ 'pe-2' => isset($label) ])>
                <i @class([ $iconLeft ]) ></i>
            </span>
        @endisset
        @isset($label)
            <span class="text-truncate">
                {{ $label }}
            </span>
        @endisset
        @isset($iconRight)
            <span @class([ 'ps-2' => isset($label) ])>
                <i @class([ $iconRight ]) ></i>
            </span>
        @endisset
    </a>
@else
    <button
        type="{{ $type ?? 'button' }}"

        @class([
            'py-2 text-nowrap',
            $class ?? 'btn btn-secondary',
            $small ? 'btn-sm' : '',
            $pill ? 'rounded-pill' : '',
            $disabled ? 'disabled' : '',
        ])

        @isset($dropdown)
            data-bs-toggle="dropdown"
            role="button"
            aria-expanded="false"
        @endisset

        @isset($bsToggle, $bsTarget)
            role="dialog"
        @endisset

        @isset($bsTarget)
            data-bs-target="{{ $bsTarget }}"
        @endisset

        @isset($bsToggle)
            data-bs-toggle="{{ $bsToggle }}"
        @endisset
    >
        @isset($iconLeft)
            <span @class([ 'pe-2' => isset($label) ])>
                <i @class([ $iconLeft ]) ></i>
            </span>
        @endisset
        @isset($label)
            <span class="text-truncate">
                {{ $label }}
            </span>
        @endisset
        @isset($iconRight)
            <span @class([ 'ps-2' => isset($label) || !isset($label) && isset($iconLeft) ])>
                <i @class([ $iconRight ]) ></i>
            </span>
        @endisset
    </button>
@endisset

@isset($dropdown)
    <ul class="dropdown-menu mt-2 border-0 shadow" data-bd-active="btn">
        @foreach($dropdown as $item)
            @isset($item->divider)
                <li><hr class="dropdown-divider"></li>
            @else
                <li>
                    @isset($item->href)
                        <a class="dropdown-item" href={{ $item->href }}>
                    @endisset
                        @isset($item->icon)
                            <span class="text-gray-600">
                                <i class={{ $item->icon }}></i>
                            </span>
                        @endisset
                        @isset($item->label)
                            <span>
                                {{ $item->label }}
                            </span>
                        @endisset
                    @isset($item->href)
                        </a>
                    @endisset
                </li>
            @endisset
        @endforeach
    </ul>
@endisset