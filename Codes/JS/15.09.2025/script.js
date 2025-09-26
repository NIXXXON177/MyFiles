// const init = function(a, b) {
//     const obj = {
//         a,
//         b,
//     }

//     const objMethod = {
//         toString() {
//             return JSON.stringify(this)
//         },
//         sum() {
//             console.log(this.a + this.b)
//             return this.a + this.b
//         }
//     }

//     obj.__proto__ = objMethod
//     return obj
// }

// const obj = init(5, 10)
// console.log('obj :', obj)
// console.log(obj.toString())
// console.log(obj.sum())


const Car = function(brand, model, maxTank){
    this.brand = brand
    this.model = model
    this.maxTank = maxTank
}

console.dir(new Car('Mazda', 'cx-5', 55))
