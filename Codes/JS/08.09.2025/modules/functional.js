const functional = () => {
    const createElement = (tag, option = null) =>
      Object.assign(document.createElement(tag), option);
  
    const appendElement = (tag, option, parent) =>
      parent.append(createElement(tag, option));
  
    const getElement = (tag, option, parent) =>
    (parent ? appendElement(tag, option, parent) : createElement(tag, option));
  
    getElement('div', {
      className: 'triangle',
      textContent: 'Hello world!!!',
    }, document.body);
  
    const getPerimeter = (a, b, c) => a + b + c;
  
    const getHalfPerimeter = (a, b, c) => getPerimeter(a, b, c) / 2;
    
    const getArea = (a, b, c, p) => Math.sqrt(p * (p - a) * (p - b) * (p - c));
    
    const readyTriangle = (a, b, c, perimeter, area) => ({
      a, b, c, perimeter, area,
    });
    
    const getTriangle = (a, b, c) => readyTriangle(
      a, b, c,
      getPerimeter(a, b, c),
      getArea(a, b, c, getHalfPerimeter(a, b, c)),
    );
    
    const triangle = getTriangle(2, 3, 5);
    console.log('triangle: ', triangle);
  };
  
  export default functional;
  