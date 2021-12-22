@extends('layouts.main')
@section('title', 'Criar Evento')
@section('content')
    

    <div id="event-create-container" class="col-md-6 offset-md-3">
        <h1> Crie um evento </h1>
        <form action="{{ route('events') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="image"> Imagem do Evento: </label>
                <input type="file" class="form-control-file" id="image" name="image" required>
            </div>
            <div class="form-group">
                <label for="title"> Evento: </label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Nome do evento" required>
            </div>
            <div class="form-group">
                <label for="date"> Data do Evento: </label>
                <input type="date" class="form-control" id="date" name="date" required>
            </div>

            <div class="form-group">
                <label for="city"> Cidade: </label>
                <input type="text" class="form-control" id="city" name="city" placeholder="Nome do evento" required>
            </div>

            <div class="form-group">
                <label for="private"> O evento é privado? </label>
                <select name="private" id="private" class="form-control">
                    <option value="0">Não</option>
                    <option value="1">Sim</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="description"> Descrição: </label>
                <textarea name="description" id="description" cols="3" class="form-control" placeholder="O que vai acontecer no evento?" required></textarea>
            </div>

            <div class="form-group">
                <label for="private"> Adicione itens de infraestrutura:</label>
                <div class="form-group mt-1">
                    <input type="checkbox" name="items[]" value="cadeiras"> Cadeiras
                </div>
                <div class="form-group">
                    <input type="checkbox" name="items[]" value="Open Bar"> Open Bar
                </div>
                <div class="form-group">
                    <input type="checkbox" name="items[]" value="Palco"> Palco
                </div>
                <div class="form-group">
                    <input type="checkbox" name="items[]" value="Open Food"> Open Food
                </div>
            </div>

            <input type="submit" class="btn btn-primary mt-1" value="Criar Evento">

        </form>
    </div>
@endsection