
@foreach($items as $item)
{{ $item->url }}
  <li @lm_attrs($item) @if($item->url== Route::currentRouteName()) class="active"   @endif @lm_endattrs>
    @if($item->link) <a @lm_attrs($item->link) @if($item->hasChildren()) class="menu-toggle" href="javascript:void(0);" @else  href="{!! $item->url() !!}" @endif @lm_endattrs >
      <span> {!! $item->title !!} </span>
    
    </a>
    @else
      <span class="navbar-text">{!! $item->title !!}</span>
    @endif
    @if($item->hasChildren())
      <ul class="ml-menu">
        @include('admin.common.menulink',array('items' => $item->children()))
      </ul>
    @endif
  </li>
  @if($item->divider)
  	<li{!! Lavary\Menu\Builder::attributes($item->divider) !!}></li>
  @endif
@endforeach
