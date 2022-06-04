@props(['name', 'route'])

<li class="nav-item menu-items">
    <a class="nav-link" href="{{ $route }}">
      <span class="menu-icon">
        <i class="mdi mdi-file-document-box"></i>
      </span>
      <span class="menu-title">{{ $name }}</span>
    </a>
</li>