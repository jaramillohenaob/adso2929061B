<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Pokemon</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-base-200 min-h-screen">
    <div class="container mx-auto py-10 px-4">
        <div class="max-w-2xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold text-primary mb-2">Create New Pokemon</h1>
                <p class="text-base-content/70">Fill in the details to create a new Pokemon</p>
            </div>

            <!-- Form Card -->
            <div class="card bg-base-100 shadow-xl">
                <div class="card-body">
                    <form action="index.php?method=store" method="POST" id="createForm">
                        <!-- Basic Info -->
                        <div class="form-control mb-4">
                            <label class="label">
                                <span class="label-text font-semibold">Pokemon Name</span>
                            </label>
                            <input type="text" name="name" placeholder="Enter Pokemon name" class="input input-bordered w-full" required />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text font-semibold">Type</span>
                                </label>
                                <select name="type" class="select select-bordered w-full" required>
                                    <option disabled selected>Select type</option>
                                    <option value="Water">Water</option>
                                    <option value="Fire">Fire</option>
                                    <option value="Grass">Grass</option>
                                    <option value="Electric">Electric</option>
                                    <option value="Normal">Normal</option>
                                    <option value="Poison">Poison</option>
                                    <option value="Ghost">Ghost</option>
                                    <option value="Dragon">Dragon</option>
                                    <option value="Rock">Rock</option>
                                </select>
                            </div>

                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text font-semibold">Trainer</span>
                                </label>
                                <select name="trainer_id" class="select select-bordered w-full" required>
                                    <option disabled selected>Select trainer</option>
                                    <?php foreach ($data as $trainer): ?>
                                        <option value="<?= $trainer['id'] ?>"><?= htmlspecialchars($trainer['name']) ?></option>
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
                                <span class="label-text-alt text-lg font-bold" id="strenghtValue">50</span>
                            </label>
                            <input type="range" name="strenght" min="0" max="100" value="50" class="range range-primary" id="strenghtRange" />
                            <progress class="progress progress-primary w-full mt-2" value="50" max="100" id="strenghtProgress"></progress>
                        </div>

                        <!-- Stamina -->
                        <div class="form-control mb-4">
                            <label class="label">
                                <span class="label-text font-semibold">Stamina</span>
                                <span class="label-text-alt text-lg font-bold" id="staminaValue">50</span>
                            </label>
                            <input type="range" name="stamina" min="0" max="100" value="50" class="range range-secondary" id="staminaRange" />
                            <progress class="progress progress-secondary w-full mt-2" value="50" max="100" id="staminaProgress"></progress>
                        </div>

                        <!-- Speed -->
                        <div class="form-control mb-4">
                            <label class="label">
                                <span class="label-text font-semibold">Speed</span>
                                <span class="label-text-alt text-lg font-bold" id="speedValue">50</span>
                            </label>
                            <input type="range" name="speed" min="0" max="100" value="50" class="range range-accent" id="speedRange" />
                            <progress class="progress progress-accent w-full mt-2" value="50" max="100" id="speedProgress"></progress>
                        </div>

                        <!-- Accuracy -->
                        <div class="form-control mb-6">
                            <label class="label">
                                <span class="label-text font-semibold">Accuracy</span>
                                <span class="label-text-alt text-lg font-bold" id="accuracyValue">50</span>
                            </label>
                            <input type="range" name="accuracy" min="0" max="100" value="50" class="range range-warning" id="accuracyRange" />
                            <progress class="progress progress-warning w-full mt-2" value="50" max="100" id="accuracyProgress"></progress>
                        </div>

                        <!-- Actions -->
                        <div class="card-actions justify-end gap-2">
                            <a href="index.php" class="btn btn-ghost">Cancel</a>
                            <button type="submit" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="currentColor" viewBox="0 0 256 256">
                                    <path d="M229.66,77.66l-128,128a8,8,0,0,1-11.32,0l-56-56a8,8,0,0,1,11.32-11.32L96,188.69,218.34,66.34a8,8,0,0,1,11.32,11.32Z"></path>
                                </svg>
                                Create Pokemon
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