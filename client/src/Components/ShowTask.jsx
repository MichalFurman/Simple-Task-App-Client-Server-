import React, {Component, Fragment} from 'react';
import { getItem } from '../Utils/Functions';



class ShowTask extends Component {

  constructor() {
    super();
    this.state = {
      item: null
    }
  }

  componentWillReceiveProps(nextProps) {
    this.setState({
      item: null
    });
    if (nextProps.id){
      getItem(nextProps.id).then(item => {
        this.setState({
          item
        });  
      });
    }
  }


  render() {
    return (
      <Fragment>
        {this.state.item ?
          <div className="show-body"> 
            <h2 className="show-task">{this.state.item.task_title}</h2>
            <p className="author">by {this.state.item.user_name} at {this.state.item.time}</p>
            <p className="desc">{this.state.item.task_desc}</p>
          </div>
        : null }
      </Fragment>
    )
  }
}

export default ShowTask;
