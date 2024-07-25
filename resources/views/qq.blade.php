
<form action="{{ route('gen') }}" method="post">
    @csrf

    <input name="code">
</form>
@if(isset($code))
    {{ $code }}
@endif
