// 13 - Async/Await: manejo de tareas asíncronas

async function fetchMessage(): Promise<string> {
    return new Promise(resolve => {
        setTimeout(() => resolve("Data loaded successfully after 2s"), 2000);
    });
}

async function displayMessage() {
    const msg = await fetchMessage();
    const output13 = document.getElementById('output13');
    if (output13) {
        output13.innerHTML = `<li>${msg}</li>`;
    }
}

displayMessage();
