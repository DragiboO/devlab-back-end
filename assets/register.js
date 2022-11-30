let timer = document.querySelector('.timer')

function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

async function time(time) {
    for (let i = time; i > 0; i--) {
        timer.innerHTML = 'Redirect to logIn page in ' + i + ' ...'
        await sleep(1000)
    }
}

time(5)