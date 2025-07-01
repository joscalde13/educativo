<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Elige tu Materia - Juego Educativo</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])  
 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">


  <style>
    body {
      background: linear-gradient(145deg, #ffecd2 0%, #fcb69f 100%);
      font-family: 'Comic Sans MS', cursive, sans-serif;
      min-height: 100vh;
    }

    .subject-card {
      background-color: #fff9f3;
      border-radius: 1.5rem;
      padding: 2rem;
      border: 4px solid #ffb347;
      box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
      transition: transform 0.3s ;
      color: inherit;
      text-decoration: none;
      display: block;
    }

    .subject-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 25px 45px rgba(0, 0, 0, 0.3);
    }

    .subject-card i {
      font-size: 3rem;
      margin-bottom: 1rem;
    }

    .welcome-box {
      background-color: #fff;
      border-radius: 1.5rem;
      border: 4px solid #ffe066;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
      padding: 2rem;
      margin-bottom: 2rem;
      text-align: center;
    }

    .subject-title {
      color: #ff6347;
      font-weight: bold;
    }

    .subject-description {
      color: #4b4b4b;
    }
  </style>


</head>






<body class="d-flex justify-content-center align-items-center p-4">


  <div class="container" style="max-width: 960px;">

        
        <div class="welcome-box">
          <h1 class="mb-3 text-primary">🎉 ¡Hola, {{ $student->name }}!</h1>
          <p class="fs-5 text-secondary">🌟 Puntaje Total: {{ $student->total_score }}</p>
        </div>


  
    <div class="row g-4">

        @foreach($subjects as $subject)
        <div class="col-md-4">
            <a href="{{ route('show-subject', ['student' => $student->id, 'subject' => $subject->id]) }}" class="subject-card text-center">
                <i class="fas fa-{{ $subject->icon  }} text-{{ $subject->color }}"></i>
                <h5 class="subject-title mt-2">{{ $subject->name }}</h5>
                <p class="subject-description">{{ $subject->description }}</p>
            </a>
        </div>
        @endforeach

    </div> 


  </div>

  
</body>




</html>
