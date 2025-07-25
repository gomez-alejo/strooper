// Game State Variables
let gameState = {
    isPlaying: false,
    currentWord: '',
    currentColor: '',
    isCorrectMatch: false,
    wordsShown: 0,
    correctAnswers: 0,
    timeRemaining: 30,
    gameTimer: null,
    wordTimer: null,
    startTime: null,
    reactionTimes: []
};

// Available colors
const colors = [
    { name: 'AMARILLO', color: '#FFC107' },
    { name: 'AZUL', color: '#2196F3' },
    { name: 'NARANJA', color: '#FF5722' },
    { name: 'NEGRO', color: '#000000' },
    { name: 'ROJO', color: '#F44336' },
    { name: 'VERDE', color: '#4CAF50' },
    { name: 'PÚRPURA', color: '#9C27B0' }
];

// DOM Elements
const gameModal = document.getElementById('gameModal');
const startTrialBtn = document.getElementById('startTrialBtn');
const closeModal = document.querySelector('#gameModal .close');
const startGameBtn = document.getElementById('startGameBtn');
const gameInterface = document.getElementById('gameInterface');
const gameResults = document.getElementById('gameResults');
const wordDisplay = document.getElementById('wordDisplay');
const gameButtons = document.getElementById('gameButtons');
const correctBtn = document.getElementById('correctBtn');
const incorrectBtn = document.getElementById('incorrectBtn');
const timeRemaining = document.getElementById('timeRemaining');

// Stats elements
const wordsShownEl = document.getElementById('wordsShown');
const correctAnswersEl = document.getElementById('correctAnswers');
const accuracyEl = document.getElementById('accuracy');
const modalWordsShown = document.getElementById('modalWordsShown');
const modalCorrectAnswers = document.getElementById('modalCorrectAnswers');
const modalAccuracy = document.getElementById('modalAccuracy');

// Results elements
const finalWordsShown = document.getElementById('finalWordsShown');
const finalCorrectAnswers = document.getElementById('finalCorrectAnswers');
const finalAccuracy = document.getElementById('finalAccuracy');
const averageTime = document.getElementById('averageTime');
const playAgainBtn = document.getElementById('playAgainBtn');
const closeResultsBtn = document.getElementById('closeResultsBtn');

// Open modal
startTrialBtn.addEventListener('click', () => {
    gameModal.style.display = 'block';
    resetGame();
});

// Close modal
closeModal.addEventListener('click', closeGameModal);
closeResultsBtn.addEventListener('click', closeGameModal);

// Close modal when clicking outside
gameModal.addEventListener('click', (e) => {
    if (e.target === gameModal) {
        closeGameModal();
    }
});

function closeGameModal() {
    gameModal.style.display = 'none';
    if (gameState.gameTimer) clearInterval(gameState.gameTimer);
    if (gameState.wordTimer) clearTimeout(gameState.wordTimer);
    resetGame();
}

function resetGame() {
    gameState = {
        isPlaying: false,
        currentWord: '',
        currentColor: '',
        isCorrectMatch: false,
        wordsShown: 0,
        correctAnswers: 0,
        timeRemaining: 30,
        gameTimer: null,
        wordTimer: null,
        startTime: null,
        reactionTimes: []
    };
    wordDisplay.textContent = 'PREPARADO?';
    wordDisplay.style.color = '#000';
    gameButtons.classList.add('hidden');
    startGameBtn.style.display = 'block';
    document.getElementById('gameArea').querySelector('.text-gray-600').style.display = 'block';
    updateStats();
    timeRemaining.textContent = '30s';
}

// Start game
startGameBtn.addEventListener('click', startGame);
playAgainBtn.addEventListener('click', () => {
    gameResults.classList.add('hidden');
    gameInterface.classList.remove('hidden');
    resetGame();
});

// Game buttons
correctBtn.addEventListener('click', () => handleAnswer(true));
incorrectBtn.addEventListener('click', () => handleAnswer(false));

function startGame() {
    gameState.isPlaying = true;
    startGameBtn.style.display = 'none';
    document.getElementById('gameArea').querySelector('.text-gray-600').style.display = 'none';
    gameButtons.classList.remove('hidden');
    // Start game timer
    gameState.gameTimer = setInterval(() => {
        gameState.timeRemaining--;
        timeRemaining.textContent = `${gameState.timeRemaining}s`;
        if (gameState.timeRemaining <= 0) {
            endGame();
        }
    }, 1000);
    // Show first word
    showNextWord();
}

