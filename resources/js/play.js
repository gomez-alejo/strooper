// Game state
let gameState = {
    mode: null,
    difficulty: null,
    currentWord: null,
    currentColor: null,
    isCorrect: false,
    wordsShown: 0,
    correctAnswers: 0,
    gameTime: 30,
    wordTime: 3,
    timeRemaining: 30,
    gameTimer: null,
    wordTimer: null,
    reactionTimes: [],
    gameStartTime: null,
    gameEndTime: null
};

// Available colors
const colors = {
    'AMARILLO': '#FFC107',
    'AZUL': '#2196F3',
    'NARANJA': '#FF5722',
    'NEGRO': '#000000',
    'ROJO': '#E91E63',
    'VERDE': '#4CAF50',
    'PÚRPURA': '#9C27B0'
};

const colorNames = Object.keys(colors);

// DOM elements
const modeSelection = document.getElementById('modeSelection');
const countdownScreen = document.getElementById('countdownScreen');
const gameScreen = document.getElementById('gameScreen');
const difficultyModal = document.getElementById('difficultyModal');
const configModal = document.getElementById('configModal');
const scoresModal = document.getElementById('scoresModal');
const resultsModal = document.getElementById('resultsModal');

// Initialize event listeners
document.addEventListener('DOMContentLoaded', function() {
    // Mode selection
    document.getElementById('classicoBtn').addEventListener('click', () => startClassicMode());
    document.getElementById('competitivoBtn').addEventListener('click', () => showDifficultyModal());

    // Difficulty selection
    document.querySelectorAll('.difficulty-btn').forEach(btn => {
        btn.addEventListener('click', (e) => {
            const level = e.target.dataset.level;
            startCompetitiveMode(level);
        });
    });

    // Game buttons
    document.getElementById('correctBtn').addEventListener('click', () => answerQuestion(true));
    document.getElementById('incorrectBtn').addEventListener('click', () => answerQuestion(false));
    document.getElementById('exitGameBtn').addEventListener('click', () => confirmExitGame());

    // Navigation
    document.getElementById('homeBtn').addEventListener('click', () => goHome());
    document.getElementById('configBtn').addEventListener('click', () => showConfigModal());
    document.getElementById('scoresBtn').addEventListener('click', () => showScoresModal());

    // Modal controls
    document.getElementById('closeDifficultyModal').addEventListener('click', () => hideDifficultyModal());
    document.getElementById('closeConfigModal').addEventListener('click', () => hideConfigModal());
    document.getElementById('closeScoresModal').addEventListener('click', () => hideScoresModal());
    document.getElementById('saveConfig').addEventListener('click', () => saveConfiguration());

    // Results modal controls
    document.getElementById('playAgainBtn').addEventListener('click', () => playAgain());
    document.getElementById('backToMenuBtn').addEventListener('click', () => backToMenu());
    document.getElementById('shareFacebook').addEventListener('click', () => shareOnFacebook());
    document.getElementById('shareTwitter').addEventListener('click', () => shareOnTwitter());

    // Configuration sliders
    document.getElementById('gameDuration').addEventListener('input', updateDurationDisplay);
    document.getElementById('wordTime').addEventListener('input', updateWordTimeDisplay);
});

function startClassicMode() {
    gameState.mode = 'classic';
    gameState.difficulty = 'normal';
    gameState.wordTime = 3;
    gameState.gameTime = 30;
    startCountdown();
}

function startCompetitiveMode(level) {
    gameState.mode = 'competitive';
    gameState.difficulty = level;

    // Set times based on difficulty
    switch(level) {
        case 'dios':
            gameState.wordTime = 1;
            break;
        case 'veterano':
            gameState.wordTime = 2;
            break;
        case 'normal':
            gameState.wordTime = 3;
            break;
    }

    hideDifficultyModal();
    startCountdown();
}

function startCountdown() {
    hideAllScreens();
    countdownScreen.classList.remove('hidden');

    let count = 3;
    const countdownElement = document.getElementById('countdownNumber');

    const countdownInterval = setInterval(() => {
        countdownElement.textContent = count;
        countdownElement.classList.add('countdown');

        setTimeout(() => {
            countdownElement.classList.remove('countdown');
        }, 800);

        count--;

        if (count < 0) {
            clearInterval(countdownInterval);
            startGame();
        }
    }, 1000);
}

function startGame() {
    hideAllScreens();
    gameScreen.classList.remove('hidden');

    // Reset game state
    gameState.wordsShown = 0;
    gameState.correctAnswers = 0;
    gameState.timeRemaining = gameState.gameTime;
    gameState.reactionTimes = [];
    gameState.wordStartTime = Date.now();
    gameState.gameStartTime = Date.now();

    updateDisplay();
    generateNewWord();

    // Start game timer
    gameState.gameTimer = setInterval(() => {
        gameState.timeRemaining--;
        updateDisplay();

        if (gameState.timeRemaining <= 0) {
            endGame();
        }
    }, 1000);

    startWordTimer();
}

