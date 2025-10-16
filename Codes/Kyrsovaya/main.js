/**
 * Основной скрипт системы управления курсами
 * Обработка загрузки данных, рендеринг интерфейса
 */

// Глобальные переменные
let currentUser = null;
let coursesData = [];
let currentCoursesPage = 1;
const coursesPerPage = 9;

// Инициализация приложения
document.addEventListener('DOMContentLoaded', function() {
    initializeApp();
});

/**
 * Инициализация приложения
 */
function initializeApp() {
    // Проверяем авторизацию
    if (!checkAuth()) {
        redirectToLogin();
        return;
    }

    // Загружаем данные пользователя
    loadUserData();
    
    // Загружаем данные в зависимости от страницы
    const currentPage = getCurrentPage();
    switch (currentPage) {
        case 'index':
            loadDashboardData();
            break;
        case 'courses':
            loadCoursesData();
            setupCoursesEventListeners();
            break;
        case 'course-details':
            loadCourseDetails();
            setupCourseDetailsEventListeners();
            break;
    }

    // Настройка общих обработчиков
    setupCommonEventListeners();
}

/**
 * Получение текущей страницы
 */
function getCurrentPage() {
    const path = window.location.pathname;
    if (path.includes('index.html') || path === '/') return 'index';
    if (path.includes('courses.html')) return 'courses';
    if (path.includes('course-details.html')) return 'course-details';
    return 'index';
}

/**
 * Загрузка данных пользователя
 */
function loadUserData() {
    // Получаем данные пользователя из localStorage или API
    const userData = localStorage.getItem('currentUser');
    if (userData) {
        currentUser = JSON.parse(userData);
        updateUserInterface();
    }
}

/**
 * Обновление интерфейса пользователя
 */
function updateUserInterface() {
    if (!currentUser) return;

    // Обновляем имя пользователя
    const userNameElement = document.getElementById('user-name');
    if (userNameElement) {
        userNameElement.textContent = currentUser.name || 'Пользователь';
    }
}

/**
 * Загрузка данных для дашборда
 */
function loadDashboardData() {
    // Загружаем статистику
    loadDashboardStats();
    
    // Загружаем недавние курсы
    loadRecentCourses();
    
    // Загружаем уведомления
    loadNotifications();
}

/**
 * Загрузка статистики дашборда
 */
function loadDashboardStats() {
    // Имитация загрузки данных с сервера
    const stats = {
        activeCourses: 5,
        completedCourses: 12,
        averageGrade: 4.2,
        studyTime: 24
    };

    // Обновляем элементы интерфейса
    updateElement('active-courses', stats.activeCourses);
    updateElement('completed-courses', stats.completedCourses);
    updateElement('average-grade', stats.averageGrade);
    updateElement('study-time', `${stats.studyTime}ч`);
}

/**
 * Загрузка недавних курсов
 */
function loadRecentCourses() {
    const recentCourses = [
        {
            id: 1,
            title: 'Веб-разработка с нуля',
            progress: 75,
            category: 'Программирование',
            instructor: 'Иван Петров'
        },
        {
            id: 2,
            title: 'Дизайн интерфейсов',
            progress: 45,
            category: 'Дизайн',
            instructor: 'Анна Смирнова'
        },
        {
            id: 3,
            title: 'Основы маркетинга',
            progress: 90,
            category: 'Маркетинг',
            instructor: 'Михаил Козлов'
        }
    ];

    renderRecentCourses(recentCourses);
}

/**
 * Рендеринг недавних курсов
 */
function renderRecentCourses(courses) {
    const container = document.getElementById('recent-courses-list');
    if (!container) return;

    container.innerHTML = courses.map(course => `
        <div class="course-card" onclick="openCourseDetails(${course.id})">
            <div class="course-card-content">
                <div class="course-card-category">${course.category}</div>
                <div class="course-card-title">${course.title}</div>
                <div class="course-card-meta">
                    <span>👨‍🏫 ${course.instructor}</span>
                    <span>📊 ${course.progress}%</span>
                </div>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: ${course.progress}%"></div>
                </div>
            </div>
        </div>
    `).join('');
}

/**
 * Загрузка уведомлений
 */
function loadNotifications() {
    const notifications = [
        {
            id: 1,
            type: 'deadline',
            title: 'Скоро дедлайн',
            message: 'Курс "Веб-разработка" завершится через 3 дня',
            date: '2025-01-20'
        },
        {
            id: 2,
            type: 'achievement',
            title: 'Новое достижение',
            message: 'Вы получили сертификат по курсу "Основы JavaScript"',
            date: '2025-01-18'
        }
    ];

    renderNotifications(notifications);
}

