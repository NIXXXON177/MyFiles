import React from 'react';
import style from '../Post.module.css';
import {ReactComponent as DeleteIcon} from '../img/delete.svg';

export const PostDeleteButton = () => (
  <button className={style.delete} aria-label="Удалить пост">
    <DeleteIcon/>
  </button>
);
