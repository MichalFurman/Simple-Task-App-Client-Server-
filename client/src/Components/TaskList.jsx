import React, {Component, Fragment} from 'react';
import axios from 'axios'
import ShowTask from './ShowTask'
import { itemsList } from '../Utils/Functions'


class TaskList extends Component {

  constructor(){
    super();
    this.messages = {
      loading_list: ('Please wait, loading tasks...'),
      no_items: 'No tasks in list.',
    }
    this.state = {
      selectedItem: null,
      itemList: [],
      itemListStatus: this.messages.loading_list,
      newItem: {
        user_name: '',
        task_title: '',
        task_desc: ''
      },
      new_task_modal: false,
      show_task_modal: false,
    }
  }

  componentDidMount(){
    this.getItems()
  }

  showNewTaskModal = () => {
    this.setState({
      show_task_modal: false,
      new_task_modal: true,
      newItem: {
        user_name: '',
        task_title: '',
        task_desc: ''
      },
    })
  };

  closeNewTaskModal = () => {
    this.setState({
      new_task_modal: false,
    })
  };

  showTaskModal = (id) => {
    this.setState({
      selectedItem: id,
      new_task_modal: false,
      show_task_modal: true,
    })
  };

  closeTaskModal = () => {
    this.setState({
      selectedItem: null,
      show_task_modal: false,
    })
  };

  getItems = () => {
    this.setState({
      itemList: [],
      itemListStatus: this.messages.loading_list
    })
    itemsList().then(data =>{
      if (Array.isArray(data) && data.length > 0)        
      this.setState({
        itemList: [...data],
        itemListStatus: ''
      })
      else 
      this.setState({
        itemList: [],
        itemListStatus: this.messages.no_items
      })
    })
  }

  onChange(event) {
    this.setState({[event.target.name]: event.target.value})
  }

  submit(){
    let url = process.env.REACT_APP_API+"/";
    axios.post(url, this.state.newItem, { 
      headers: {'Content-Type': 'application/json'}
    })
    .then(response => {
      if (response.status === 201) {
        this.setState({itemList:[response.data, ...this.state.itemList]})
      }})
    .catch((errors) => {
      if (errors) console.log(errors)
      alert('Submit data failed. Perhaps server is down.')
      this.getItems()
    })
    this.setState({
      newItem: {
        user_name: '',
        task_title: '',
        task_desc: ''
      },
      new_task_modal: false,
    })
  }

  render() {
    return (
      <Fragment>
        <div className="container">
        <div className="listContainer">
              {
              this.state.itemList.map((item, index) => (
                <div className="item" title="click to enlarge" key={item.task_id}>
                  <div><span className="itemList" onClick={() => this.showTaskModal(item.task_id)}><h2 className="task-link">{item.task_title}</h2>
                  <p className="author">by {item.user_name} at {item.time}</p></span></div>
                </div>
            ))}
            <div className="list-status">{this.state.itemListStatus}</div>
          </div>          

          <div className="add-div"><button className="add-button" onClick={() =>this.showNewTaskModal()}>ADD NEW</button></div>

          <div className="modal-overlay" style={{display: this.state.new_task_modal ? 'block' : 'none'}}  onClick={() =>this.closeNewTaskModal()}>
            <div className="modal newtask" onClick={(e) =>e.stopPropagation()}>
              <div className="modal-header">
                <div className="close" onClick={() =>{this.closeNewTaskModal()}}>&times;</div>                 
              </div>
              <div className="modal-body"> 
                <div className="modal-row"><div className="modal-title">Author:</div>
                  <div><input type="text" className="form-control" id="user_name" name="user_name" placeholder="enter author name" value={this.state.newItem.user_name} onChange={(event) => { this.setState({newItem:{...this.state.newItem, user_name: event.target.value}})}} required /></div>
                </div> 
                <div className="modal-row"><div className="modal-title">Title:</div>
                  <div><input type="text" className="form-control" id="task_title" name="task_title" placeholder="enter title" value={this.state.newItem.task_title} onChange={(event) => { this.setState({newItem:{...this.state.newItem, task_title: event.target.value}})}} required /></div> 
                </div>
                <div className="modal-row"><div className="modal-title">Description:</div>
                  <div><textarea id="task_desc" name="task_desc" rows="2" cols="20"className="form-control" placeholder="enter desc" value={this.state.newItem.task_desc} onChange={(event) => { this.setState({newItem:{...this.state.newItem, task_desc: event.target.value}})}} required /></div> 
                </div>
              </div>
              <div className="modal-footer">
                <button type="button" data-dismiss="modal" onClick={()=>this.submit()}  disabled={!this.state.newItem.user_name || !this.state.newItem.task_title || !this.state.newItem.task_desc}> CREATE </button>
              </div>
            </div>
          </div>

          <div className="show-overlay" style={{display: this.state.show_task_modal ? 'block' : 'none'}} onClick={() =>this.closeTaskModal()}>
            <div className="showtask" onClick={(e) =>e.stopPropagation()}>
                <ShowTask id = {this.state.selectedItem}/>
              </div>
              <div className="show-footer">
                <button type="button" className="show-close" data-dismiss="modal" title="close window" onClick={() =>this.closeTaskModal()}>&times;</button>
              </div>
            </div>
          </div>
      </Fragment>
    )
  }
}

export default TaskList;