/**
 * Рендеринг уведомлений
 */
function renderNotifications(notifications) {
    const container = document.getElementById('notifications-list');
    if (!container) return;

    container.innerHTML = notifications.map(notification => `
        <div class="notification-item ${notification.type}">
            <div class="notification-icon">
                ${notification.type === 'deadline' ? '⏰' : '🏆'}
            </div>
            <div class="notification-content">
                <div class="notification-title">${notification.title}</div>
                <div class="notification-message">${notification.message}</div>
                <div class="notification-date">${formatDate(notification.date)}</div>
            </div>
        </div>
    `).join('');
}

/**
 * Загрузка данных курсов
 */
function loadCoursesData() {
    // Имитация загрузки данных с сервера
    coursesData = generateMockCourses();
    renderCourses();
    updateCoursesCount();
}

/**
 * Генерация тестовых данных курсов
 */
function generateMockCourses() {
    const categories = ['Программирование', 'Дизайн', 'Маркетинг', 'Бизнес', 'Языки'];
    const difficulties = ['beginner', 'intermediate', 'advanced'];
    const instructors = ['Иван Петров', 'Анна Смирнова', 'Михаил Козлов', 'Елена Васильева', 'Дмитрий Новиков'];
    
    return Array.from({ length: 50 }, (_, index) => ({
        id: index + 1,
        title: `Курс ${index + 1}: ${categories[index % categories.length]}`,
        description: `Подробное описание курса ${index + 1}. Изучите основы и продвинутые техники.`,
        category: categories[index % categories.length].toLowerCase(),
        difficulty: difficulties[index % difficulties.length],
        duration: Math.floor(Math.random() * 20) + 1,
        rating: (Math.random() * 2 + 3).toFixed(1),
        students: Math.floor(Math.random() * 1000) + 50,
        instructor: instructors[index % instructors.length],
        price: Math.random() > 0.5 ? 'Бесплатно' : `${Math.floor(Math.random() * 5000) + 1000} ₽`,
        image: `course-${(index % 10) + 1}`
    }));
}

/**
 * Рендеринг списка курсов
 */
function renderCourses() {
    const container = document.getElementById('courses-grid');
    if (!container) return;

    const startIndex = (currentCoursesPage - 1) * coursesPerPage;
    const endIndex = startIndex + coursesPerPage;
    const coursesToShow = coursesData.slice(startIndex, endIndex);

    container.innerHTML = coursesToShow.map(course => `
        <div class="course-card" onclick="openCourseDetails(${course.id})">
            <div class="course-card-image">
                <span>📚</span>
            </div>
            <div class="course-card-content">
                <div class="course-card-category">${course.category}</div>
                <div class="course-card-title">${course.title}</div>
                <div class="course-card-description">${course.description}</div>
                <div class="course-card-meta">
                    <div class="course-card-rating">
                        ⭐ ${course.rating} (${course.students})
                    </div>
                    <div class="course-card-price">${course.price}</div>
                </div>
            </div>
        </div>
    `).join('');

    renderPagination();
}

/**
 * Рендеринг пагинации
 */
function renderPagination() {
    const container = document.getElementById('pagination');
    if (!container) return;

    const totalPages = Math.ceil(coursesData.length / coursesPerPage);
    if (totalPages <= 1) {
        container.innerHTML = '';
        return;
    }

    let paginationHTML = '';
    
    // Кнопка "Назад"
    if (currentCoursesPage > 1) {
        paginationHTML += `<button onclick="changePage(${currentCoursesPage - 1})">←</button>`;
    }

    // Номера страниц
    for (let i = 1; i <= totalPages; i++) {
        if (i === currentCoursesPage) {
            paginationHTML += `<button class="active">${i}</button>`;
        } else {
            paginationHTML += `<button onclick="changePage(${i})">${i}</button>`;
        }
    }

    // Кнопка "Вперед"
    if (currentCoursesPage < totalPages) {
        paginationHTML += `<button onclick="changePage(${currentCoursesPage + 1})">→</button>`;
    }

    container.innerHTML = paginationHTML;
}

/**
 * Смена страницы
 */
function changePage(page) {
    currentCoursesPage = page;
    renderCourses();
    window.scrollTo(0, 0);
}

/**
 * Обновление счетчика курсов
 */
function updateCoursesCount() {
    updateElement('courses-count', coursesData.length);
}

/**
 * Загрузка деталей курса
 */
function loadCourseDetails() {
    const courseId = getCourseIdFromURL();
    if (!courseId) {
        showError('Курс не найден');
        return;
    }

    // Имитация загрузки данных курса
    const course = generateMockCourseDetails(courseId);
    renderCourseDetails(course);
}

