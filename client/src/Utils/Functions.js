import axios from 'axios';
import {API} from "./Config";

const errorMsg = 'We have some troubles. Perhaps server is down.';

const requestGet = (url) => { 
  return axios.get(API+url, {
    headers: {'Content-Type': 'application/json'}
  })
  .then(response => {
    if (response.status === 200 && response.data !== undefined) {
      return response.data;
    }
    return null;
  })
  .catch((errors) => {
    if (errors) console.log(errors);
    alert(errorMsg);
    return null;
  });
}

const requestPost = (url, data) => {
  return axios.post(API+url, data, {
      headers: {'Content-Type': 'application/json'}
    })
    .then(response => {
      if (response.status === 201) {
        return response.data;
      }
      return null;
    })
    .catch((errors) => {
      if (errors) console.log(errors);
      alert(errorMsg);
      return null;
    });
}


const requestDelete = (url) => {
  return axios.delete(API+url, {
      headers: {'Content-Type': 'application/json'}
    })
    .then(response => {
      if (response.status === 200) {
        return true;
      }
      return null;
    })
    .catch((errors) => {
      if (errors) console.log(errors);
      alert(errorMsg);
      return null;
    });
}

export const getList = () => requestGet('/');
export const getItem = (id) => requestGet('/'+id);
export const storeItem = (data) => requestPost('/', data);
export const updateItem = (id, data) => requestPost('/'+id, data);
export const deleteItem = (id) => requestDelete('/'+id);
