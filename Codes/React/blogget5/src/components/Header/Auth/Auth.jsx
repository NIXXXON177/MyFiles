/* eslint-disable react/prop-types */
/* eslint-disable max-len */
import React from 'react';
import style from './Auth.module.css';
import {ReactComponent as AuthIcon} from './img/login.svg';

export const Auth = props => (
  <button className={style.button}>
    {console.log(props)}
    {props.auth ? props.auth :
      <AuthIcon className={style.svg}/>
    }
  </button>
);
