
        class StrooperGame {
            constructor() {
                this.colors = [
                    { name: 'AMARILLO', color: '#FFC107' },
                    { name: 'AZUL', color: '#2196F3' },
                    { name: 'NARANJA', color: '#FF5722' },
                    { name: 'NEGRO', color: '#000000' },
                    { name: 'ROJO', color: '#F44336' },
                    { name: 'VERDE', color: '#4CAF50' },
                    { name: 'PURPURA', color: '#9C27B0' }
                ];

                this.gameActive = false;
                this.currentWord = null;
                this.currentColor = null;
                this.wordsShown = 0;
                this.correctAnswers = 0;
                this.timeLeft = 30;
                this.gameInterval = null;
                this.wordInterval = null;

                this.initializeElements();
                this.setupEventListeners();
            }

            initializeElements() {
                this.elements = {
                    wordDisplay: document.getElementById('wordDisplay'),
                    gameButtons: document.getElementById('gameButtons'),
                    startButton: document.getElementById('startButton'),
                    correctBtn: document.getElementById('correctBtn'),
                    incorrectBtn: document.getElementById('incorrectBtn'),
                    wordsShown: document.getElementById('wordsShown'),
                    correctWords: document.getElementById('correctWords'),
                    accuracy: document.getElementById('accuracy'),
                    timeLeft: document.getElementById('timeLeft'),
                    progressBar: document.getElementById('progressBar'),
                    gameStatus: document.getElementById('gameStatus'),
                    settingsPanel: document.getElementById('settingsPanel'),
                    durationSlider: document.getElementById('durationSlider'),
                    durationValue: document.getElementById('durationValue'),
                    modal: document.getElementById('modal')
                };
            }

            setupEventListeners() {
                document.getElementById('startGame').addEventListener('click', () => this.startGame());
                this.elements.correctBtn.addEventListener('click', () => this.handleAnswer(true));
                this.elements.incorrectBtn.addEventListener('click', () => this.handleAnswer(false));
                document.getElementById('closeGame').addEventListener('click', () => this.endGame());

                document.getElementById('playBtn').addEventListener('click', () => this.resetGame());
                document.getElementById('settingsBtn').addEventListener('click', () => this.toggleSettings());

                document.querySelectorAll('[data-locked="true"]').forEach(btn => {
                    btn.addEventListener('click', () => this.showLockedModal());
                });

                ['scoresBtn', 'helpBtn'].forEach(id => {
                    document.getElementById(id).addEventListener('click', () => this.showLockedModal());
                });

                this.elements.durationSlider.addEventListener('input', (e) => {
                    this.elements.durationValue.textContent = e.target.value + 's';
                    this.timeLeft = parseInt(e.target.value);
                    this.elements.timeLeft.textContent = this.timeLeft;
                });

                document.getElementById('closeModal').addEventListener('click', () => this.hideModal());
                document.getElementById('registerNow').addEventListener('click', () => this.hideModal());
            }

            startGame() {
                this.gameActive = true;
                this.wordsShown = 0;
                this.correctAnswers = 0;
                this.timeLeft = parseInt(this.elements.durationSlider.value);

                this.elements.startButton.classList.add('hidden');
                this.elements.gameButtons.classList.remove('hidden');
                this.elements.gameStatus.innerHTML = `
                    <h2 class="text-2xl font-bold mb-2">¡Juego en progreso!</h2>
                    <p class="text-gray-200">¿La palabra coincide con su color?</p>
                `;
                this.updateStats();
                this.generateNewWord();

                this.gameInterval = setInterval(() => {
                    this.timeLeft--;
                    this.updateStats();

                    if (this.timeLeft <= 0) {
                        this.endGame();
                    }
                }, 1000);

                this.wordInterval = setInterval(() => {
                    this.generateNewWord();
                }, 3000);
            }

            generateNewWord() {
                const wordColor = this.colors[Math.floor(Math.random() * this.colors.length)];
                const displayColor = this.colors[Math.floor(Math.random() * this.colors.length)];

                this.currentWord = wordColor.name;
                this.currentColor = displayColor.color;
                this.isCorrect = wordColor.name === displayColor.name;

                this.elements.wordDisplay.textContent = this.currentWord;
                this.elements.wordDisplay.style.color = this.currentColor;

                this.wordsShown++;
                this.updateStats();
            }

            handleAnswer(userAnswer) {
                if (!this.gameActive) return;

                if (userAnswer === this.isCorrect) {
                    this.correctAnswers++;
                    this.showFeedback(true);
                } else {
                    this.showFeedback(false);
                }

                this.updateStats();
                this.generateNewWord();
            }

            showFeedback(correct) {
                const feedback = document.createElement('div');
                feedback.className = `fixed top-4 right-4 px-6 py-3 rounded-full text-white font-bold z-50 ${
                    correct ? 'bg-green-500' : 'bg-red-500'
                }`;
                feedback.textContent = correct ? '¡Correcto! +1' : '¡Incorrecto! +0';
                feedback.style.animation = 'fadeIn 0.3s ease-out';

                document.body.appendChild(feedback);

                setTimeout(() => {
                    feedback.remove();
                }, 1500);
            }

            updateStats() {
                this.elements.wordsShown.textContent = this.wordsShown;
                this.elements.correctWords.textContent = this.correctAnswers;
                this.elements.accuracy.textContent = this.wordsShown > 0 ?
                    Math.round((this.correctAnswers / this.wordsShown) * 100) + '%' : '0%';
                this.elements.timeLeft.textContent = this.timeLeft;

                const progress = (this.timeLeft / parseInt(this.elements.durationSlider.value)) * 100;
                this.elements.progressBar.style.width = progress + '%';
            }

            endGame() {
                this.gameActive = false;
                clearInterval(this.gameInterval);
                clearInterval(this.wordInterval);

                const accuracy = this.wordsShown > 0 ? Math.round((this.correctAnswers / this.wordsShown) * 100) : 0;

                this.elements.gameStatus.innerHTML = `
                    <h2 class="text-2xl font-bold mb-2 text-yellow-400">¡Juego Terminado!</h2>
                    <p class="text-gray-200">Precisión: ${accuracy}% (${this.correctAnswers}/${this.wordsShown})</p>
                `;

                this.elements.wordDisplay.textContent = '🎯';
                this.elements.wordDisplay.style.color = '#FFC107';
                this.elements.gameButtons.classList.add('hidden');
                this.elements.startButton.classList.remove('hidden');
            }

            resetGame() {
                this.gameActive = false;
                clearInterval(this.gameInterval);
                clearInterval(this.wordInterval);

                this.wordsShown = 0;
                this.correctAnswers = 0;
                this.timeLeft = parseInt(this.elements.durationSlider.value);

                this.elements.gameStatus.innerHTML = `
                    <h2 class="text-2xl font-bold mb-2">¡Presiona JUGAR para comenzar!</h2>
                    <p class="text-gray-200">Selecciona si la palabra coincide con su color</p>
                `;
                this.elements.wordDisplay.textContent = 'STROOPER';
                this.elements.wordDisplay.style.color = '#FFFFFF';
                this.elements.gameButtons.classList.add('hidden');
                this.elements.startButton.classList.remove('hidden');

                this.updateStats();
            }

            toggleSettings() {
                this.elements.settingsPanel.classList.toggle('hidden');
            }

            showLockedModal() {
                this.elements.modal.style.display = 'flex';
            }

            hideModal() {
                this.elements.modal.style.display = 'none';
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            new StrooperGame();
        });
