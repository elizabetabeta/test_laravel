@extends('layouts.app')

@section('content')
    <div class="container" id="slika">
        <form action="{{ url('profile/update/'.$user->id) }}" enctype="multipart/form-data" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="form-group row">

                    <div class = "row">
                        <h1 class="text text-primary">Uredi svoj profil</h1>
                    </div>
                    <br><br><br>

                    <div class="row">

                    <div class="form-group col">
                        <label for="name" class="col-md-4 col-form-label">Korisničko ime</label>

                        <input id="name2" type="text" class="form-control @error('name') is-invalid @enderror"
                               name="name" value="{{ old('name') ?? $user->name }}"
                               autocomplete="name" autofocus>

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>

                    <div class="row">

                    <div class="form-group col">
                        <label for="email" class="col-md-4 col-form-label">Email</label>

                        <input id="email2" type="text" class="form-control @error('email') is-invalid @enderror"
                               name="email" value="{{ old('email') ?? $user->email }}"
                               autocomplete="email" autofocus>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    </div>

                    <div class="row">
                        <label for="profile_image" class="col-md-4 col-form-label">Profile Picture</label>

                        <input type="file" class="form-control-file" id = "profile_image" name="profile_image">
                        @error('profile_image')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                        @enderror
                    </div>
                    <br>
                    <div class="pt-4">
                        <button class="btn btn-primary" type="submit">
                            Spremi promjene
                        </button>
                        <a href="/profile{{ $user->id }}" class="btn btn-secondary"> Odustani </a>
                        <br><br>

                        <hr>
                        <button type="button" class="btn btn-outline-danger mb-2" data-toggle="modal"
                                data-target="#modalForDelete">
                            Obriši svoj profil
                        </button>
                    </div>


                </div>
            </div>
        </form>
    </div>

    <!-- MODAL ZA DELETE KORISNIKA -->
    <div class="modal fade" id="modalForDelete" tabindex="-1" aria-labelledby="modalForDelete" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="exampleModalLabel">
                        Jeste li sigurni da želite obrisati ovaj profil?
                    </h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body align-center">
                    <table>
                        <tr>
                            <td>
                                <p class="text-danger"> Pažljivo! Ako obrišete svoj profil zauvijek ste izgubili sve podatke!</p>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Zatvori</button>
                    <a href="{{ route("profile.delete", $user->id) }}" class = "btn btn-danger">Obriši</a>
                </div>
            </div>
        </div>
    </div>

@endsection

<style>
    #slika {
        background-image: linear-gradient(whitesmoke, antiquewhite);
        border-radius: 15px;
    }
</style>
