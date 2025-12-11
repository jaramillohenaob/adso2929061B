<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pokemon</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-base-200 min-h-screen">
    <div class="container mx-auto py-10 px-4">
        <div class="max-w-2xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold text-secondary mb-2">Edit Pokemon</h1>
                <p class="text-base-content/70">Update Pokemon details</p>
            </div>

            <!-- Form Card -->
            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <form action="index.php?method=update&id=<?= $data['id'] ?>" method="POST">
                        <!-- Basic Info -->
                        <div class="form-control mb-4">
                            <label class="label">
                                <span class="label-text font-semibold">Pokemon Name</span>
                            </label>
                            <input type="text" name="name" value="<?= htmlspecialchars($data['name']) ?>" placeholder="Enter Pokemon name" class="input input-bordered w-full" required />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text font-semibold">Type</span>
                                </label>
                                <select name="type" class="select select-bordered w-full" required>
                                    <option disabled>Select type</option>
                                    <option value="Water" <?= $data['type'] === 'Water' ? 'selected' : '' ?>>Water</option>
                                    <option value="Fire" <?= $data['type'] === 'Fire' ? 'selected' : '' ?>>Fire</option>
                                    <option value="Grass" <?= $data['type'] === 'Grass' ? 'selected' : '' ?>>Grass</option>
                                    <option value="Electric" <?= $data['type'] === 'Electric' ? 'selected' : '' ?>>Electric</option>
                                    <option value="Normal" <?= $data['type'] === 'Normal' ? 'selected' : '' ?>>Normal</option>
                                    <option value="Poison" <?= $data['type'] === 'Poison' ? 'selected' : '' ?>>Poison</option>
                                    <option value="Ghost" <?= $data['type'] === 'Ghost' ? 'selected' : '' ?>>Ghost</option>
                                    <option value="Dragon" <?= $data['type'] === 'Dragon' ? 'selected' : '' ?>>Dragon</option>
                                    <option value="Rock" <?= $data['type'] === 'Rock' ? 'selected' : '' ?>>Rock</option>
                                </select>
                            </div>

                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text font-semibold">Trainer</span>
                                </label>
                                <select name="trainer_id" class="select select-bordered w-full" required>
                                    <option disabled>Select trainer</option>
                                    <?php foreach ($data['trainers'] as $trainer): ?>
                                        <option value="<?= $trainer['id'] ?>" <?= $data['trainer_id'] == $trainer['id'] ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($trainer['name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <!-- Stats Section -->
                        <div class="divider text-lg font-bold">Pokemon Stats</div>

                        <!-- Strenght -->
                        <div class="form-control mb-4">
                            <label class="label">
                                <span class="label-text font-semibold">Strenght</span>
                                <span class="label-text-alt text-lg font-bold" id="strenghtValue"><?= $data['strenght'] ?? 50 ?></span>
                            </label>
                            <input type="range" name="strenght" min="0" max="100" value="<?= $data['strenght'] ?? 50 ?>" class="range range-primary" id="strenghtRange" />
                            <progress class="progress progress-primary w-full mt-2" value="<?= $data['strenght'] ?? 50 ?>" max="100" id="strenghtProgress"></progress>
                        </div>

                        <!-- Stamina -->
                        <div class="form-control mb-4">
                            <label class="label">
                                <span class="label-text font-semibold">Stamina</span>
                                <span class="label-text-alt text-lg font-bold" id="staminaValue"><?= $data['stamina'] ?? 50 ?></span>
                            </label>
                            <input type="range" name="stamina" min="0" max="100" value="<?= $data['stamina'] ?? 50 ?>" class="range range-secondary" id="staminaRange" />
                            <progress class="progress progress-secondary w-full mt-2" value="<?= $data['stamina'] ?? 50 ?>" max="100" id="staminaProgress"></progress>
                        </div>

                        <!-- Speed -->
                        <div class="form-control mb-4">
                            <label class="label">
                                <span class="label-text font-semibold">Speed</span>
                                <span class="label-text-alt text-lg font-bold" id="speedValue"><?= $data['speed'] ?? 50 ?></span>
                            </label>
                            <input type="range" name="speed" min="0" max="100" value="<?= $data['speed'] ?? 50 ?>" class="range range-accent" id="speedRange" />
                            <progress class="progress progress-accent w-full mt-2" value="<?= $data['speed'] ?? 50 ?>" max="100" id="speedProgress"></progress>
                        </div>

                        <!-- Accuracy -->
                        <div class="form-control mb-6">
                            <label class="label">
                                <span class="label-text font-semibold">Accuracy</span>
                                <span class="label-text-alt text-lg font-bold" id="accuracyValue"><?= $data['accuracy'] ?? 50 ?></span>
                            </label>
                            <input type="range" name="accuracy" min="0" max="100" value="<?= $data['accuracy'] ?? 50 ?>" class="range range-warning" id="accuracyRange" />
                            <progress class="progress progress-warning w-full mt-2" value="<?= $data['accuracy'] ?? 50 ?>" max="100" id="accuracyProgress"></progress>
                        </div>

                        <!-- Actions -->
                        <div class="card-actions justify-end gap-2">
                            <a href="index.php" class="btn btn-ghost">Cancel</a>
                            <button type="submit" class="btn btn-secondary">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="currentColor" viewBox="0 0 256 256">
                                    <path d="M227.31,73.37,182.63,28.68a16,16,0,0,0-22.63,0L36.69,152A15.86,15.86,0,0,0,32,163.31V208a16,16,0,0,0,16,16H92.69A15.86,15.86,0,0,0,104,219.31L227.31,96a16,16,0,0,0,0-22.63ZM92.69,208H48V163.31l88-88L180.69,120ZM192,108.68,147.31,64l24-24L216,84.68Z"></path>
                                </svg>
                                Update Pokemon
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Update progress bars and values when range inputs change
        function updateStat(statName) {
            const range = document.getElementById(statName + 'Range');
            const progress = document.getElementById(statName + 'Progress');
            const value = document.getElementById(statName + 'Value');
            
            range.addEventListener('input', function() {
                progress.value = this.value;
                value.textContent = this.value;
            });
        }

        updateStat('strenght');
        updateStat('stamina');
        updateStat('speed');
        updateStat('accuracy');
    </script>
</body>
</html>