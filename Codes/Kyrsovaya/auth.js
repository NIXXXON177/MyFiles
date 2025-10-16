/**
 * Модуль авторизации пользователя
 * Обработка входа, регистрации, управления сессией
 */

// Константы
const API_BASE_URL = 'https://api.eduplatform.com'; // Замените на реальный URL
const STORAGE_KEYS = {
    USER: 'currentUser',
    TOKEN: 'authToken',
    REMEMBER_ME: 'rememberMe'
};

// Глобальные переменные
let authState = {
    isAuthenticated: false,
    user: null,
    token: null
};

/**
 * Инициализация модуля авторизации
 */
document.addEventListener('DOMContentLoaded', function() {
    initializeAuth();
});

/**
 * Инициализация авторизации
 */
function initializeAuth() {
    // Проверяем сохраненную сессию
    checkStoredSession();
    
    // Настраиваем обработчики событий
    setupAuthEventListeners();
    
    // Если мы на странице входа, инициализируем форму
    if (getCurrentPage() === 'login') {
        initializeLoginForm();
    }
}

/**
 * Получение текущей страницы
 */
function getCurrentPage() {
    const path = window.location.pathname;
    if (path.includes('login.html')) return 'login';
    if (path.includes('index.html') || path === '/') return 'index';
    if (path.includes('courses.html')) return 'courses';
    if (path.includes('course-details.html')) return 'course-details';
    return 'index';
}

/**
 * Проверка сохраненной сессии
 */
function checkStoredSession() {
    const token = localStorage.getItem(STORAGE_KEYS.TOKEN);
    const user = localStorage.getItem(STORAGE_KEYS.USER);
    const rememberMe = localStorage.getItem(STORAGE_KEYS.REMEMBER_ME);
    
    if (token && user) {
        try {
            authState.token = token;
            authState.user = JSON.parse(user);
            authState.isAuthenticated = true;
            
            // Если пользователь не выбрал "Запомнить меня", очищаем сессию при закрытии браузера
            if (rememberMe !== 'true') {
                sessionStorage.setItem(STORAGE_KEYS.TOKEN, token);
                sessionStorage.setItem(STORAGE_KEYS.USER, user);
                localStorage.removeItem(STORAGE_KEYS.TOKEN);
                localStorage.removeItem(STORAGE_KEYS.USER);
            }
            
            // Если мы на странице входа, перенаправляем на главную
            if (getCurrentPage() === 'login') {
                redirectToMain();
            }
        } catch (error) {
            console.error('Ошибка при загрузке сессии:', error);
            clearAuthData();
        }
    } else {
        // Проверяем sessionStorage как fallback
        const sessionToken = sessionStorage.getItem(STORAGE_KEYS.TOKEN);
        const sessionUser = sessionStorage.getItem(STORAGE_KEYS.USER);
        
        if (sessionToken && sessionUser) {
            authState.token = sessionToken;
            authState.user = JSON.parse(sessionUser);
            authState.isAuthenticated = true;
        }
    }
}

/**
 * Настройка обработчиков событий авторизации
 */
function setupAuthEventListeners() {
    // Обработчик формы входа
    const loginForm = document.getElementById('login-form');
    if (loginForm) {
        loginForm.addEventListener('submit', handleLogin);
    }
    
    // Обработчик выхода
    const logoutBtn = document.getElementById('logout-btn');
    if (logoutBtn) {
        logoutBtn.addEventListener('click', handleLogout);
    }
    
    // Обработчик ссылки регистрации
    const registerLink = document.getElementById('register-link');
    if (registerLink) {
        registerLink.addEventListener('click', handleRegisterClick);
    }
    
    // Обработчик восстановления пароля
    const forgotPasswordLink = document.querySelector('.forgot-password');
    if (forgotPasswordLink) {
        forgotPasswordLink.addEventListener('click', handleForgotPassword);
    }
}

/**
 * Инициализация формы входа
 */
