import React from 'react'
import './App.css'
import ComponentClass from "./components/ComponentClass/ComponentClass"
import { generate as randomWords } from 'random-words';

export default class App extends React.Component {
  render(){
    return (
    <header className='App-header'>
      <ComponentClass str={randomWords}/>
    </header>
  )
  }
}
