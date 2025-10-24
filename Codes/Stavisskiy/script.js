 function calculateFunction() {
            const xInput = document.getElementById('xValue').value.trim();
            const resultDiv = document.getElementById('result');
            const loader = document.getElementById('loader');

            resultDiv.className = 'result';
            resultDiv.textContent = 'Результат появится здесь...';

            if (xInput === '') {
                resultDiv.className = 'result error';
                resultDiv.textContent = 'Ошибка: Введите значение x!';
                return;
            }

            const x = parseFloat(xInput);
            if (isNaN(x)) {
                resultDiv.className = 'result error';
                resultDiv.textContent = 'Ошибка: Введено не число!';
                return;
            }

            if (Math.abs(x) < 4) {
                resultDiv.className = 'result error';
                resultDiv.textContent = 'Ошибка: x должен быть ≤ -4 или ≥ 4 (т.к. x² - 16 ≥ 0).';
                return;
            }

            if (x === 9) {
                resultDiv.className = 'result error';
                resultDiv.textContent = 'Ошибка: x не может быть равен 9 (деление на ноль).';
                return;
            }

            loader.classList.add('active');

            setTimeout(() => {
                try {
                    const sqrtPart = Math.sqrt(x * x - 16);
                    const fractionPart = (x + 24) / (x - 9);
                    const y = sqrtPart + fractionPart;
                    const formattedY = y.toFixed(6);

                    resultDiv.className = 'result success';
                    resultDiv.textContent = `Результат: y = ${formattedY}`;
                } catch (e) {
                    resultDiv.className = 'result error';
                    resultDiv.textContent = `Ошибка при вычислении: ${e.message}`;
                } finally {

                    loader.classList.remove('active');
                }
            }, 300); 
        }

        document.getElementById('xValue').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                calculateFunction();
            }
        });