<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokemon Details</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-base-200 min-h-screen">
    <div class="container mx-auto py-10 px-4">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-8">
                <h1 class="text-5xl font-bold text-accent mb-2"><?= htmlspecialchars($data['name']) ?></h1>
                <div class="badge badge-lg badge-outline badge-<?= 
                    $data['type'] === 'Water' ? 'info' : 
                    ($data['type'] === 'Fire' ? 'error' : 
                    ($data['type'] === 'Grass' ? 'success' : 
                    ($data['type'] === 'Electric' ? 'warning' : 
                    ($data['type'] === 'Dragon' ? 'secondary' : 'neutral')))) 
                ?>"><?= htmlspecialchars($data['type']) ?> Type</div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Pokemon Card -->
                <div class="flex justify-center items-center">
                    <div class="card bg-gradient-to-br from-primary/20 to-secondary/20 shadow-2xl border border-primary/30 w-full hover:scale-105 transition-transform duration-300">
                        <figure class="px-10 pt-10">
                            <div class="w-48 h-48 bg-base-100 rounded-full flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-32 h-32 text-primary" fill="currentColor" viewBox="0 0 256 256">
                                    <path d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24ZM74.08,197.5a64,64,0,0,1,107.84,0,87.83,87.83,0,0,1-107.84,0ZM96,120a32,32,0,1,1,32,32A32,32,0,0,1,96,120Zm97.76,66.41a79.66,79.66,0,0,0-36.06-28.75,48,48,0,1,0-59.4,0,79.66,79.66,0,0,0-36.06,28.75,88,88,0,1,1,131.52,0Z"></path>
                                </svg>
                            </div>
                        </figure>
                        <div class="card-body items-center text-center">
                            <h2 class="card-title text-3xl"><?= htmlspecialchars($data['name']) ?></h2>
                            <p class="text-base-content/70">ID: #<?= str_pad($data['id'], 3, '0', STR_PAD_LEFT) ?></p>
                        </div>
                    </div>
                </div>

                <!-- Stats Panel -->
                <div class="space-y-4">
                    <!-- Info Card -->
                    <div class="card bg-base-100 shadow-xl">
                        <div class="card-body">
                            <h3 class="card-title text-2xl mb-4">Information</h3>
                            <div class="space-y-3">
                                <div class="flex justify-between items-center">
                                    <span class="font-semibold text-base-content/70">Type:</span>
                                    <span class="badge badge-lg badge-<?= 
                                        $data['type'] === 'Water' ? 'info' : 
                                        ($data['type'] === 'Fire' ? 'error' : 
                                        ($data['type'] === 'Grass' ? 'success' : 
                                        ($data['type'] === 'Electric' ? 'warning' : 
                                        ($data['type'] === 'Dragon' ? 'secondary' : 'neutral')))) 
                                    ?>"><?= htmlspecialchars($data['type']) ?></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Stats Card -->
                    <div class="card bg-base-100 shadow-xl">
                        <div class="card-body">
                            <h3 class="card-title text-2xl mb-4">Battle Stats</h3>
                            <div class="space-y-4">
                                <!-- Strenght -->
                                <div>
                                    <div class="flex justify-between mb-1">
                                        <span class="font-semibold">Strenght</span>
                                        <span class="text-primary font-bold"><?= $data['strenght'] ?></span>
                                    </div>
                                    <progress class="progress progress-primary w-full h-3" value="<?= $data['strenght'] ?>" max="100"></progress>
                                </div>

                                <!-- Stamina -->
                                <div>
                                    <div class="flex justify-between mb-1">
                                        <span class="font-semibold">Stamina</span>
                                        <span class="text-secondary font-bold"><?= $data['stamina'] ?></span>
                                    </div>
                                    <progress class="progress progress-secondary w-full h-3" value="<?= $data['stamina'] ?>" max="100"></progress>
                                </div>

                                <!-- Speed -->
                                <div>
                                    <div class="flex justify-between mb-1">
                                        <span class="font-semibold">Speed</span>
                                        <span class="text-accent font-bold"><?= $data['speed'] ?></span>
                                    </div>
                                    <progress class="progress progress-accent w-full h-3" value="<?= $data['speed'] ?>" max="100"></progress>
                                </div>

                                <!-- Accuracy -->
                                <div>
                                    <div class="flex justify-between mb-1">
                                        <span class="font-semibold">Accuracy</span>
                                        <span class="text-warning font-bold"><?= $data['accuracy'] ?></span>
                                    </div>
                                    <progress class="progress progress-warning w-full h-3" value="<?= $data['accuracy'] ?>" max="100"></progress>
                                </div>

                                <!-- Overall Power -->
                                <div class="divider"></div>
                                <div>
                                    <div class="flex justify-between mb-1">
                                        <span class="font-bold text-lg">Overall Power</span>
                                        <span class="text-error font-bold text-lg"><?= $data['strenght'] + $data['stamina'] + $data['speed'] + $data['accuracy'] ?>/400</span>
                                    </div>
                                    <progress class="progress progress-error w-full h-4" value="<?= $data['strenght'] + $data['stamina'] + $data['speed'] + $data['accuracy'] ?>" max="400"></progress>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex gap-2 justify-end">
                        <a href="index.php" class="btn btn-ghost">
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="currentColor" viewBox="0 0 256 256">
                                <path d="M224,128a8,8,0,0,1-8,8H59.31l58.35,58.34a8,8,0,0,1-11.32,11.32l-72-72a8,8,0,0,1,0-11.32l72-72a8,8,0,0,1,11.32,11.32L59.31,120H216A8,8,0,0,1,224,128Z"></path>
                            </svg>
                            Back to List
                        </a>
                        <a href="index.php?method=edit&id=<?= $data['id'] ?>" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="currentColor" viewBox="0 0 256 256">
                                <path d="M227.31,73.37,182.63,28.68a16,16,0,0,0-22.63,0L36.69,152A15.86,15.86,0,0,0,32,163.31V208a16,16,0,0,0,16,16H92.69A15.86,15.86,0,0,0,104,219.31L227.31,96a16,16,0,0,0,0-22.63ZM92.69,208H48V163.31l88-88L180.69,120ZM192,108.68,147.31,64l24-24L216,84.68Z"></path>
                            </svg>
                            Edit Pokemon
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>