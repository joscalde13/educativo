@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar Nivel</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.levels.update', $level) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label for="subject_id">Materia</label>
                            <select name="subject_id" id="subject_id" class="form-control @error('subject_id') is-invalid @enderror" required>
                                <option value="">Selecciona una materia</option>
                                @foreach($subjects as $subject)
                                    <option value="{{ $subject->id }}" {{ old('subject_id', $level->subject_id) == $subject->id ? 'selected' : '' }}>
                                        {{ $subject->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('subject_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="level_number">Número de Nivel</label>
                            <input type="number" name="level_number" id="level_number" class="form-control @error('level_number') is-invalid @enderror" value="{{ old('level_number', $level->level_number) }}" required min="1">
                            @error('level_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="title">Título</label>
                            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $level->title) }}" required>
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="description">Descripción</label>
                            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" required>{{ old('description', $level->description) }}</textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="question">Pregunta</label>
                            <textarea name="question" id="question" class="form-control @error('question') is-invalid @enderror" required>{{ old('question', $level->question) }}</textarea>
                            @error('quSestion')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="correct_answer">Respuesta Correcta</label>
                            <input type="text" name="correct_answer" id="correct_answer" class="form-control @error('correct_answer') is-invalid @enderror" value="{{ old('correct_answer', $level->correct_answer) }}" required>
                            @error('correct_answer')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label>Respuestas Incorrectas</label>
                            <div id="wrong-answers-container">
                                @foreach($level->wrong_answers as $wrongAnswer)
                                    <div class="input-group mb-2">
                                        <input type="text" name="wrong_answers[]" class="form-control" value="{{ $wrongAnswer }}" required>
                                        <button type="button" class="btn btn-danger remove-wrong-answer">Eliminar</button>
                                    </div>
                                @endforeach
                            </div>
                            <button type="button" class="btn btn-secondary" id="add-wrong-answer">Agregar Respuesta Incorrecta</button>
                        </div>

                        <div class="form-group mb-3">
                            <label for="points">Puntos</label>
                            <input type="number" name="points" id="points" class="form-control @error('points') is-invalid @enderror" value="{{ old('points', $level->points) }}" required min="1">
                            @error('points')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary">
                                Actualizar Nivel
                            </button>
                            <a href="{{ route('admin.levels.index') }}" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('wrong-answers-container');
        const addButton = document.getElementById('add-wrong-answer');

        addButton.addEventListener('click', function() {
            const div = document.createElement('div');
            div.className = 'input-group mb-2';
            div.innerHTML = `
                <input type="text" name="wrong_answers[]" class="form-control" required>
                <button type="button" class="btn btn-danger remove-wrong-answer">Eliminar</button>
            `;
            container.appendChild(div);
        });

        container.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-wrong-answer')) {
                e.target.parentElement.remove();
            }
        });
    });
</script>
@endpush
@endsection 