/**
 * Получение ID курса из URL
 */
function getCourseIdFromURL() {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get('id');
}

/**
 * Генерация детальных данных курса
 */
function generateMockCourseDetails(id) {
    return {
        id: id,
        title: `Курс ${id}: Веб-разработка с нуля`,
        description: 'Изучите современные технологии веб-разработки',
        fullDescription: 'Этот курс поможет вам освоить основы веб-разработки. Вы изучите HTML, CSS, JavaScript и современные фреймворки.',
        category: 'Программирование',
        instructor: 'Иван Петров',
        duration: 24,
        level: 'Начинающий',
        rating: 4.5,
        students: 1250,
        price: '2990 ₽',
        oldPrice: '5990 ₽',
        objectives: [
            'Изучить основы HTML и CSS',
            'Освоить JavaScript',
            'Понять принципы работы с DOM',
            'Научиться использовать Git',
            'Создать собственный проект'
        ],
        requirements: [
            'Базовые знания компьютера',
            'Желание изучать программирование',
            'Время на выполнение заданий'
        ],
        curriculum: [
            { title: 'Введение в веб-разработку', duration: '2 часа', lessons: 8 },
            { title: 'Основы HTML', duration: '3 часа', lessons: 12 },
            { title: 'CSS и стилизация', duration: '4 часа', lessons: 15 },
            { title: 'JavaScript основы', duration: '5 часов', lessons: 18 },
            { title: 'Работа с DOM', duration: '3 часа', lessons: 10 },
            { title: 'Финальный проект', duration: '7 часов', lessons: 25 }
        ],
        instructorInfo: {
            name: 'Иван Петров',
            title: 'Senior Frontend Developer',
            experience: '8 лет опыта',
            description: 'Опытный разработчик с большим стажем в веб-разработке'
        },
        reviews: [
            {
                author: 'Анна Смирнова',
                rating: 5,
                text: 'Отличный курс! Все объяснено очень понятно.'
            },
            {
                author: 'Михаил Козлов',
                rating: 4,
                text: 'Хороший курс для начинающих. Рекомендую!'
            }
        ]
    };
}

/**
 * Рендеринг деталей курса
 */
function renderCourseDetails(course) {
    // Обновляем основную информацию
    updateElement('course-title-breadcrumb', course.title);
    updateElement('course-category', course.category);
    updateElement('course-title', course.title);
    updateElement('course-description', course.description);
    updateElement('course-instructor', course.instructor);
    updateElement('course-duration', `${course.duration} часов`);
    updateElement('course-level', course.level);
    updateElement('course-rating', course.rating);
    updateElement('course-students', course.students);
    updateElement('course-price', course.price);
    updateElement('course-old-price', course.oldPrice);

    // Обновляем табы
    updateLearningObjectives(course.objectives);
    updateRequirements(course.requirements);
    updateFullDescription(course.fullDescription);
    updateCurriculum(course.curriculum);
    updateInstructorInfo(course.instructorInfo);
    updateReviews(course.reviews);
}

/**
 * Обновление целей обучения
 */
function updateLearningObjectives(objectives) {
    const container = document.getElementById('learning-objectives');
    if (!container) return;

    container.innerHTML = objectives.map(objective => `
        <li>✓ ${objective}</li>
    `).join('');
}

/**
 * Обновление требований
 */
function updateRequirements(requirements) {
    const container = document.getElementById('course-requirements');
    if (!container) return;

    container.innerHTML = requirements.map(requirement => `
        <li>• ${requirement}</li>
    `).join('');
}

/**
 * Обновление полного описания
 */
function updateFullDescription(description) {
    updateElement('course-full-description', description);
}

/**
 * Обновление программы курса
 */
function updateCurriculum(curriculum) {
    const container = document.getElementById('curriculum-list');
    if (!container) return;

    container.innerHTML = curriculum.map(item => `
        <div class="curriculum-item">
            <div class="curriculum-header">
                <h4>${item.title}</h4>
                <span class="curriculum-duration">${item.duration}</span>
            </div>
            <div class="curriculum-lessons">${item.lessons} уроков</div>
        </div>
    `).join('');
}

/**
 * Обновление информации о преподавателе
 */
function updateInstructorInfo(instructor) {
    const container = document.getElementById('instructor-info');
    if (!container) return;

    container.innerHTML = `
        <div class="instructor-avatar">${instructor.name.charAt(0)}</div>
        <div class="instructor-details">
            <h4>${instructor.name}</h4>
            <p class="instructor-title">${instructor.title}</p>
            <p class="instructor-experience">${instructor.experience}</p>
            <p class="instructor-description">${instructor.description}</p>
        </div>
    `;
}

