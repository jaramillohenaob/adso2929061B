<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-sky-700 min-h-dvh p-14">
    <div class="card bg-base-100 w-96 shadow-sm">
  <figure>
    <img
      src="https://img.daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.webp"
      alt="Shoes" />
  </figure>
  <div class="card-body">
    <h2 class="card-title">
      {{ $pet->name }}
      <div class="badge badge-success">{{ $pet->kind }}</div>
      <div class="badge badge-warning">{{ $pet->breed }}</div>
    </h2>
    <p>{{ $pet->description }}</p>
    <div class="card-actions justify-end">
      <div class="badge badge-outline">Age: {{ $pet->age }}</div>
      <div class="badge badge-outline">Weight: {{ $pet->weight }}</div>
      <div class="badge badge-outline">Location: {{ $pet->location }}</div>
    </div>
  </div>
</div>
</body>
</html>