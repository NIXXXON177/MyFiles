import React from 'react'
import './App.css'
import { generate as randomWords } from 'random-words';
import ComponentClass from "./components/ComponentClass/ComponentClass"
import PureComponentClass from "./components/PureComponentClass/PureComponentClass"
import ComponentFunc from "./components/ComponentFunc"

export default class App extends React.Component {
  state = {
    count: 0,
    str: 'str',
    pure: 'pure',
    func: 'func'
  }

  componentDidMount() {
    setInterval(() => {
      if (this.state.count % 2) {
        this.setState({
          count: this.state.count + 1,
          str: randomWords()
        })
      } else {
        this.setState({
          count: this.state.count + 1,
          str: randomWords(),
          pure: randomWords(),
          func: randomWords(),
        })
      }
    }, 3000)
  }
  render(){
    console.clear()
    return (
    <header className='App-header'>
      <ComponentClass string={this.state.str}/>
      <PureComponentClass string={this.state.pure}/>
      <ComponentFunc string={this.state.func}/>
    </header>
  )
  }
}
