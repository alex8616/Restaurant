<link href="http://fonts.cdnfonts.com/css/danny-varefella" rel="stylesheet">
<h1 id="txt">hola Mundo</h1>
<style>
@import url('http://fonts.cdnfonts.com/css/danny-varefella');
#txt{
    background: red;
    font-family: cursive;
}
</style>

@foreach ($platos as $plato)
    <img src="{{ public_path('storage/img/otro.jpg') }}" />

@endforeach