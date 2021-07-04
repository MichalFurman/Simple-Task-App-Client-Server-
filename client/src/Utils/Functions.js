import axios from 'axios'

export const itemsList = () => {
  return axios
  .get(process.env.REACT_APP_API+'/', {
      headers: {'Content-Type': 'application/json'}
    })
    .then(response => {
      if (response.status === 200 && response.data !== undefined && response.data.length > 0) {
        return response.data
      }
      return null
    })
    .catch((errors) => {
      if (errors) console.log(errors)
      alert('We have some troubles. Perhaps server is down.')
      return null
    })

}

export const getItem = (id) => {
  return axios
  .get(process.env.REACT_APP_API+'/'+id, {
      headers: {'Content-Type': 'application/json'}
    })
    .then(response => {
      if (response.status === 200) {
        return response.data
      }
      return null
    })
    .catch((errors) => {
      if (errors) console.log(errors)
      alert('We have some troubles. Perhaps server is down.')
      return null
    })
}

export const deleteItem = (id) => {
  return axios
  .delete(process.env.REACT_APP_API+'/'+id, {
      headers: {'Content-Type': 'application/json'}
    })
    .then(response => {
      if (response.status === 200) {
        return true
      }
      return null
    })
    .catch((errors) => {
      if (errors) console.log(errors)
      alert('We have some troubles. Perhaps server is down.')
      return null
    })
}