function generateNewWord() {
    const wordName = colorNames[Math.floor(Math.random() * colorNames.length)];
    const colorValue = colors[colorNames[Math.floor(Math.random() * colorNames.length)]];

    gameState.currentWord = wordName;
    gameState.currentColor = colorValue;
    gameState.isCorrect = colors[wordName] === colorValue;
    gameState.wordStartTime = Date.now();

    const wordElement = document.getElementById('currentWord');
    wordElement.textContent = wordName;
    wordElement.style.color = colorValue;
    wordElement.classList.add('word-display');
}

function startWordTimer() {
    // Clear any existing timer
    if (gameState.wordTimer) {
        clearTimeout(gameState.wordTimer);
    }

    // Remove any existing timer line
    const existingTimerLine = document.querySelector('.word-timer-line-inner');
    if (existingTimerLine) {
        existingTimerLine.remove();
    }

    const wordTimerLine = document.querySelector('.word-timer-line');
    const wordTimerLineInner = document.createElement('div');
    wordTimerLineInner.className = 'word-timer-line-inner';
    wordTimerLineInner.style.width = '100%';
    wordTimerLine.appendChild(wordTimerLineInner);

    const startTime = Date.now();

    const timer = setInterval(() => {
        const elapsed = (Date.now() - startTime) / 1000;
        const remaining = gameState.wordTime - elapsed;
        const percentage = (remaining / gameState.wordTime) * 100;

        wordTimerLineInner.style.width = percentage + '%';

        if (remaining <= 0) {
            clearInterval(timer);
        }
    }, 10);

    gameState.wordTimer = setTimeout(() => {
        clearInterval(timer);
        answerQuestion(false); // Auto incorrect if no answer
    }, gameState.wordTime * 1000);
}

function answerQuestion(userAnswer) {
    if (gameState.wordTimer) {
        clearTimeout(gameState.wordTimer);
    }

    const reactionTime = Date.now() - gameState.wordStartTime;
    const isCorrect = userAnswer === gameState.isCorrect;

    if (isCorrect) {
        gameState.correctAnswers++;
        gameState.reactionTimes.push(reactionTime);
    }

    gameState.wordsShown++;
    updateDisplay();

    // Generate next word if game is still running
    if (gameState.timeRemaining > 0) {
        generateNewWord();
        startWordTimer(); // Ensure the timer is restarted for the next word
    }
}

function updateDisplay() {
    document.getElementById('wordsShown').textContent = gameState.wordsShown;
    document.getElementById('correctWords').textContent = gameState.correctAnswers;
    document.getElementById('accuracy').textContent =
        gameState.wordsShown > 0 ? Math.round((gameState.correctAnswers / gameState.wordsShown) * 100) + '%' : '0%';
    document.getElementById('timeRemaining').textContent = gameState.timeRemaining + 's';

    // Update progress bar
    const progress = ((gameState.gameTime - gameState.timeRemaining) / gameState.gameTime) * 100;
    document.getElementById('progressBar').style.width = progress + '%';
}

function endGame() {
    clearInterval(gameState.gameTimer);
    clearTimeout(gameState.wordTimer);

    gameState.gameEndTime = Date.now();
    showResultsModal();
}

function confirmExitGame() {
    if (confirm('¿Estás seguro de que quieres finalizar el juego?')) {
        endGame();
    }
}

function showResultsModal() {
    const accuracy = gameState.wordsShown > 0 ? Math.round((gameState.correctAnswers / gameState.wordsShown) * 100) : 0;
    const avgReactionTime = gameState.reactionTimes.length > 0 ?
        Math.round(gameState.reactionTimes.reduce((a, b) => a + b, 0) / gameState.reactionTimes.length) : 0;
    const incorrectAnswers = gameState.wordsShown - gameState.correctAnswers;
    const gameDuration = Math.round((gameState.gameEndTime - gameState.gameStartTime) / 1000);

    // Update results display
    document.getElementById('finalWordsShown').textContent = gameState.wordsShown;
    document.getElementById('finalCorrectWords').textContent = gameState.correctAnswers;
    document.getElementById('finalIncorrectWords').textContent = incorrectAnswers;
    document.getElementById('finalAccuracy').textContent = accuracy + '%';
    document.getElementById('finalReactionTime').textContent = avgReactionTime + 'ms';
    document.getElementById('finalGameDuration').textContent = gameDuration + 's';

    // Update game mode display
    let modeText = gameState.mode === 'classic' ? 'Modo Clásico' : `Modo Competitivo - ${gameState.difficulty.toUpperCase()}`;
    document.getElementById('gameModeDisplay').textContent = modeText;

    // Update performance badge
    const performanceBadge = document.getElementById('performanceBadge');
    if (accuracy >= 90) {
        performanceBadge.textContent = '🏆 ¡Excelente!';
        performanceBadge.style.background = 'linear-gradient(135deg, #FFD700, #FFA500)';
    } else if (accuracy >= 75) {
        performanceBadge.textContent = '🥈 ¡Muy Bien!';
        performanceBadge.style.background = 'linear-gradient(135deg, #C0C0C0, #808080)';
    } else if (accuracy >= 60) {
        performanceBadge.textContent = '🥉 ¡Bien!';
        performanceBadge.style.background = 'linear-gradient(135deg, #CD7F32, #A0522D)';
    } else {
        performanceBadge.textContent = '💪 ¡Sigue Practicando!';
        performanceBadge.style.background = 'linear-gradient(135deg, #4CAF50, #2E7D32)';
    }

    resultsModal.classList.remove('hidden');
}

