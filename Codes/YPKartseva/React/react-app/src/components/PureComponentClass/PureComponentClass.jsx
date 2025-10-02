import React from 'react'

export default class ComponentClass extends React.PureComponent{
    render() {
        console.log('----------')
        console.log('PureComponentClass')
        return <p>{this.props.string}</p>
    }
} 