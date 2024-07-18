function updateServerTime() {
    const serverTimeElement = document.getElementById('server-time');
    let currentTime = new Date(serverTimeElement.getAttribute('data-start-time') * 1000);

    setInterval(() => {
        currentTime.setSeconds(currentTime.getSeconds() + 1);
        const hours = currentTime.getHours().toString().padStart(2, '0');
        const minutes = currentTime.getMinutes().toString().padStart(2, '0');
        const seconds = currentTime.getSeconds().toString().padStart(2, '0');
        serverTimeElement.textContent = `${hours}:${minutes}:${seconds}`;
    }, 1000);
}

document.addEventListener('DOMContentLoaded', updateServerTime);