switch (имя_переменной_значение_которой_сравниваем) {
  case значение:
    // код
    break
}

-----------------------------------

switch (membershipStatus) {
  case 'vip':
    // выполнится, если в переменной membershipStatus хранится строка 'vip'
    console.log('Приветствуем вас, ваше великолепие!')
    console.log('рады вас видеть!')
    break
  case 'diamond':
    console.log('Здравствуйте, бриллиантовый клиент!')
    break
  case 'gold':
    console.log('Привет, золотой мой!')
    break
  default:
    // выполнится, если ни один другой случай не сработал
    console.log('Прив')
    break
}

-----------------------------------

let discount
switch (memberStatus) {
  case 'vip':
    discount = 0.25
    break
  case 'diamond':
    discount = 0.2
    break
  case 'gold':
  case 'silver':
    // можно написать несколько кейсов и связать с одним блоком
    discount = 0.1
    break
  default:
    discount = 0
    break
}