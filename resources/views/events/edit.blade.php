@extends('layouts.main')
@section('title', 'Editando: '. $event->title)
@section('content')

    <div id="event-create-container" class="col-md-6 offset-md-3">
        <h1> Editando: {{ $event->title }}</h1>
        <form action="{{ route('event.update', $event->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="image"> Alterar imagem do Evento: </label>
                <input type="file" class="form-control-file" id="image" name="image" >
                <img src="/img/events/{{ $event->image }}" alt="{{ $event->title }}" class="img-preview">
            </div>
            <div class="form-group">
                <label for="title"> Evento: </label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $event->title }}" placeholder="Nome do evento" required>
            </div>
            <div class="form-group">
                <label for="date"> Data do Evento: </label>
                <input type="date" class="form-control" id="date" name="date" value="{{ $event->date->format('Y-m-d') }}" required>
            </div>

            <div class="form-group">
                <label for="city"> Cidade: </label>
                <input type="text" class="form-control" id="city" name="city" value="{{ $event->city }}" placeholder="Nome do evento" required>
            </div>

            <div class="form-group">
                <label for="private"> O evento é privado? </label>
                <select name="private" id="private" class="form-control">
                    <option value="0">Não</option>
                    <option value="1" {{ $event->private ?'selected' :'' }}>Sim</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="description"> Descrição: </label>
                <textarea name="description" id="description" cols="3" class="form-control" placeholder="O que vai acontecer no evento?" required>{{ $event->description }}</textarea>
            </div>

            <div class="form-group">
                <label for="private"> Adicione itens de infraestrutura:</label>
                <div class="form-group mt-1">
                    
                    <input type="checkbox" name="items[]" value="cadeiras" {{ in_array("cadeiras", $event->items) ? 'checked' :'' }}> Cadeiras
                </div>
                <div class="form-group">
                    <input type="checkbox" name="items[]" value="Open Bar" {{ in_array("Open Bar", $event->items) ? 'checked' :'' }}> Open Bar
                </div>
                <div class="form-group">
                    <input type="checkbox" name="items[]" value="Palco" {{ in_array("Palco", $event->items) ? 'checked' :'' }}> Palco
                </div>
                <div class="form-group">
                    <input type="checkbox" name="items[]" value="Open Food" {{ in_array("Open Food", $event->items) ? 'checked' :'' }}> Open Food
                </div>
            </div>

            <input type="submit" class="btn btn-primary mt-1" value="Salvar">

        </form>
    </div>


@endsection