function initializeLoginForm() {
    // Восстанавливаем сохраненные данные, если пользователь выбрал "Запомнить меня"
    const rememberMe = localStorage.getItem(STORAGE_KEYS.REMEMBER_ME);
    if (rememberMe === 'true') {
        const savedEmail = localStorage.getItem('savedEmail');
        const rememberMeCheckbox = document.getElementById('remember-me');
        
        if (savedEmail) {
            document.getElementById('email').value = savedEmail;
        }
        if (rememberMeCheckbox) {
            rememberMeCheckbox.checked = true;
        }
    }
    
    // Настраиваем валидацию в реальном времени
    setupFormValidation();
}

/**
 * Настройка валидации формы
 */
function setupFormValidation() {
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    
    if (emailInput) {
        emailInput.addEventListener('blur', validateEmail);
        emailInput.addEventListener('input', clearEmailError);
    }
    
    if (passwordInput) {
        passwordInput.addEventListener('blur', validatePassword);
        passwordInput.addEventListener('input', clearPasswordError);
    }
}

/**
 * Обработка входа
 */
async function handleLogin(event) {
    event.preventDefault();
    
    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value;
    const rememberMe = document.getElementById('remember-me').checked;
    
    // Валидация формы
    if (!validateLoginForm(email, password)) {
        return;
    }
    
    // Показываем индикатор загрузки
    setLoginButtonLoading(true);
    
    try {
        // Выполняем запрос на сервер
        const response = await authenticateUser(email, password);
        
        if (response.success) {
            // Сохраняем данные пользователя
            saveAuthData(response.user, response.token, rememberMe);
            
            // Сохраняем email для автозаполнения
            if (rememberMe) {
                localStorage.setItem('savedEmail', email);
            } else {
                localStorage.removeItem('savedEmail');
            }
            
            // Показываем успешное сообщение
            showSuccessMessage('Вход выполнен успешно!');
            
            // Перенаправляем на главную страницу
            setTimeout(() => {
                redirectToMain();
            }, 1000);
            
        } else {
            showErrorMessage(response.message || 'Неверный email или пароль');
        }
        
    } catch (error) {
        console.error('Ошибка при входе:', error);
        showErrorMessage('Произошла ошибка при входе. Попробуйте еще раз.');
    } finally {
        setLoginButtonLoading(false);
    }
}

/**
 * Аутентификация пользователя (имитация API запроса)
 */
async function authenticateUser(email, password) {
    // Имитация задержки сети
    await new Promise(resolve => setTimeout(resolve, 1500));
    
    // Имитация проверки учетных данных
    const validUsers = [
        { email: 'admin@eduplatform.com', password: 'admin123', role: 'admin' },
        { email: 'student@eduplatform.com', password: 'student123', role: 'student' },
        { email: 'teacher@eduplatform.com', password: 'teacher123', role: 'teacher' }
    ];
    
    const user = validUsers.find(u => u.email === email && u.password === password);
    
    if (user) {
        // Генерируем фиктивный токен
        const token = generateMockToken();
        
        // Создаем объект пользователя
        const userData = {
            id: Math.floor(Math.random() * 1000),
            email: user.email,
            name: getUserDisplayName(email),
            role: user.role,
            avatar: generateAvatarUrl(email),
            lastLogin: new Date().toISOString()
        };
        
        return {
            success: true,
            user: userData,
            token: token
        };
    } else {
        return {
            success: false,
            message: 'Неверный email или пароль'
        };
    }
}

/**
 * Валидация формы входа
 */
function validateLoginForm(email, password) {
    let isValid = true;
    
    // Валидация email
    if (!validateEmail(email)) {
        isValid = false;
    }
    
    // Валидация пароля
    if (!validatePassword(password)) {
        isValid = false;
    }
    
    return isValid;
}

/**
 * Валидация email
 */
function validateEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const emailInput = document.getElementById('email');
    const errorElement = document.getElementById('email-error');
    
    if (!email) {
        showFieldError(emailInput, errorElement, 'Email обязателен');
        return false;
    }
    
    if (!emailRegex.test(email)) {
        showFieldError(emailInput, errorElement, 'Неверный формат email');
        return false;
    }
    
    clearFieldError(emailInput, errorElement);
    return true;
}

/**
 * Валидация пароля
 */
