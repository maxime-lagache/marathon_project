@extends("base")

@section('title', 'Votre profil')

@section('content')

    <div class="row justify-content-center">
        <div class="col-6 ">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{$user->name}}</h4>
                    <h5 class="card-title">{{ $user->email }}</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header text-center font-weight-bold">
            Ajouter un nouvelle achat
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card-body">
            <form name="form-create-achat" method="post" action="">
                @csrf
                <div class="form-group">
                    <label for="description">Jeu</label>
                    <select name="jeu_id">
                        <option value="{{null}}">Choisir un jeu</option>
                        @foreach( \App\Models\Jeu::all() as $jeu)
                            <option value="{{ $jeu->id }}" @if (old('jeu_id') == $jeu->id) selected @endif> {{ $jeu->nom }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="nom">Date de l'achat</label>
                    <input type="date" id="date_achat" name="date_achat" value="{{ old('date_achat') }}" class="form-control" required="">
                </div>
                <div class="form-group">
                    <label for="nom">Lieu</label>
                    <input type="text" id="lieu" name="lieu" value="{{ old('lieu') }}" class="form-control" required="">
                </div>
                <div class="form-group">
                    <label for="nom">Prix</label>
                    <input type="text" id="prix" name="prix" value="{{ old('prix') }}" class="form-control" required="">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

    <a href="{{ URL::route('home') }}" class="btn btn-secondary">Retour</a>
@endsection

