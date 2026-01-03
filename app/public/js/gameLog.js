document.addEventListener('DOMContentLoaded', () => {
    const log = document.getElementById('game-log');
    if (log) {
        log.scrollTop = log.scrollHeight;
    }
});