/**
 * Обновление отзывов
 */
function updateReviews(reviews) {
    const container = document.getElementById('reviews-list');
    if (!container) return;

    container.innerHTML = reviews.map(review => `
        <div class="review-item">
            <div class="review-header">
                <span class="review-author">${review.author}</span>
                <div class="review-rating">
                    ${'⭐'.repeat(review.rating)}
                </div>
            </div>
            <div class="review-text">${review.text}</div>
        </div>
    `).join('');
}

/**
 * Настройка обработчиков событий для курсов
 */
function setupCoursesEventListeners() {
    // Обработчик поиска
    const searchInput = document.getElementById('search-input');
    if (searchInput) {
        searchInput.addEventListener('input', debounce(handleSearch, 300));
    }

    // Обработчики фильтров
    const filters = ['category-filter', 'difficulty-filter', 'duration-filter', 'sort-select'];
    filters.forEach(filterId => {
        const element = document.getElementById(filterId);
        if (element) {
            element.addEventListener('change', handleFilterChange);
        }
    });

    // Обработчик очистки фильтров
    const clearFiltersBtn = document.getElementById('clear-filters');
    if (clearFiltersBtn) {
        clearFiltersBtn.addEventListener('click', clearFilters);
    }
}

/**
 * Настройка обработчиков событий для деталей курса
 */
function setupCourseDetailsEventListeners() {
    // Обработчики табов
    const tabButtons = document.querySelectorAll('.tab-btn');
    tabButtons.forEach(btn => {
        btn.addEventListener('click', handleTabChange);
    });

    // Обработчик записи на курс
    const enrollBtn = document.getElementById('enroll-btn');
    if (enrollBtn) {
        enrollBtn.addEventListener('click', handleEnroll);
    }
}

/**
 * Настройка общих обработчиков событий
 */
function setupCommonEventListeners() {
    // Обработчик выхода
    const logoutBtn = document.getElementById('logout-btn');
    if (logoutBtn) {
        logoutBtn.addEventListener('click', handleLogout);
    }
}

/**
 * Обработка поиска
 */
function handleSearch(event) {
    const searchTerm = event.target.value.toLowerCase();
    // Здесь должна быть логика фильтрации курсов
    console.log('Поиск:', searchTerm);
}

/**
 * Обработка изменения фильтров
 */
function handleFilterChange() {
    // Здесь должна быть логика применения фильтров
    console.log('Фильтры изменены');
}

/**
 * Очистка фильтров
 */
function clearFilters() {
    const filters = ['category-filter', 'difficulty-filter', 'duration-filter'];
    filters.forEach(filterId => {
        const element = document.getElementById(filterId);
        if (element) {
            element.value = '';
        }
    });
    document.getElementById('search-input').value = '';
}

/**
 * Обработка смены табов
 */
function handleTabChange(event) {
    const tabName = event.target.dataset.tab;
    
    // Убираем активный класс у всех табов
    document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
    document.querySelectorAll('.tab-pane').forEach(pane => pane.classList.remove('active'));
    
    // Добавляем активный класс к выбранному табу
    event.target.classList.add('active');
    document.getElementById(`${tabName}-tab`).classList.add('active');
}

/**
 * Обработка записи на курс
 */
function handleEnroll() {
    const courseId = getCourseIdFromURL();
    showSuccess(`Вы успешно записались на курс ${courseId}!`);
}

/**
 * Обработка выхода
 */
function handleLogout() {
    localStorage.removeItem('currentUser');
    redirectToLogin();
}

/**
 * Открытие деталей курса
 */
function openCourseDetails(courseId) {
    window.location.href = `course-details.html?id=${courseId}`;
}

/**
 * Проверка авторизации
 */
function checkAuth() {
    const user = localStorage.getItem('currentUser');
    return user !== null;
}

/**
 * Перенаправление на страницу входа
 */
function redirectToLogin() {
    window.location.href = 'login.html';
}

/**
 * Обновление элемента
 */
function updateElement(id, value) {
    const element = document.getElementById(id);
    if (element) {
        element.textContent = value;
    }
}

/**
 * Показать ошибку
 */
function showError(message) {
    alert(`Ошибка: ${message}`);
}

/**
 * Показать успех
 */
function showSuccess(message) {
    alert(`Успех: ${message}`);
}

/**
 * Форматирование даты
 */
function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString('ru-RU');
}

/**
 * Debounce функция
 */
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}
