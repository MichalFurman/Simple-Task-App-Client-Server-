import './App.css';
import React, {Component} from 'react'

import TaskList from './Components/TaskList'

class App extends Component {
  render() {

    // const queryConfig = {
    //     suspense: true,
    //   }

    return (
    <div className="App">
      <TaskList/>
    </div>
  );
  }
}

export default App;
