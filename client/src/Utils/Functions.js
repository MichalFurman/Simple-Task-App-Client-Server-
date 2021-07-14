import axios from 'axios';
import {API} from "./config";

export const itemsList = () => {
  return axios.get(API+'/', {
      headers: {'Content-Type': 'application/json'}
    })
    .then(response => {
      if (response.status === 200 && response.data !== undefined && response.data.length > 0) {
        return response.data;
      }
      return null;
    })
    .catch((errors) => {
      if (errors) console.log(errors);
      alert('We have some troubles. Perhaps server is down.');
      return null;
    });
}

export const getItem = (id) => {
  return axios.get(API+'/'+id, {
      headers: {'Content-Type': 'application/json'}
    })
    .then(response => {
      if (response.status === 200) {
        return response.data;
      }
      return null;
    })
    .catch((errors) => {
      if (errors) console.log(errors);
      alert('We have some troubles. Perhaps server is down.');
      return null;
    });
}

export const deleteItem = (id) => {
  return axios.delete(API+'/'+id, {
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
      alert('We have some troubles. Perhaps server is down.');
      return null;
    });
}