function shareOnFacebook() {
    const accuracy = gameState.wordsShown > 0 ? Math.round((gameState.correctAnswers / gameState.wordsShown) * 100) : 0;
    const avgReactionTime = gameState.reactionTimes.length > 0 ?
        Math.round(gameState.reactionTimes.reduce((a, b) => a + b, 0) / gameState.reactionTimes.length) : 0;
    const modeText = gameState.mode === 'classic' ? 'Clásico' : `Competitivo (${gameState.difficulty})`;

    const shareText = `¡Acabo de jugar Strooper! 🎯\n\n` +
        `📊 Modo: ${modeText}\n` +
        `✅ Precisión: ${accuracy}%\n` +
        `⚡ Tiempo promedio: ${avgReactionTime}ms\n` +
        `🎮 Palabras correctas: ${gameState.correctAnswers}/${gameState.wordsShown}\n\n` +
        `¡Desafíame en Strooper!`;

    const facebookUrl = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(window.location.href)}&quote=${encodeURIComponent(shareText)}`;
    window.open(facebookUrl, '_blank', 'width=600,height=400');
}

function shareOnTwitter() {
    const accuracy = gameState.wordsShown > 0 ? Math.round((gameState.correctAnswers / gameState.wordsShown) * 100) : 0;
    const avgReactionTime = gameState.reactionTimes.length > 0 ?
        Math.round(gameState.reactionTimes.reduce((a, b) => a + b, 0) / gameState.reactionTimes.length) : 0;
    const modeText = gameState.mode === 'classic' ? 'Clásico' : `Competitivo (${gameState.difficulty})`;

    const shareText = `¡Acabo de jugar #Strooper! 🎯 ` +
        `Modo ${modeText}: ${accuracy}% precisión, ` +
        `${avgReactionTime}ms tiempo promedio. ` +
        `${gameState.correctAnswers}/${gameState.wordsShown} correctas! ` +
        `¿Puedes superarme? 🔥`;

    const twitterUrl = `https://twitter.com/intent/tweet?text=${encodeURIComponent(shareText)}`;
    window.open(twitterUrl, '_blank', 'width=600,height=400');
}

function playAgain() {
    resultsModal.classList.add('hidden');
    if (gameState.mode === 'classic') {
        startClassicMode();
    } else {
        startCompetitiveMode(gameState.difficulty);
    }
}

function backToMenu() {
    resultsModal.classList.add('hidden');
    goHome();
}

function showDifficultyModal() {
    difficultyModal.classList.remove('hidden');
}

function hideDifficultyModal() {
    difficultyModal.classList.add('hidden');
}

function showConfigModal() {
    configModal.classList.remove('hidden');
    updateDurationDisplay();
    updateWordTimeDisplay();
}

function hideConfigModal() {
    configModal.classList.add('hidden');
}

function showScoresModal() {
    scoresModal.classList.remove('hidden');
    // Here you would load and display actual scores
    document.getElementById('individualScores').innerHTML = `
        <div class="bg-gray-700 p-3 rounded">1. 95% - Clásico</div>
        <div class="bg-gray-700 p-3 rounded">2. 87% - Clásico</div>
        <div class="bg-gray-700 p-3 rounded">3. 82% - Clásico</div>
    `;
    document.getElementById('globalScores').innerHTML = `
        <div class="bg-gray-700 p-3 rounded">1. PlayerOne - 98%</div>
        <div class="bg-gray-700 p-3 rounded">2. ColorMaster - 95%</div>
        <div class="bg-gray-700 p-3 rounded">3. SpeedRunner - 92%</div>
    `;
}

function hideScoresModal() {
    scoresModal.classList.add('hidden');
}

function saveConfiguration() {
    gameState.gameTime = parseInt(document.getElementById('gameDuration').value);
    gameState.wordTime = parseInt(document.getElementById('wordTime').value);
    hideConfigModal();
    alert('Configuración guardada correctamente');
}

function updateDurationDisplay() {
    const value = document.getElementById('gameDuration').value;
    document.getElementById('durationValue').textContent = value + ' segundos';
}

function updateWordTimeDisplay() {
    const value = document.getElementById('wordTime').value;
    document.getElementById('wordTimeValue').textContent = value + ' segundos';
}

function goHome() {
    hideAllScreens();
    modeSelection.classList.remove('hidden');

    // Clear timers
    if (gameState.gameTimer) clearInterval(gameState.gameTimer);
    if (gameState.wordTimer) clearTimeout(gameState.wordTimer);
}

function hideAllScreens() {
    modeSelection.classList.add('hidden');
    countdownScreen.classList.add('hidden');
    gameScreen.classList.add('hidden');
    resultsModal.classList.add('hidden');
}