function showNextWord() {
    if (!gameState.isPlaying) return;
    // Clear previous word timer
    if (gameState.wordTimer) clearTimeout(gameState.wordTimer);
    // Get random word and color
    const randomWord = colors[Math.floor(Math.random() * colors.length)];
    const randomColor = colors[Math.floor(Math.random() * colors.length)];
    gameState.currentWord = randomWord.name;
    gameState.currentColor = randomColor.color;
    gameState.isCorrectMatch = randomWord.name === randomColor.name;
    gameState.wordsShown++;
    gameState.startTime = Date.now();
    // Display word
    wordDisplay.textContent = gameState.currentWord;
    wordDisplay.style.color = gameState.currentColor;
    updateStats();
    // Auto-advance after 3 seconds (normal level timing)
    gameState.wordTimer = setTimeout(() => {
        if (gameState.isPlaying) {
            // Count as incorrect if no answer
            showNextWord();
        }
    }, 3000);
}

function handleAnswer(userAnswer) {
    if (!gameState.isPlaying) return;
    // Calculate reaction time
    const reactionTime = (Date.now() - gameState.startTime) / 1000;
    gameState.reactionTimes.push(reactionTime);
    // Check if answer is correct
    if (userAnswer === gameState.isCorrectMatch) {
        gameState.correctAnswers++;
    }
    updateStats();
    // Show next word
    setTimeout(() => {
        showNextWord();
    }, 200);
}

function updateStats() {
    const accuracy = gameState.wordsShown > 0 ? Math.round((gameState.correctAnswers / gameState.wordsShown) * 100) : 0;
    // Update modal stats
    modalWordsShown.textContent = gameState.wordsShown;
    modalCorrectAnswers.textContent = gameState.correctAnswers;
    modalAccuracy.textContent = `${accuracy}%`;
    // Update main page stats
    wordsShownEl.textContent = gameState.wordsShown;
    correctAnswersEl.textContent = gameState.correctAnswers;
    accuracyEl.textContent = `${accuracy}%`;
}

function endGame() {
    gameState.isPlaying = false;
    if (gameState.gameTimer) clearInterval(gameState.gameTimer);
    if (gameState.wordTimer) clearTimeout(gameState.wordTimer);
    // Calculate final stats
    const finalAccuracyValue = gameState.wordsShown > 0 ? Math.round((gameState.correctAnswers / gameState.wordsShown) * 100) : 0;
    const avgReactionTime = gameState.reactionTimes.length > 0 ?
        (gameState.reactionTimes.reduce((a, b) => a + b, 0) / gameState.reactionTimes.length).toFixed(2) : 0;
    // Update results display
    finalWordsShown.textContent = gameState.wordsShown;
    finalCorrectAnswers.textContent = gameState.correctAnswers;
    finalAccuracy.textContent = `${finalAccuracyValue}%`;
    averageTime.textContent = `${avgReactionTime}s`;
    // Show results
    gameInterface.classList.add('hidden');
    gameResults.classList.remove('hidden');
    // Update main page stats with final values
    updateStats();
}

// Smooth scrolling for navigation links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// Intersection Observer for animations
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.animationPlayState = 'running';
        }
    });
}, observerOptions);

// Observe all animated elements
document.querySelectorAll('.slide-in-up, .slide-in-left, .slide-in-right').forEach(el => {
    el.style.animationPlayState = 'paused';
    observer.observe(el);
});

// Add click animations to buttons
document.querySelectorAll('button').forEach(button => {
    button.addEventListener('click', function(e) {
        // Create ripple effect
        const ripple = document.createElement('span');
        const rect = this.getBoundingClientRect();
        const size = Math.max(rect.width, rect.height);
        const x = e.clientX - rect.left - size / 2;
        const y = e.clientY - rect.top - size / 2;
        ripple.style.cssText = `
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: scale(0);
            animation: ripple 0.6s linear;
            left: ${x}px;
            top: ${y}px;
            width: ${size}px;
            height: ${size}px;
            pointer-events: none;
        `;
        this.style.position = 'relative';
        this.style.overflow = 'hidden';
        this.appendChild(ripple);
        setTimeout(() => {
            ripple.remove();
        }, 600);
    });
});

// Add CSS for ripple animation
const style = document.createElement('style');
style.textContent = `
    @keyframes ripple {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }
`;
document.head.appendChild(style);

// Color demo animation
const colorDemos = document.querySelectorAll('.color-demo');
setInterval(() => {
    colorDemos.forEach((demo, index) => {
        setTimeout(() => {
            demo.style.transform = 'scale(1.2)';
            setTimeout(() => {
                demo.style.transform = 'scale(1)';
            }, 200);
        }, index * 100);
    });
}, 3000);

// Navbar transparency on scroll
window.addEventListener('scroll', () => {
    const nav = document.querySelector('nav');
    if (window.scrollY > 100) {
        nav.style.background = 'rgba(233, 30, 99, 0.95)';
    } else {
        nav.style.background = 'rgba(255, 255, 255, 0.1)';
    }
});

// Initialize animations on page load
window.addEventListener('load', () => {
    document.querySelectorAll('.slide-in-up, .slide-in-left, .slide-in-right').forEach(el => {
        if (el.getBoundingClientRect().top < window.innerHeight) {
            el.style.animationPlayState = 'running';
        }
    });
});
