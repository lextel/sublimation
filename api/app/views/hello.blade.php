@if(Auth::check())
<h1>欢迎来到大乐乐淘 "{{ Auth::user()->username }}"</h1>
@else
<h1>欢迎来到大乐乐淘</h1>
@endif