function validatePassword(password) {
    const passwordInput = document.getElementById('password');
    const errorElement = document.getElementById('password-error');
    
    if (!password) {
        showFieldError(passwordInput, errorElement, 'Пароль обязателен');
        return false;
    }
    
    if (password.length < 6) {
        showFieldError(passwordInput, errorElement, 'Пароль должен содержать минимум 6 символов');
        return false;
    }
    
    clearFieldError(passwordInput, errorElement);
    return true;
}

/**
 * Очистка ошибки email
 */
function clearEmailError() {
    const emailInput = document.getElementById('email');
    const errorElement = document.getElementById('email-error');
    clearFieldError(emailInput, errorElement);
}

/**
 * Очистка ошибки пароля
 */
function clearPasswordError() {
    const passwordInput = document.getElementById('password');
    const errorElement = document.getElementById('password-error');
    clearFieldError(passwordInput, errorElement);
}

/**
 * Показать ошибку поля
 */
function showFieldError(inputElement, errorElement, message) {
    if (inputElement && errorElement) {
        inputElement.style.borderColor = '#dc3545';
        errorElement.textContent = message;
        errorElement.style.display = 'block';
    }
}

/**
 * Очистить ошибку поля
 */
function clearFieldError(inputElement, errorElement) {
    if (inputElement && errorElement) {
        inputElement.style.borderColor = '#e9ecef';
        errorElement.textContent = '';
        errorElement.style.display = 'none';
    }
}

/**
 * Сохранение данных авторизации
 */
function saveAuthData(user, token, rememberMe) {
    authState.user = user;
    authState.token = token;
    authState.isAuthenticated = true;
    
    if (rememberMe) {
        localStorage.setItem(STORAGE_KEYS.USER, JSON.stringify(user));
        localStorage.setItem(STORAGE_KEYS.TOKEN, token);
        localStorage.setItem(STORAGE_KEYS.REMEMBER_ME, 'true');
    } else {
        sessionStorage.setItem(STORAGE_KEYS.USER, JSON.stringify(user));
        sessionStorage.setItem(STORAGE_KEYS.TOKEN, token);
        localStorage.removeItem(STORAGE_KEYS.REMEMBER_ME);
    }
}

/**
 * Очистка данных авторизации
 */
function clearAuthData() {
    authState.user = null;
    authState.token = null;
    authState.isAuthenticated = false;
    
    // Очищаем все хранилища
    localStorage.removeItem(STORAGE_KEYS.USER);
    localStorage.removeItem(STORAGE_KEYS.TOKEN);
    localStorage.removeItem(STORAGE_KEYS.REMEMBER_ME);
    sessionStorage.removeItem(STORAGE_KEYS.USER);
    sessionStorage.removeItem(STORAGE_KEYS.TOKEN);
}

/**
 * Обработка выхода
 */
function handleLogout() {
    if (confirm('Вы уверены, что хотите выйти?')) {
        clearAuthData();
        
        // Показываем сообщение об успешном выходе
        showSuccessMessage('Вы успешно вышли из системы');
        
        // Перенаправляем на страницу входа
        setTimeout(() => {
            redirectToLogin();
        }, 1000);
    }
}

/**
 * Обработка клика по ссылке регистрации
 */
function handleRegisterClick(event) {
    event.preventDefault();
    showInfoMessage('Функция регистрации будет доступна в следующей версии');
}

/**
 * Обработка восстановления пароля
 */
function handleForgotPassword(event) {
    event.preventDefault();
    showInfoMessage('Функция восстановления пароля будет доступна в следующей версии');
}

/**
 * Установка состояния загрузки кнопки входа
 */
function setLoginButtonLoading(loading) {
    const loginBtn = document.getElementById('login-btn');
    const btnText = document.querySelector('.btn-text');
    const btnLoader = document.querySelector('.btn-loader');
    
    if (loginBtn && btnText && btnLoader) {
        if (loading) {
            loginBtn.disabled = true;
            btnText.style.display = 'none';
            btnLoader.style.display = 'inline';
        } else {
            loginBtn.disabled = false;
            btnText.style.display = 'inline';
            btnLoader.style.display = 'none';
        }
    }
}

/**
 * Показать сообщение об успехе
 */
