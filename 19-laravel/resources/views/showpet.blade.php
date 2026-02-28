<?php use Carbon\Carbon;?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-sky-700 min-h-dvh flex items-center justify-center">
  <div class="p-14">
    <div class="card bg-base-100 w-96 shadow-sm">
<figure>
    <img
        src="{{ asset('images/pets/' . $pet->kind . '.png') }}"
        alt="Photo" />
</figure>
  <div class="card-body">
    <h2 class="card-title">
      {{ $pet->name }}
      <div class="badge badge-accent">{{ $pet->kind}}</div>
      <div> 
      @if ($pet->adopted == 1)
          <span class="badge badge-info">Adopted</span>
      @else
          <span class="badge badge-success">Available</span>
      @endif

      </div>
    </h2>
    <p>
      <div>Breed: {{ $pet->breed}}</div>
      <div>Age: {{ $pet->age}}</div>
      <div>Weight: {{ $pet->weight }}</div>
      <div>Location: {{ $pet->location }}</div>
      <div>Description: {{ $pet->description}}</div>
    </p>
    <div class="card-actions justify-end">
        <div class="badge badge-outline {{ $pet->active ? 'badge-success' : 'badge-error' }}">
        {{ $pet->active ? 'Active' : 'Inactive' }}
    </div>
        <div class="badge badge-outline">
            Created: {{ $pet->created_at->diffForHumans() }}
        </div>

        <div class="badge badge-outline">
            Updated: {{ $pet->updated_at->diffForHumans() }}
        </div>
    </div>
  </div>
</div>
<div class="card-actions justify-start mt-5">
    <a href="{{ url()->previous() }}" class="btn bg-sky-200 text-sky-900 hover:bg-sky-300 border-none btn-sm">
        ← Regresar
    </a>
</div>
</body>
</html>