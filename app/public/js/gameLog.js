const log = document.getElementById('game-log');
const actions = document.getElementById('game-btn');
 

function appendToLog(messages) {
    meggages.foreach(msg => {
        const text = document.createElement('p');
        text.textContent = msg;
        log.appendChild(text); 
    });
    log.scrollTop = log.scrollHeight;
}

function clearActions(){
    actions.innerHTML = '';
}

function renderActions(actions){
    clearActions();

    actions.forEach(action => {
        switch(action.type){
            case 'MOVE':
                action.directions?.forEach(direction => {
                    const btn = document.createElement('btn');
                    btn.textContent = direction.toUpperCase();
                    btn.onclick = () => move(direction); 
                    actions.appendChild(btn);
                })
                break;
            case 'COMBAT':
                const attackBtn = document.createElement('btn');
                attackBtn.textContent = 'Attack';
                attackBtn.onclick = () => fight();
                actions.appendChild(attackBtn);
                break;
            case 'Game_OVER':
                actions.innerHTML = '<strong>GAME OVER!</strong>';
                disbleAllButtons();
                break;

            case 'Game_COMPLETE':
                actions.innerHTML = '<strong>You Escaped!</strong>';
                break;
        }
    });
    
}

function move(direction){
    fetch('/api/game/move', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: new URLSearchParams({'direction' : direction})
    }).then(response => response.json())
    .then(data => {
        if(data.success){
            appendToLog(data.log);
            clearActions();
            renderActions({type: 'MOVE', directions: data.actions.movement});
        } 
    }).then(updateGameState);
}

function updateGameState(data){
    if(data.log) appendToLog(data.log);
    if(data.actions) renderActions(data.actions);
}