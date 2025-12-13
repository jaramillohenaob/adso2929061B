<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($data['name']) ?> - Details</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-base-200 min-h-screen">
<div class="container mx-auto py-10 px-4">
    <div class="max-w-2xl mx-auto">
        
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-secondary mb-2">
                <?= htmlspecialchars($data['name']) ?>
            </h1>
            <div class="mt-4">
            <?php if($data['type'] === 'Water'):?>
                <span class="badge badge-lg badge-outline badge-info">Water</span>
            <?php elseif($data['type'] === 'Grass'):?>
                <span class="badge badge-lg badge-outline badge-success">Grass</span>
            <?php elseif($data['type'] === 'Fire'):?>
                <span class="badge badge-lg badge-outline badge-error">Fire</span>
            <?php elseif($data['type'] === 'Electric'):?>
                <span class="badge badge-lg badge-outline badge-warning">Electric</span>
            <?php elseif($data['type'] === 'Normal'):?>
                <span class="badge badge-lg badge-outline badge-neutral">Normal</span>
            <?php elseif($data['type'] === 'Poison'):?>
                <span class="badge badge-lg badge-outline badge-primary">Poison</span>
            <?php elseif($data['type'] === 'Ghost'):?>
                <span class="badge badge-lg badge-outline badge-primary">Ghost</span>
            <?php elseif($data['type'] === 'Dragon'):?>
                <span class="badge badge-lg badge-outline badge-secondary">Dragon</span>
            <?php elseif($data['type'] === 'Rock'):?>
                <span class="badge badge-lg badge-outline badge-neutral">Rock</span>
            <?php endif?>
            </div>
        </div>

        <!-- Card -->
        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">

                <!-- Trainer Name -->
                <div class="text-right text-sm text-base-content/70 mb-4">
                    Entrenador: 
                    <span class="font-semibold">
                        <?= htmlspecialchars($data['trainer_name']) ?>
                    </span>
                </div>

                <!-- Stats -->
                <div class="divider text-lg font-bold mb-6">Stats</div>

                <div class="grid grid-cols-2 gap-6">

                    <div class="stat bg-base-200 p-4 rounded-lg">
                        <div class="stat-title">Strength</div>
                        <div class="stat-value text-2xl"><?= $data['strenght'] ?></div>
                        <progress class="progress progress-error w-56" value="<?= $data['strenght'] ?>" max="255"></progress>
                    </div>

                    <div class="stat bg-base-200 p-4 rounded-lg">
                        <div class="stat-title">Stamina</div>
                        <div class="stat-value text-2xl"><?= $data['stamina'] ?></div>
                        <progress class="progress progress-accent w-56" value="<?= $data['stamina'] ?>" max="255"></progress>
                    </div>

                    <div class="stat bg-base-200 p-4 rounded-lg">
                        <div class="stat-title">Speed</div>
                        <div class="stat-value text-2xl"><?= $data['speed'] ?></div>
                        <progress class="progress progress-info w-56" value="<?= $data['speed'] ?>" max="255"></progress>
                    </div>

                    <div class="stat bg-base-200 p-4 rounded-lg">
                        <div class="stat-title">Accuracy</div>
                        <div class="stat-value text-2xl"><?= $data['accuracy'] ?></div>
                        <progress class="progress progress-warning w-56" value="<?= $data['accuracy'] ?>" max="255"></progress>
                    </div>
                </div>

                <!-- Total -->
                <?php 
                $total_stats = $data['strenght'] + $data['stamina'] + $data['speed'] + $data['accuracy'];
                ?>
                <div class="stat bg-base-300 p-5 rounded-lg text-center col-span-2">
                    <div class="stat-title text-lg font-semibold">Total</div>
                    <div class="stat-value text-3xl"><?= $total_stats ?></div>
                    <progress class="progress progress-secondary w-full" value="<?= $total_stats ?>" max="600"></progress>
                </div>


                <!-- Actions -->
                <div class="card-actions justify-end mt-6">
                    <a href="./" class="btn btn-primary">Volver</a>
                </div>

            </div>
        </div>

    </div>
</div>
</body>
</html>
