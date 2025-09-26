const procedural = () => {
    const createElement = (tag, options, parent = null) => {
        const element = document.createElement(tag)
        Object.assign(element, options)
        if (parent) parent.append(element)
        return element
    }

    const content = createElement('div', {
        className: 'triangle',
    }, document.body)

    const getTriangle = (a, b, c) => {
        const perimeter = a + b + c
        const p = perimeter / 2
        const area = Math.sqrt(p * (p - a) * (p - b) * (p - c))

        return { a, b, c, perimeter, area }
    }

    const triangle = getTriangle(3, 4, 5)
    console.log('triangle: ', triangle)

    createElement('p', {
        className: 'area',
        textContent: `area: ${triangle.area}`,
    }, content)
}

export default procedural;