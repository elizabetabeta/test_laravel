@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-3">
                @include('layouts.menu')
                <br>
                <h2 class="text text-warning text-center" id="broj">Broj oglasa: {{ $number }}</h2>
            </div>
            <div class="col-md-9" id="visina">
                <div class="card" id="prozirno">
                    <div class="card-header">Oglasi</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                            @if (\Session::has('success'))
                                <div class="alert alert-success">
                                    <ul>
                                        <li>{!! \Session::get('success') !!}</li>
                                    </ul>
                                </div>
                            @endif

                            <div class="row">
                                <div class="col">
                                    <form action="{{ route('search') }}" method="GET" role="search">

                                    <div class="input-group">
                                        <div class="form-outline">
                                            <input type="text" name="search" placeholder="Pretraži..." class="form-control" />
                                        </div>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                        <p><small class="text-muted">Pretraži po nazivu, sistemu ili max cijeni...</small></p>
                                    </form>
                                </div>
                                <div class="col">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Filter
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="/dostupni">Dostupni</a>
                                            <a class="dropdown-item" href="/prodani">Prodani</a>

                                        </div>
                                    </div>
                                </div>
                                <div class="col">

                                    @if(Auth()->user()->role != 'Admin')
                                <button type="button" class="btn btn-primary mb-3 float-right" data-toggle="modal" data-target="#exampleModalCenter">
                                    Dodaj novi oglas
                                </button>
                                    @endif
                                </div>
                            </div>

                            <br>

                        @foreach($devices as $device)

                                <div class="card mb-3" id="oglasikartice">
                                    <div class="row g-0">
                                        <div class="col-md-4">
                                            <a href="/oglasi{{ $device->id }}">
                                            <img style="border-radius: 25px"
                                                src="/storage/{{ $device->image }}" class="img-fluid rounded-start pb-2 ps-2" alt="Nema slike...">
                                            </a>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <a href="/oglasi{{ $device->id }}" style="text-decoration: none">
                                                <h5 class="card-title text-primary">{{ $device->naziv }}</h5>
                                                </a>
                                                    <hr>
                                                <h5 class="card-text">{{ $device->type->naziv }}</h5>

                                                <p class="card-text">{{ $device->cijena }} KM</p>
                                                @if( $device->isSold === 0 )
                                                    <h4 class="text text-success">
                                                        <i class="fa-solid fa-circle-check"></i>
                                                        Dostupno
                                                    </h4>
                                                @else
                                                    <h4 class="text text-danger">
                                                        <i class="fa-solid fa-circle-xmark"></i>
                                                        Prodano
                                                    </h4>
                                                @endif
                                                <br>
                                                <small>
                                                    Dodano {{ $device->created_at->diffForHumans() }}
                                                </small>
                                                <a href="/oglasi{{ $device->id }}" style="text-decoration: none">
                                                <p class="card-text"><small>
                                                        <br>Više...
                                                    </small></p>
                                                </a>
                                            </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- <td>
                                        <a href="/" type="button" class = "btn btn-primary">Uredi oglas</a>
                                    </td>
                                    <td>
                                        <a href="{{ route("devices.delete", $device->id) }}" class = "btn btn-danger">Obriši oglas</a>
                                    </td> -->

                                <!--<img src="http://ebis.co.za/main/wp-content/plugins/perspective/perspective/images/apple-devices-minimal.png" alt="#"
                                style="height: 80px; padding-left: 280px; margin-top: 20px; margin-bottom: 25px">-->

                        @endforeach
                        <!--<div class="d-flex justify-content-center"></div>-->
                            {{$devices->links('pagination::bootstrap-4')}}


                        <!-- Modal -->
                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <form method="POST" action="/oglas" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-primary" id="exampleModalLongTitle">Dodavanje oglasa</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Zatvori">
                                                <span aria-hidden="true">&times;</span>
                                            </button>

                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="device_type_id">Tip uređaja</label>
                                                <select
                                                        class="form-control" name="device_type_id" id="device_type_id">
                                                    @foreach($type as $t)
                                                        <option value="{{$t->id}}">
                                                            {{$t->naziv}}
                                                        </option>
                                                    @endforeach

                                                </select>
                                            </div>

                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="naziv">Naziv uređaja</label>
                                                    <input maxlength="60" type="text" class="form-control" name="naziv" id="naziv" value="{{ old('naziv') }}" placeholder="Naziv uređaja">

                                            </div>
                                            <div class="form-group">
                                                <label for="sistem">Operativni sistem</label>
                                                <input maxlength="60" type="text" class="form-control" name="sistem" id="sistem" placeholder="Unesite sistem">


                                            </div>
                                            <div class="form-group">
                                                <label for="godina_izdanja">Godina izdanja</label>
                                                <input min="1990" max="{{ now()->year }}" type="number" class="form-control" name="godina_izdanja" id="godina_izdanja" placeholder="Unesite godinu izdanja uređaja">


                                            </div>
                                            <div class="form-group">
                                                <label for="velicina">Velicina uređaja</label>
                                                <input min="0" max="10000" type="number" step="0.1" class="form-control" name="velicina" id="velicina" placeholder="Velicina uređaja">


                                            </div>
                                            <div class="form-group">
                                                <label for="kapacitet_baterije">kapacitet baterije uređaja</label>
                                                <input min="0" max="100000" type="number" class="form-control" name="kapacitet_baterije" id="kapacitet_baterije" placeholder="Kapacitet baterije">


                                            </div>
                                            <div class="form-group">
                                                <label for="memorija">Memorija uređaja</label>
                                                <input min="0" max="10000" type="number" class="form-control" name="memorija" id="memorija" placeholder="Memorija uređaja">


                                            </div>
                                            <div class="form-group">
                                                <label for="RAM">RAM uređaja</label>
                                                <input min="0" max="10000" type="number" class="form-control" name="RAM" id="RAM" placeholder="RAM uređaja">

                                            </div>
                                            <div class="form-group">
                                                <label for="kontakt">Vaš kontakt</label>
                                                <input maxlength="190" type="text" class="form-control" name="kontakt" id="kontakt" placeholder="Unesite način na koji vas korisnici mogu kontaktirati">


                                            </div>
                                            <div class="form-group">
                                                <label for="cijena">Cijena uređaja</label>
                                                <input min="0" max="10000" type="number" class="form-control" name="cijena" id="cijena" placeholder="Cijena uređaja">

                                            </div>
                                            <div class="form-group">
                                                <label for="boja">Boja uređaja</label>
                                                <input maxlength="50" type="text" class="form-control" name="boja" id="boja" placeholder="Boja uređaja">


                                            </div>
                                            <div class="form-group">
                                                <label for="opis">Opis vašeg uređaja</label>
                                                <input maxlength="190" type="text" class="form-control" name="opis" id="opis" placeholder="Ukratko opišite vaš uređaj">

                                            </div>
                                                <div class="form-group">
                                                    <label for="location">Lokacija</label>
                                                    <input maxlength="100" type="text" class="form-control" name="location" id="location" placeholder="Lokacija uređaja">

                                                </div>
                                                <label for="image" class="col-md-4 col-form-label">Dodajte sliku</label>

                                                <input type="file" class="form-control-file" id = "image" name="image">

                                                <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Zatvori</button>
                                            <button id="addDeviceBtn" type="submit" class="btn btn-primary">Spremi</button>
                                        </div>
                                    </div>
                                </div>
                                </div>
                                </div>
                            </form>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

<style>
    #broj{
        background-color: rgba(0,0,0,0.9);
        border: 1px solid white;
        border-radius: 15px;
        font-family: "Roboto", sans-serif;
    }
</style>

