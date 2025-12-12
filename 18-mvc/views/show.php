<input type="checkbox" id="pokemon_modal" class="modal-toggle" />
<div class="modal" role="dialog">
  <div class="modal-box">
    <div class="flex justify-between items-center mb-4">
        <h3 class="text-2xl font-bold" id="modal-name">Pokemon Name</h3>
        <span id="modal-type" class="badge badge-lg">Type</span>
    </div>
    
    <div class="space-y-4">
        <div class="grid grid-cols-2 gap-4">
            <div class="stat place-items-center bg-base-200 rounded-box p-2">
                <div class="stat-title">Strength</div>
                <div class="stat-value text-xl" id="modal-strength">0</div>
            </div>
            <div class="stat place-items-center bg-base-200 rounded-box p-2">
                <div class="stat-title">Stamina</div>
                <div class="stat-value text-xl" id="modal-stamina">0</div>
            </div>
            <div class="stat place-items-center bg-base-200 rounded-box p-2">
                <div class="stat-title">Speed</div>
                <div class="stat-value text-xl" id="modal-speed">0</div>
            </div>
            <div class="stat place-items-center bg-base-200 rounded-box p-2">
                <div class="stat-title">Accuracy</div>
                <div class="stat-value text-xl" id="modal-accuracy">0</div>
            </div>
        </div>

        <div class="text-sm opacity-70 text-right">
            Trainer ID: <span id="modal-trainer">#</span>
        </div>
    </div>

    <div class="modal-action">
      <label for="pokemon_modal" class="btn">Close</label>
    </div>
  </div>
  <label class="modal-backdrop" for="pokemon_modal">Close</label>
</div>