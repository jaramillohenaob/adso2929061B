<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Pokemon</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body>
    <div class="hero bg-base-200 min-h-screen">
        <div class="hero-content text-center">
            <div class="max-w-md">
                <h1 class="text-5xl font-bold mb-6">Pokemon Details</h1>
                
                <div class="card w-96 bg-base-100 shadow-xl">
                    <div class="card-body text-left">
                        <h2 class="card-title text-2xl mb-4"><?= htmlspecialchars($data['name']) ?></h2>
                        
                        <div class="space-y-2">
                            <p><strong>Type:</strong> 
                                <span class="badge badge-outline"><?= htmlspecialchars($data['type']) ?></span>
                            </p>
                            <p><strong>Strenght:</strong> <?= htmlspecialchars($data['strenght']) ?></p>
                            <p><strong>Stamina:</strong> <?= htmlspecialchars($data['stamina']) ?></p>
                            <p><strong>Speed:</strong> <?= htmlspecialchars($data['speed']) ?></p>
                            <p><strong>Accuracy:</strong> <?= htmlspecialchars($data['accuracy']) ?></p>
                        </div>
                        
                        <div class="card-actions justify-end mt-6">
                            <a href="/pokemon/index" class="btn btn-primary">Back to List</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
