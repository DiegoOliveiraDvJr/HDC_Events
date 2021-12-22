@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')
<div class="col-md-10 offset-md-1 dashboard-title-container">
    <h1>Meus Eventos</h1>
</div>
<div class="col-md-10 offset-md-1 dashboard-event-container">
    @if (count($events) > 0)
       <table class="table table-hover">
           <thead>
               <tr>
                   <th scope="col">#</th>
                   <th scope="col">Nome</th>
                   <th scope="col">Participantes</th>
                   <th scope="col">Ações</th>
               </tr>
           </thead>
           <tbody>
               @foreach ($events as $event)
                   <tr>
                       <td scope="row">{{ $loop->index + 1 }}</td>
                       <td scope="row"><a href="{{ route('eventShow', $event->id) }}">{{ $event->title }}</td>
                       <td scope="row">{{ count($event->users) }}</td>
                       <td scope="row" class="d-flex flex-wrap">
                           <a class="btn btn-info edit-btn mx-1" href="{{ route('event.edit', $event->id) }}"><ion-icon name="create-outline"></ion-icon> Editar</a> 
                           <form action="{{ route('event.delete', $event->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                                <button class="btn btn-danger mx-1" type="submit"><ion-icon name="trash-outline"></ion-icon> Deletar</button>
                           </form>
                           
                        </td>
                   </tr>
               @endforeach
           </tbody>
       </table>
    @else
    <p>Você ainda não tem eventos, <a href="{{ route('event.create') }}" class="text-info">Criar evento</a></p>
    @endif
</div>
<div class="col-md-10 offset-md-1 dashboard-title-container">
    <h1>Eventos que estou participando</h1>
</div>
<div class="col-md-10 offset-md-1 dashboard-event-container">
    @if (count($eventsAsParticipant) > 0)
       <table class="table table-hover">
           <thead>
               <tr>
                   <th scope="col">#</th>
                   <th scope="col">Nome</th>
                   <th scope="col">Participantes</th>
                   <th scope="col">Ações</th>
               </tr>
           </thead>
           <tbody>
               @foreach ($eventsAsParticipant as $event)
                   <tr>
                       <td scope="row">{{ $loop->index + 1 }}</td>
                       <td scope="row"><a href="{{ route('eventShow', $event->id) }}">{{ $event->title }}</td>
                       <td scope="row">{{ count($event->users) }}</td>
                       <td scope="row" class="d-flex flex-wrap">
                           <form action="{{ route('event.leave', $event->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                                <button class="btn btn-warning mx-1" type="submit">Sair do evento</button>
                           </form>
                        </td>
                   </tr>
               @endforeach
           </tbody>
       </table>
    @else
    <p>Você ainda não está participando de nenhum evento, <a href="/" class="text-info">Veja todos os eventos</a></p>
    @endif
</div>
@endsection
