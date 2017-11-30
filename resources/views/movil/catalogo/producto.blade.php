@foreach($productos as $prod)
<div class="card well" style="width: 20rem;">
    <img  src="{{asset('img/productos/'.$prod -> imagen)}}"
         alt="{{$prod -> nombre}}" height="100px" width="200px"
         class="img-thumbnail card-img-top">

    <div class="card-block">
        <h4 class="card-title">{{$prod->nombre}}</h4>
        <p class="card-text">Precio {{$prod->precioUVenta}} <br>
                            PuntoNecesarios {{$prod->puntosPorVenta}}</p>
    </div>

    <div class="card-block">
        <a   href="{{url('movil/canjear/'.$prod->id)}}" class="card-link btn btn-success">Canjear</a>
        <a href="{{url('movil/reservar/'.$prod->id)}}"  class="card-link btn btn-info">Reservar</a>
    </div>

</div>
    @endforeach