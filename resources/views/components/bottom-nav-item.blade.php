@props(['active' => false, 'active-icon', 'icon', 'label', 'link'])

<a class="{{ request()->routeIs($link) ? 'text-primary' : 'text-neutral-400' }}" href="{{ route($link) }}">
  @svg($icon, 'w-7 h-7')
  <span class="btm-nav-label text-sm">{{ $label }}</span>
</a>
