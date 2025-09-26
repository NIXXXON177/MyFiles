import React from 'react'

export default class ComponentClass extends React.Component{
    render() {
        console.log('----------')
        console.log('ComponentClass')
        return(
            <p>{this.props.str}</p>
        )
    }
}