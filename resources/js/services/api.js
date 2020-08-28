import axios from 'axios'
import {
    base_url,
    getHeader
} from './../config/config.js'

export function http() {
    return axios.create({
        baseURL: base_url,
        headers: getHeader()
    })
}

export function httpFile() {
    return axios.create({
        baseURL: base_url,
        headers: {
            'Content-Type': 'multipart/form-control'
        }
    })
}
