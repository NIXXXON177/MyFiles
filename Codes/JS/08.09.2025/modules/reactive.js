const reactive = () => {
    class Element {
      constructor(tag, options = null, parent = null) {
        this.tag = tag;
        this.element = null;
        this.options = options;
        this.parent = parent;
        this.createElement();
      }
  
      createElement() {
        this.element = document.createElement(this.tag);
        if (this.parent) this.parent.append(this.element);
        this.addOptions(this.options);
      }
  
      addOptions(options) {
        Object.assign(this.element, options);
      }
  
      set attr(options) {
        this.addOptions(options);
      }
    };
  
    const content = new Element('h1', {
      textContent: 'Привет мир!',
      className: 'triangle',
    }, document.body);
    
    setTimeout(() => {
      content.attr = {textContent: 'Hello world'};
    }, 3000);
    
    setTimeout(() => {
      const test = new Element('span', {
        textContent: '!!!',
      }, content.element);
      console.log(test);
    }, 5000);
    
    console.log(content);
  
    class Triangle {
      constructor(a, b, c) {
        this.triangle = { a, b, c };
        this.calculate();
      }
    
      calculate() {
        const { a, b, c } = this.triangle;
        const p = (a + b + c) / 2;
        this.triangle.area = Math.sqrt(p * (p - a) * (p - b) * (p - c));
        this.triangle.perimeter = a + b + c; //периметр
      }
  
      set a(n) {
        this.triangle.a = n;
        this.calculate();
      }
      
      set b(n) {
        this.triangle.b = n;
        this.calculate();
      }
      
      set c(n) {
        this.triangle.c = n;
        this.calculate();
      }
      
      get area() {
        return this.triangle.area;
      }
  
      get perimeter() {
        return this.triangle.perimeter;
      }
    };
  
    const triangle = new Triangle(3, 4, 5);
    console.log('triangle: ', triangle);
  
  };
  
  export default reactive;
  