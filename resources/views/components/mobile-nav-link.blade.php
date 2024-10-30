<div class="mobile-nav-link {{ strpos(Route::currentRouteName(), $name) !== false ? 'active' : '' }}">
    <div class="left-skewed"></div>
    <div class="right-skewed"></div>
    <div class="skewed"></div>
    <a href="{{ route($name) }}">{{ $text }}</a>
</div>