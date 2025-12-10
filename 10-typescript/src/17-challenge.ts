// 17 - Challenge: Character Battle

class Character {
    constructor(public name: string, public hp: number) { }

    takeDamage(amount: number): void {
        this.hp -= amount;
        if (this.hp < 0) this.hp = 0;
    }

    isAlive(): boolean {
        return this.hp > 0;
    }
}

// Variables
const char1 = new Character("Monster", 100);
const char2 = new Character("Hero", 100);

// Elements
const output17 = document.getElementById('output17');

// Functions
function render() {
    if (output17) {
        output17.innerHTML = `
            <div class="battle-container">
                <div class="battle-scene">
                    <div class="character-wrapper">
                        <div class="hp-text">Life: ${char1.hp} hp</div>
                        <div style="
                            width: 202px; 
                            height: 174px; 
                            background-image: url('images/character1.svg'); 
                            background-size: contain; 
                            background-repeat: no-repeat; 
                            background-position: bottom;">
                        </div>
                    </div>
                    <div class="character-wrapper">
                        <div class="hp-text">Life: ${char2.hp} hp</div>
                        <div style="
                            width: 150px; 
                            height: 174px; 
                            background-image: url('images/character2.svg'); 
                            background-size: contain; 
                            background-repeat: no-repeat; 
                            background-position: bottom;">
                        </div>
                    </div>
                </div>
                <div class="controls">
                    <button id="fightBtn" ${!char1.isAlive() || !char2.isAlive() ? 'disabled' : ''}>
                        ${!char1.isAlive() || !char2.isAlive() ? 'Game Over' : 'Fight!'}
                    </button>
                    <div id="log"></div>
                </div>
            </div>
        `;

        const btn = document.getElementById('fightBtn');
        if (btn) {
            btn.addEventListener('click', battle);
        }
    }
}

function battle() {
    if (!char1.isAlive() || !char2.isAlive()) return;

    // Random damage 
    const damageToChar1 = Math.floor(Math.random() * 11) + 5; // 5-15
    const damageToChar2 = Math.floor(Math.random() * 11) + 5;

    char1.takeDamage(damageToChar1);
    char2.takeDamage(damageToChar2);

    render();

    const log = document.getElementById('log');
    if (log) {
        let message = ``;
        if (!char1.isAlive() && !char2.isAlive()) {
            message = `<span style="color: #ff88ff;">It's a draw!</span>`;
        } else if (!char1.isAlive()) {
            message = `<span style="color: #ff8888;">${char1.name} is defeated!</span>`;
        } else if (!char2.isAlive()) {
            message = `<span style="color: #88ff88;">${char2.name} is defeated!</span>`;
        } else {
            message = `${char1.name}: -${damageToChar1} | ${char2.name}: -${damageToChar2}`;
        }

        log.innerHTML = message;
    }
}

// Initial render
render();