function showSuccessMessage(message) {
    showAlert(message, 'success');
}

/**
 * Показать сообщение об ошибке
 */
function showErrorMessage(message) {
    showAlert(message, 'error');
}

/**
 * Показать информационное сообщение
 */
function showInfoMessage(message) {
    showAlert(message, 'info');
}

/**
 * Показать уведомление
 */
function showAlert(message, type) {
    // Создаем элемент уведомления
    const alert = document.createElement('div');
    alert.className = `alert alert-${type}`;
    alert.innerHTML = `
        <div class="alert-content">
            <span class="alert-icon">${getAlertIcon(type)}</span>
            <span class="alert-message">${message}</span>
            <button class="alert-close" onclick="this.parentElement.parentElement.remove()">×</button>
        </div>
    `;
    
    // Добавляем стили
    alert.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 10000;
        padding: 1rem;
        border-radius: 8px;
        max-width: 400px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        animation: slideIn 0.3s ease-out;
    `;
    
    // Устанавливаем цвет в зависимости от типа
    switch (type) {
        case 'success':
            alert.style.background = '#d4edda';
            alert.style.color = '#155724';
            alert.style.border = '1px solid #c3e6cb';
            break;
        case 'error':
            alert.style.background = '#f8d7da';
            alert.style.color = '#721c24';
            alert.style.border = '1px solid #f5c6cb';
            break;
        case 'info':
            alert.style.background = '#d1ecf1';
            alert.style.color = '#0c5460';
            alert.style.border = '1px solid #bee5eb';
            break;
    }
    
    // Добавляем в DOM
    document.body.appendChild(alert);
    
    // Автоматически удаляем через 5 секунд
    setTimeout(() => {
        if (alert.parentElement) {
            alert.remove();
        }
    }, 5000);
}

/**
 * Получить иконку для типа уведомления
 */
function getAlertIcon(type) {
    switch (type) {
        case 'success': return '✓';
        case 'error': return '⚠';
        case 'info': return 'ℹ';
        default: return 'ℹ';
    }
}

/**
 * Перенаправление на главную страницу
 */
function redirectToMain() {
    window.location.href = 'index.html';
}

/**
 * Перенаправление на страницу входа
 */
function redirectToLogin() {
    window.location.href = 'login.html';
}

/**
 * Генерация фиктивного токена
 */
function generateMockToken() {
    return 'mock_token_' + Math.random().toString(36).substr(2, 9);
}

/**
 * Получение отображаемого имени пользователя
 */
function getUserDisplayName(email) {
    const nameMap = {
        'admin@eduplatform.com': 'Администратор',
        'student@eduplatform.com': 'Студент',
        'teacher@eduplatform.com': 'Преподаватель'
    };
    
    return nameMap[email] || email.split('@')[0];
}

/**
 * Генерация URL аватара
 */
function generateAvatarUrl(email) {
    const hash = email.split('').reduce((a, b) => {
        a = ((a << 5) - a) + b.charCodeAt(0);
        return a & a;
    }, 0);
    
    return `https://api.dicebear.com/7.x/avataaars/svg?seed=${Math.abs(hash)}`;
}

/**
 * Проверка авторизации (для использования в других модулях)
 */
function isAuthenticated() {
    return authState.isAuthenticated;
}

/**
 * Получение текущего пользователя
 */
function getCurrentUser() {
    return authState.user;
}

/**
 * Получение токена авторизации
 */
function getAuthToken() {
    return authState.token;
}

/**
 * Проверка роли пользователя
 */
function hasRole(role) {
    return authState.user && authState.user.role === role;
}

/**
 * Проверка прав доступа
 */
function hasPermission(permission) {
    if (!authState.user) return false;
    
    const permissions = {
        admin: ['read', 'write', 'delete', 'manage_users', 'manage_courses'],
        teacher: ['read', 'write', 'manage_courses'],
        student: ['read']
    };
    
    return permissions[authState.user.role] && permissions[authState.user.role].includes(permission);
}

// Экспорт функций для использования в других модулях
window.authModule = {
    isAuthenticated,
    getCurrentUser,
    getAuthToken,
    hasRole,
    hasPermission,
    logout: handleLogout
};
